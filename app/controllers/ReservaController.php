<?php
require_once 'app/models/Reserva.php';
require_once 'app/models/Cancha.php';
require_once 'app/models/Usuario.php';

class ReservaController {
    
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URL . "app/views/auth/login.php");
            exit();
        }

        $reservaModel = new Reserva();
        $rol = $_SESSION['rol'];
        $userId = $_SESSION['user_id'];

        if ($rol === 'admin' || $rol === 'encargado') {
            $reservas = $reservaModel->obtenerTodas();
        } else {
            $reservas = $reservaModel->obtenerPorUsuario($userId);
        }

        include 'app/views/reservas/index.php';
    }

    public function misReservas() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URL . "app/views/auth/login.php");
            exit();
        }

        $reservaModel = new Reserva();
        $reservas = $reservaModel->obtenerPorUsuario($_SESSION['user_id']);

        include 'app/views/reservas/index.php';
    }

    public function crear() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URL . "app/views/auth/login.php");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reservaModel = new Reserva();
            
            $datos = [
                'usuario_id' => $_SESSION['user_id'],
                'cancha_id' => $_POST['cancha_id'],
                'fecha' => $_POST['fecha'],
                'hora_inicio' => $_POST['hora_inicio'],
                'hora_fin' => $_POST['hora_fin'],
                'precio_total' => $_POST['precio_total'] ?? 0,
                'estado' => 'pendiente'
            ];

            if ($reservaModel->crear($datos)) {
                $_SESSION['mensaje'] = 'Reserva creada exitosamente';
                header("Location: " . URL . "index.php?c=Reserva&a=index");
                exit();
            } else {
                $_SESSION['error'] = 'Error al crear la reserva';
            }
        }

        $canchaModel = new Cancha();
        $canchas = $canchaModel->obtenerTodas();

        include 'app/views/reservas/crear.php';
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
            header("Location: " . URL . "index.php?c=Reserva&a=index");
            exit();
        }

        $reservaModel = new Reserva();
        $reserva = $reservaModel->obtenerPorId($_GET['id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'id' => $_GET['id'],
                'cancha_id' => $_POST['cancha_id'],
                'fecha' => $_POST['fecha'],
                'hora_inicio' => $_POST['hora_inicio'],
                'hora_fin' => $_POST['hora_fin'],
                'precio_total' => $_POST['precio_total'],
                'estado' => $_POST['estado']
            ];

            if ($reservaModel->actualizar($datos)) {
                $_SESSION['mensaje'] = 'Reserva actualizada exitosamente';
                header("Location: " . URL . "index.php?c=Reserva&a=index");
                exit();
            } else {
                $_SESSION['error'] = 'Error al actualizar la reserva';
            }
        }

        $canchaModel = new Cancha();
        $canchas = $canchaModel->obtenerTodas();

        include 'app/views/reservas/editar.php';
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
            header("Location: " . URL . "index.php?c=Reserva&a=index");
            exit();
        }

        $reservaModel = new Reserva();
        
        if ($reservaModel->eliminar($_GET['id'])) {
            $_SESSION['mensaje'] = 'Reserva eliminada exitosamente';
        } else {
            $_SESSION['error'] = 'Error al eliminar la reserva';
        }

        header("Location: " . URL . "index.php?c=Reserva&a=index");
        exit();
    }

    public function detalle() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URL . "app/views/auth/login.php");
            exit();
        }

        if (!isset($_GET['id'])) {
            header("Location: " . URL . "index.php?c=Reserva&a=index");
            exit();
        }

        $reservaModel = new Reserva();
        $reserva = $reservaModel->obtenerPorId($_GET['id']);

        if (!$reserva) {
            $_SESSION['error'] = 'Reserva no encontrada';
            header("Location: " . URL . "index.php?c=Reserva&a=index");
            exit();
        }

        // Verificar permisos
        if ($_SESSION['rol'] === 'cliente' && $reserva['usuario_id'] != $_SESSION['user_id']) {
            $_SESSION['error'] = 'No tienes permiso para ver esta reserva';
            header("Location: " . URL . "index.php?c=Reserva&a=index");
            exit();
        }

        include 'app/views/reservas/detalle.php';
    }
}
