<?php
require_once 'app/models/Reserva.php';
require_once 'app/models/Cancha.php';

class CalendarioController {
    
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Verificar si el usuario está logueado
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URL . "app/views/auth/login.php");
            exit();
        }

        $rol = $_SESSION['rol'];
        $userId = $_SESSION['user_id'];

        // Obtener reservas según el rol
        $reservaModel = new Reserva();
        
        if ($rol === 'admin' || $rol === 'encargado') {
            // Admin y encargado ven todas las reservas
            $reservas = $reservaModel->obtenerTodas();
        } else {
            // Cliente solo ve sus propias reservas
            $reservas = $reservaModel->obtenerPorUsuario($userId);
        }

        // Incluir la vista del calendario
        include 'app/views/calendario/index.php';
    }

    public function obtenerEventos() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        header('Content-Type: application/json');
        
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['error' => 'No autorizado']);
            exit();
        }

        $rol = $_SESSION['rol'];
        $userId = $_SESSION['user_id'];

        $reservaModel = new Reserva();
        
        if ($rol === 'admin' || $rol === 'encargado') {
            $reservas = $reservaModel->obtenerTodas();
        } else {
            $reservas = $reservaModel->obtenerPorUsuario($userId);
        }

        // Convertir reservas a formato FullCalendar
        $eventos = [];
        foreach ($reservas as $reserva) {
            $color = '';
            switch ($reserva['estado']) {
                case 'confirmada':
                    $color = '#28a745'; // Verde
                    break;
                case 'pendiente':
                    $color = '#ffc107'; // Amarillo
                    break;
                case 'cancelada':
                    $color = '#dc3545'; // Rojo
                    break;
                default:
                    $color = '#6c757d'; // Gris
            }

            $eventos[] = [
                'id' => $reserva['id'],
                'title' => $reserva['cancha_nombre'] . ' - ' . $reserva['cliente_nombre'],
                'start' => $reserva['fecha'] . 'T' . $reserva['hora_inicio'],
                'end' => $reserva['fecha'] . 'T' . $reserva['hora_fin'],
                'backgroundColor' => $color,
                'borderColor' => $color,
                'extendedProps' => [
                    'cancha' => $reserva['cancha_nombre'],
                    'cliente' => $reserva['cliente_nombre'],
                    'estado' => $reserva['estado'],
                    'precio' => $reserva['precio_total']
                ]
            ];
        }

        echo json_encode($eventos);
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
            header("Location: " . URL . "index.php?c=Calendario&a=index");
            exit();
        }

        $reservaModel = new Reserva();
        $reserva = $reservaModel->obtenerPorId($_GET['id']);

        if (!$reserva) {
            $_SESSION['error'] = 'Reserva no encontrada';
            header("Location: " . URL . "index.php?c=Calendario&a=index");
            exit();
        }

        // Verificar permisos
        $rol = $_SESSION['rol'];
        $userId = $_SESSION['user_id'];

        if ($rol === 'cliente' && $reserva['usuario_id'] != $userId) {
            $_SESSION['error'] = 'No tienes permiso para ver esta reserva';
            header("Location: " . URL . "index.php?c=Calendario&a=index");
            exit();
        }

        include 'app/views/calendario/detalle.php';
    }
}
