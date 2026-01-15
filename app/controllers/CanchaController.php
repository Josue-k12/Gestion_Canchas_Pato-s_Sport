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
        
        if (!isset($_SESSION['user_id']) || ($_SESSION['rol'] !== 'admin' && $_SESSION['rol'] !== 'encargado')) {
            header("Location: " . URL . "index.php");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $canchaModel = new Cancha();
            
            $datos = [
                'nombre' => $_POST['nombre'],
                'tipo' => $_POST['tipo'],
                'capacidad' => $_POST['capacidad'],
                'precio_hora' => $_POST['precio_hora'],
                'descripcion' => $_POST['descripcion'] ?? '',
                'estado' => $_POST['estado'] ?? 'activa'
            ];

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
        
        if (!isset($_SESSION['user_id']) || ($_SESSION['rol'] !== 'admin' && $_SESSION['rol'] !== 'encargado')) {
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
                'capacidad' => $_POST['capacidad'],
                'precio_hora' => $_POST['precio_hora'],
                'descripcion' => $_POST['descripcion'] ?? '',
                'estado' => $_POST['estado']
            ];

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
        
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'admin') {
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
