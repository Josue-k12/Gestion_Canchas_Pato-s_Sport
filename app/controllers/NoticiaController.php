<?php
require_once 'app/models/Noticia.php';

class NoticiaController {
    
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 1) {
            header("Location: " . URL . "index.php");
            exit();
        }

        $noticiaModel = new Noticia();
        $noticias = $noticiaModel->obtenerTodas();

        include 'app/views/noticias/index.php';
    }

    public function crear() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 1) {
            header("Location: " . URL . "index.php");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesar imagen si se sube
            $imagen = null;
            
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'public/img/';
                
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                $nombreArchivo = time() . '_' . basename($_FILES['imagen']['name']);
                $rutaArchivo = $uploadDir . $nombreArchivo;
                
                $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
                $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
                
                if (in_array($extension, $extensionesPermitidas) && move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaArchivo)) {
                    $imagen = $nombreArchivo;
                }
            }

            $datos = [
                'titulo' => $_POST['titulo'],
                'descripcion' => $_POST['descripcion'] ?? '',
                'contenido' => $_POST['contenido'],
                'imagen' => $imagen,
                'autor' => $_SESSION['user_id'],
                'estado' => $_POST['estado'] ?? 'activa'
            ];

            $noticiaModel = new Noticia();
            if ($noticiaModel->crear($datos)) {
                $_SESSION['mensaje'] = 'Noticia creada exitosamente';
                header("Location: " . URL . "index.php?c=Noticia&a=index");
                exit();
            } else {
                $_SESSION['error'] = 'Error al crear la noticia';
            }
        }

        include 'app/views/noticias/crear.php';
    }

    public function editar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 1) {
            header("Location: " . URL . "index.php");
            exit();
        }

        if (!isset($_GET['id'])) {
            header("Location: " . URL . "index.php?c=Noticia&a=index");
            exit();
        }

        $noticiaModel = new Noticia();
        $noticia = $noticiaModel->obtenerPorId($_GET['id']);

        if (!$noticia) {
            $_SESSION['error'] = 'Noticia no encontrada';
            header("Location: " . URL . "index.php?c=Noticia&a=index");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imagen = $noticia['imagen'];
            
            // Procesar nueva imagen si se sube
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'public/img/';
                
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                $nombreArchivo = time() . '_' . basename($_FILES['imagen']['name']);
                $rutaArchivo = $uploadDir . $nombreArchivo;
                
                $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
                $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
                
                if (in_array($extension, $extensionesPermitidas) && move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaArchivo)) {
                    // Eliminar imagen anterior si existe
                    if (!empty($noticia['imagen']) && file_exists('public/img/' . $noticia['imagen'])) {
                        unlink('public/img/' . $noticia['imagen']);
                    }
                    $imagen = $nombreArchivo;
                }
            }

            $datos = [
                'titulo' => $_POST['titulo'],
                'descripcion' => $_POST['descripcion'] ?? '',
                'contenido' => $_POST['contenido'],
                'imagen' => $imagen,
                'estado' => $_POST['estado'] ?? 'activa'
            ];

            if ($noticiaModel->actualizar($_GET['id'], $datos)) {
                $_SESSION['mensaje'] = 'Noticia actualizada exitosamente';
                header("Location: " . URL . "index.php?c=Noticia&a=index");
                exit();
            } else {
                $_SESSION['error'] = 'Error al actualizar la noticia';
            }
        }

        include 'app/views/noticias/editar.php';
    }

    public function eliminar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 1) {
            header("Location: " . URL . "index.php");
            exit();
        }

        if (!isset($_GET['id'])) {
            header("Location: " . URL . "index.php?c=Noticia&a=index");
            exit();
        }

        $noticiaModel = new Noticia();
        $noticia = $noticiaModel->obtenerPorId($_GET['id']);

        if ($noticia && !empty($noticia['imagen']) && file_exists('public/img/' . $noticia['imagen'])) {
            unlink('public/img/' . $noticia['imagen']);
        }

        if ($noticiaModel->eliminar($_GET['id'])) {
            $_SESSION['mensaje'] = 'Noticia eliminada exitosamente';
        } else {
            $_SESSION['error'] = 'Error al eliminar la noticia';
        }

        header("Location: " . URL . "index.php?c=Noticia&a=index");
        exit();
    }
}
?>
