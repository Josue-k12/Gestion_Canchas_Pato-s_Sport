<?php
require_once 'app/models/Alquiler.php';
require_once 'app/models/Cancha.php';
require_once 'app/models/Usuario.php';

class AlquilerController {
    
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Solo admin puede ver todos los alquileres
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 1) {
            header("Location: " . URL . "index.php");
            exit();
        }

        $alquilerModel = new Alquiler();
        $alquileres = $alquilerModel->obtenerTodos();

        include 'app/views/alquileres/lista_admin.php';
    }
    
    public function misAlquileres() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URL . "index.php?c=Auth&a=login");
            exit();
        }

        $alquilerModel = new Alquiler();
        $alquileres = $alquilerModel->obtenerPorUsuario($_SESSION['user_id']);

        include 'app/views/alquileres/index.php';
    }

    public function crear() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URL . "index.php?c=Auth&a=login");
            exit();
        }

        // Tanto admins como clientes pueden crear alquileres/reservas

        $alquilerModel = new Alquiler();
        $canchaModel = new Cancha();
        
        $canchas = $canchaModel->obtenerTodas();
        $precioHora = $alquilerModel->obtenerConfiguracion();
        $configuracion = $alquilerModel->obtenerConfiguracion('all'); // Obtener configuración completa
        $estados = $alquilerModel->obtenerEstados();
        $horas = $alquilerModel->obtenerHoras();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Determinar usuario_id
            $usuarioId = $_SESSION['user_id'];
            
            // Si es admin y selecciona nuevo cliente
            if ($_SESSION['rol'] == 1 && isset($_POST['cliente_nombre']) && !empty($_POST['cliente_nombre'])) {
                // Crear nuevo usuario cliente
                require_once 'app/models/Usuario.php';
                $usuarioModel = new Usuario();
                
                // Generar email temporal (nombre + timestamp)
                $emailTemporal = strtolower(str_replace(' ', '.', $_POST['cliente_nombre'])) . '.' . time() . '@patosport.local';
                
                // Crear usuario con rol de cliente (rol = 2)
                $datosUsuario = [
                    'nombre' => $_POST['cliente_nombre'],
                    'email' => $emailTemporal,
                    'telefono' => $_POST['cliente_telefono'] ?? '',
                    'contrasena' => password_hash('123456', PASSWORD_BCRYPT), // Contraseña temporal
                    'rol' => 2 // Cliente
                ];
                
                $nuevoUserId = $usuarioModel->crear($datosUsuario);
                if ($nuevoUserId) {
                    $usuarioId = $nuevoUserId;
                } else {
                    $_SESSION['error'] = 'Error al crear el usuario cliente';
                    header("Location: " . URL . "index.php?c=Alquiler&a=crear");
                    exit();
                }
            } elseif ($_SESSION['rol'] == 1 && isset($_POST['usuario_id']) && !empty($_POST['usuario_id'])) {
                // Admin selecciona un cliente existente
                $usuarioId = $_POST['usuario_id'];
            }

            // Procesamiento de archivo
            $comprobante = null;
            
            if (isset($_FILES['alquiler_comprobante_pago']) && $_FILES['alquiler_comprobante_pago']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'public/uploads/comprobantes/';
                
                // Crear carpeta si no existe
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                $nombreArchivo = time() . '_' . basename($_FILES['alquiler_comprobante_pago']['name']);
                $rutaArchivo = $uploadDir . $nombreArchivo;
                
                // Validar extensión
                $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'pdf'];
                $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
                
                if (in_array($extension, $extensionesPermitidas) && move_uploaded_file($_FILES['alquiler_comprobante_pago']['tmp_name'], $rutaArchivo)) {
                    $comprobante = $rutaArchivo;
                }
            }
            
            // Calcular horas de diferencia
            $horaInicio = new DateTime($_POST['alquiler_hora_inicial']);
            $horaFinal = new DateTime($_POST['alquiler_hora_final']);
            $horas = $horaInicio->diff($horaFinal)->h + ($horaInicio->diff($horaFinal)->d * 24);
            
            if ($horas <= 0) {
                $_SESSION['error'] = 'La hora final debe ser mayor a la hora inicial';
                header("Location: " . URL . "index.php?c=Alquiler&a=crear");
                exit();
            }

            // RF14: Verificar disponibilidad (Anti-duplicidad)
            $disponible = $alquilerModel->verificarDisponibilidad(
                $_POST['cancha_id'],
                $_POST['alquiler_fecha'],
                $_POST['alquiler_hora_inicial'],
                $_POST['alquiler_hora_final']
            );

            if (!$disponible) {
                $_SESSION['error'] = 'La cancha no está disponible en ese horario. Ya existe una reserva.';
                header("Location: " . URL . "index.php?c=Alquiler&a=crear");
                exit();
            }
            
            $precioTotal = $precioHora * $horas;
            
            // Obtener estado inicial (registrado)
            $estadoRegistrado = array_filter($estados, function($e) {
                return $e['estado_nombre'] === 'registrado';
            });
            $estadoId = reset($estadoRegistrado)['estado_id'] ?? 1;
            
            $datos = [
                'usuario_id' => $usuarioId,
                'cancha_id' => $_POST['cancha_id'],
                'estado_id' => $estadoId,
                'alquiler_fecha' => $_POST['alquiler_fecha'],
                'alquiler_hora_inicial' => $_POST['alquiler_hora_inicial'],
                'alquiler_hora_final' => $_POST['alquiler_hora_final'],
                'alquiler_valor' => $precioTotal,
                'alquiler_comprobante_pago' => $comprobante,
                'metodo_pago' => $_POST['metodo_pago'] ?? 'transferencia',
                'monto_efectivo' => $_POST['monto_efectivo'] ?? null
            ];

            if ($alquilerModel->crear($datos)) {
                $_SESSION['mensaje'] = 'Alquiler creado exitosamente';
                
                // Si es admin, redirige a gestión de alquileres; si es cliente, a mis alquileres
                if ($_SESSION['rol'] == 1) {
                    header("Location: " . URL . "index.php?c=Alquiler&a=index");
                } else {
                    header("Location: " . URL . "index.php?c=Alquiler&a=misAlquileres");
                }
                exit();
            } else {
                $_SESSION['error'] = 'Error al crear el alquiler';
            }
        }

        include 'app/views/alquileres/crear.php';
    }

    public function editar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URL . "index.php?c=Auth&a=login");
            exit();
        }

        if (!isset($_GET['id'])) {
            header("Location: " . URL . "index.php?c=Alquiler&a=misAlquileres");
            exit();
        }

        $alquilerModel = new Alquiler();
        $alquiler = $alquilerModel->obtenerPorId($_GET['id']);

        if (!$alquiler) {
            $_SESSION['error'] = 'Alquiler no encontrado';
            header("Location: " . URL . "index.php?c=Alquiler&a=misAlquileres");
            exit();
        }

        // Verificar que sea el propietario
        if ($alquiler['usuario_id'] != $_SESSION['user_id'] && $_SESSION['rol'] != 1) {
            $_SESSION['error'] = 'No tienes permiso para editar este alquiler';
            header("Location: " . URL . "index.php?c=Alquiler&a=misAlquileres");
            exit();
        }

        $canchaModel = new Cancha();
        $canchas = $canchaModel->obtenerTodas();
        $estados = $alquilerModel->obtenerEstados();
        $horas = $alquilerModel->obtenerHoras();
        $precioHora = $alquiler['precio_hora'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesamiento de archivo si se sube uno nuevo
            $comprobante = $alquiler['alquiler_comprobante_pago'];
            
            if (isset($_FILES['alquiler_comprobante_pago']) && $_FILES['alquiler_comprobante_pago']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'public/uploads/comprobantes/';
                
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                $nombreArchivo = time() . '_' . basename($_FILES['alquiler_comprobante_pago']['name']);
                $rutaArchivo = $uploadDir . $nombreArchivo;
                
                $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'pdf'];
                $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
                
                if (in_array($extension, $extensionesPermitidas) && move_uploaded_file($_FILES['alquiler_comprobante_pago']['tmp_name'], $rutaArchivo)) {
                    // Eliminar archivo anterior si existe
                    if (!empty($alquiler['alquiler_comprobante_pago']) && file_exists($alquiler['alquiler_comprobante_pago'])) {
                        unlink($alquiler['alquiler_comprobante_pago']);
                    }
                    $comprobante = $rutaArchivo;
                }
            }
            
            // Método de pago (solo admin)
            $metodoPago = (!empty($_POST['metodo_pago']) && $_SESSION['rol'] == 1) ? $_POST['metodo_pago'] : ($alquiler['metodo_pago'] ?? 'transferencia');
            $montoEfectivo = null;

            if ($_SESSION['rol'] == 1 && $metodoPago === 'efectivo') {
                $montoEfectivo = isset($_POST['monto_efectivo']) ? floatval($_POST['monto_efectivo']) : 0;

                if ($montoEfectivo <= 0) {
                    $_SESSION['error'] = 'El monto en efectivo es obligatorio y debe ser mayor a 0.';
                    header("Location: " . URL . "index.php?c=Alquiler&a=editar&id=" . $_GET['id']);
                    exit();
                }

                if (empty($comprobante) && (!isset($_FILES['alquiler_comprobante_pago']) || $_FILES['alquiler_comprobante_pago']['error'] !== UPLOAD_ERR_OK)) {
                    $_SESSION['error'] = 'Debes subir la evidencia del pago en efectivo.';
                    header("Location: " . URL . "index.php?c=Alquiler&a=editar&id=" . $_GET['id']);
                    exit();
                }
            }

            $datos = [
                'usuario_id' => $alquiler['usuario_id'],
                'cancha_id' => $_POST['cancha_id'],
                'estado_id' => $_POST['estado_id'],
                'alquiler_fecha' => $_POST['alquiler_fecha'],
                'alquiler_hora_inicial' => $_POST['alquiler_hora_inicial'],
                'alquiler_hora_final' => $_POST['alquiler_hora_final'],
                'alquiler_valor' => $_POST['alquiler_valor'],
                'alquiler_comprobante_pago' => $comprobante,
                'metodo_pago' => $metodoPago,
                'monto_efectivo' => $montoEfectivo
            ];

            if ($alquilerModel->actualizar($_GET['id'], $datos)) {
                $_SESSION['mensaje'] = 'Alquiler actualizado exitosamente';
                if ($_SESSION['rol'] == 1) {
                    header("Location: " . URL . "index.php?c=Alquiler&a=index");
                } else {
                    header("Location: " . URL . "index.php?c=Alquiler&a=misAlquileres");
                }
                exit();
            } else {
                $_SESSION['error'] = 'Error al actualizar el alquiler';
            }
        }

        include 'app/views/alquileres/editar.php';
    }

    public function eliminar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URL . "index.php?c=Auth&a=login");
            exit();
        }

        if (!isset($_GET['id'])) {
            header("Location: " . URL . "index.php?c=Alquiler&a=misAlquileres");
            exit();
        }

        $alquilerModel = new Alquiler();
        $alquiler = $alquilerModel->obtenerPorId($_GET['id']);

        // Solo el propietario o admin puede eliminar
        if (!$alquiler || ($alquiler['usuario_id'] != $_SESSION['user_id'] && $_SESSION['rol'] != 1)) {
            $_SESSION['error'] = 'No tienes permiso para eliminar este alquiler';
            header("Location: " . URL . "index.php?c=Alquiler&a=misAlquileres");
            exit();
        }

        if ($alquilerModel->eliminar($_GET['id'])) {
            // Eliminar comprobante de pago si existe
            if (!empty($alquiler['alquiler_comprobante_pago']) && file_exists($alquiler['alquiler_comprobante_pago'])) {
                unlink($alquiler['alquiler_comprobante_pago']);
            }
            $_SESSION['mensaje'] = 'Alquiler eliminado exitosamente';
        } else {
            $_SESSION['error'] = 'Error al eliminar el alquiler';
        }

        header("Location: " . URL . "index.php?c=Alquiler&a=misAlquileres");
        exit();
    }

    // RF18: Aprobar alquiler (Admin)
    public function aprobar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Solo admin
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 1) {
            header("Location: " . URL . "index.php");
            exit();
        }

        if (!isset($_GET['id'])) {
            header("Location: " . URL . "index.php?c=Alquiler&a=index");
            exit();
        }

        $alquilerModel = new Alquiler();
        
        // Cambiar estado a "aprobado" (ID = 2)
        if ($alquilerModel->cambiarEstado($_GET['id'], 2)) {
            $_SESSION['mensaje'] = 'Alquiler aprobado exitosamente';
        } else {
            $_SESSION['error'] = 'Error al aprobar el alquiler';
        }

        header("Location: " . URL . "index.php?c=Alquiler&a=index");
        exit();
    }

    // Finalizar alquiler
    public function finalizar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 1) {
            header("Location: " . URL . "index.php");
            exit();
        }

        if (!isset($_GET['id'])) {
            header("Location: " . URL . "index.php?c=Alquiler&a=index");
            exit();
        }

        $alquilerModel = new Alquiler();
        
        // Cambiar estado a "finalizado" (ID = 3)
        if ($alquilerModel->cambiarEstado($_GET['id'], 3)) {
            $_SESSION['mensaje'] = 'Alquiler finalizado exitosamente';
        } else {
            $_SESSION['error'] = 'Error al finalizar el alquiler';
        }

        header("Location: " . URL . "index.php?c=Alquiler&a=index");
        exit();
    }

    // Cancelar alquiler
    public function cancelar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 1) {
            header("Location: " . URL . "index.php");
            exit();
        }

        if (!isset($_GET['id'])) {
            header("Location: " . URL . "index.php?c=Alquiler&a=index");
            exit();
        }

        $alquilerModel = new Alquiler();
        
        // Cambiar estado a "cancelado" (ID = 5)
        if ($alquilerModel->cambiarEstado($_GET['id'], 5)) {
            $_SESSION['mensaje'] = 'Alquiler cancelado exitosamente';
        } else {
            $_SESSION['error'] = 'Error al cancelar el alquiler';
        }

        header("Location: " . URL . "index.php?c=Alquiler&a=index");
        exit();
    }

    // RF14: Obtener horas ocupadas de una cancha en una fecha específica (AJAX)
    public function obtenerHorasOcupadas() {
        header('Content-Type: application/json');
        
        if (!isset($_GET['fecha'])) {
            echo json_encode(['error' => 'Falta la fecha']);
            exit();
        }

        $alquilerModel = new Alquiler();
        if (isset($_GET['cancha_id']) && $_GET['cancha_id'] !== '') {
            $horasOcupadas = $alquilerModel->obtenerHorasOcupadasPorCanchaYFecha(
                $_GET['cancha_id'],
                $_GET['fecha']
            );
            $horas = $alquilerModel->obtenerHoras();
            $todasLasHoras = array_map(function($hora) {
                return $hora['hora'];
            }, $horas ?? []);

            $horasDisponibles = array_values(array_diff($todasLasHoras, $horasOcupadas));

            echo json_encode([
                'ocupadas' => array_values($horasOcupadas),
                'disponibles' => $horasDisponibles
            ]);
            exit();
        }

        $ocupadasPorCancha = $alquilerModel->obtenerHorasOcupadasPorFecha($_GET['fecha']);
        echo json_encode([
            'por_cancha' => $ocupadasPorCancha
        ]);
        exit();
    }
}
?>
