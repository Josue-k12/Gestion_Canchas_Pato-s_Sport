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

        $alquilerModel = new Alquiler();
        $canchaModel = new Cancha();
        
        $canchas = $canchaModel->obtenerTodas();
        $precioHora = $alquilerModel->obtenerConfiguracion();
        $estados = $alquilerModel->obtenerEstados();
        $horas = $alquilerModel->obtenerHoras();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
                return $e['nombre'] === 'registrado';
            });
            $estadoId = reset($estadoRegistrado)['id'] ?? 1;
            
            $datos = [
                'usuario_id' => $_SESSION['user_id'],
                'cancha_id' => $_POST['cancha_id'],
                'estado_id' => $estadoId,
                'alquiler_fecha' => $_POST['alquiler_fecha'],
                'alquiler_hora_inicial' => $_POST['alquiler_hora_inicial'],
                'alquiler_hora_final' => $_POST['alquiler_hora_final'],
                'alquiler_valor' => $precioTotal,
                'alquiler_comprobante_pago' => $comprobante
            ];

            if ($alquilerModel->crear($datos)) {
                $_SESSION['mensaje'] = 'Alquiler creado exitosamente';
                header("Location: " . URL . "index.php?c=Alquiler&a=misAlquileres");
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
            
            $datos = [
                'usuario_id' => $_SESSION['user_id'],
                'cancha_id' => $_POST['cancha_id'],
                'estado_id' => $_POST['estado_id'],
                'alquiler_fecha' => $_POST['alquiler_fecha'],
                'alquiler_hora_inicial' => $_POST['alquiler_hora_inicial'],
                'alquiler_hora_final' => $_POST['alquiler_hora_final'],
                'alquiler_valor' => $_POST['alquiler_valor'],
                'alquiler_comprobante_pago' => $comprobante
            ];

            if ($alquilerModel->actualizar($_GET['id'], $datos)) {
                $_SESSION['mensaje'] = 'Alquiler actualizado exitosamente';
                header("Location: " . URL . "index.php?c=Alquiler&a=misAlquileres");
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
}
?>
