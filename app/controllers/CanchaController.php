<?php
require_once 'app/models/Cancha.php';

class CanchaController {
    
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URL . "app/views/auth/login.php");
            exit();
        }

        $canchaModel = new Cancha();
        $canchas = $canchaModel->obtenerTodas();

        include 'app/views/canchas/index.php';
    }

    public function crear() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Roles: 1=admin, 3=encargado
        if (!isset($_SESSION['user_id']) || ($_SESSION['rol'] !== 1 && $_SESSION['rol'] !== 3)) {
            header("Location: " . URL . "index.php");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $canchaModel = new Cancha();
            
            $datos = [
                'nombre' => $_POST['nombre'],
                'tipo' => $_POST['tipo'],
                'precio_hora' => $_POST['precio_hora'],
                'estado' => $_POST['estado'] ?? 'disponible',
                'imagen' => ''
            ];

            // Manejar subida de imagen
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $directorioDestino = 'public/img/canchas/';
                $extension = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
                $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];
                
                if (in_array($extension, $extensionesPermitidas)) {
                    $nombreArchivo = uniqid('cancha_') . '.' . $extension;
                    $rutaCompleta = $directorioDestino . $nombreArchivo;
                    
                    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaCompleta)) {
                        $datos['imagen'] = $nombreArchivo;
                    } else {
                        $_SESSION['error'] = 'Error al subir la imagen';
                    }
                } else {
                    $_SESSION['error'] = 'Formato de imagen no permitido. Use: JPG, PNG, GIF, WEBP o BMP';
                }
            }

            if ($canchaModel->crear($datos)) {
                $_SESSION['mensaje'] = 'Cancha creada exitosamente';
                header("Location: " . URL . "index.php?c=Cancha&a=index");
                exit();
            } else {
                $_SESSION['error'] = 'Error al crear la cancha';
            }
        }

        include 'app/views/canchas/crear.php';
    }

    public function editar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id']) || ($_SESSION['rol'] !== 1 && $_SESSION['rol'] !== 3)) {
            header("Location: " . URL . "index.php");
            exit();
        }

        if (!isset($_GET['id'])) {
            header("Location: " . URL . "index.php?c=Cancha&a=index");
            exit();
        }

        $canchaModel = new Cancha();
        $cancha = $canchaModel->obtenerPorId($_GET['id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'id' => $_GET['id'],
                'nombre' => $_POST['nombre'],
                'tipo' => $_POST['tipo'],
                'precio_hora' => $_POST['precio_hora'],
                'estado' => $_POST['estado'],
                'imagen' => $cancha['imagen'] ?? '' // Mantener imagen actual
            ];

            // Eliminar imagen anterior si se solicita
            if (isset($_POST['eliminar_imagen']) && !empty($cancha['imagen'])) {
                $rutaImagenAnterior = 'public/img/canchas/' . $cancha['imagen'];
                if (file_exists($rutaImagenAnterior)) {
                    unlink($rutaImagenAnterior);
                }
                $datos['imagen'] = '';
            }

            // Manejar subida de nueva imagen
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $directorioDestino = 'public/img/canchas/';
                $extension = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
                $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];
                
                if (in_array($extension, $extensionesPermitidas)) {
                    // Eliminar imagen anterior si existe
                    if (!empty($cancha['imagen'])) {
                        $rutaImagenAnterior = $directorioDestino . $cancha['imagen'];
                        if (file_exists($rutaImagenAnterior)) {
                            unlink($rutaImagenAnterior);
                        }
                    }
                    
                    $nombreArchivo = uniqid('cancha_') . '.' . $extension;
                    $rutaCompleta = $directorioDestino . $nombreArchivo;
                    
                    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaCompleta)) {
                        $datos['imagen'] = $nombreArchivo;
                    } else {
                        $_SESSION['error'] = 'Error al subir la imagen';
                    }
                } else {
                    $_SESSION['error'] = 'Formato de imagen no permitido. Use: JPG, PNG, GIF, WEBP o BMP';
                }
            }

            if ($canchaModel->actualizar($datos)) {
                $_SESSION['mensaje'] = 'Cancha actualizada exitosamente';
                header("Location: " . URL . "index.php?c=Cancha&a=index");
                exit();
            } else {
                $_SESSION['error'] = 'Error al actualizar la cancha';
            }
        }

        include 'app/views/canchas/editar.php';
    }

    public function eliminar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 1) {
            header("Location: " . URL . "index.php");
            exit();
        }

        if (!isset($_GET['id'])) {
            header("Location: " . URL . "index.php?c=Cancha&a=index");
            exit();
        }

        $canchaModel = new Cancha();
        
        if ($canchaModel->eliminar($_GET['id'])) {
            $_SESSION['mensaje'] = 'Cancha eliminada exitosamente';
        } else {
            $_SESSION['error'] = 'Error al eliminar la cancha';
        }

        header("Location: " . URL . "index.php?c=Cancha&a=index");
        exit();
    }
}
