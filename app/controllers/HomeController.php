<?php
require_once 'app/models/Reserva.php';
require_once 'app/models/Cancha.php';
require_once 'app/models/Usuario.php';

class HomeController {
    
    public function index() {
        // Iniciar sesión solo si no está activa
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Verificar si el usuario está logueado
        if (!isset($_SESSION['user_id'])) {
            // Si no está logueado, mostrar página pública
            $this->paginaPublica();
            return;
        }

        $rol = $_SESSION['rol'];
        $userId = $_SESSION['user_id'];
        $nombreUsuario = $_SESSION['user_nombre'];

        // Obtener datos según el rol
        if ($rol === 'admin') {
            $this->dashboardAdmin();
        } elseif ($rol === 'cliente') {
            $this->dashboardCliente($userId);
        } elseif ($rol === 'encargado') {
            $this->dashboardEncargado();
        }
    }

    private function paginaPublica() {
        // Cargar la página principal pública
        include 'app/views/home/index.php';
    }

    private function dashboardAdmin() {
        // Obtener estadísticas
        $reservaModel = new Reserva();
        $canchaModel = new Cancha();
        $usuarioModel = new Usuario();

        $totalReservas = count($reservaModel->obtenerTodas());
        $totalCanchas = count($canchaModel->obtenerTodas());
        $totalUsuarios = count($usuarioModel->obtenerTodos());
        $reservasRecientes = array_slice($reservaModel->obtenerTodas(), 0, 5);

        // Cargar la vista del dashboard admin
        include 'app/views/home/dashboard_admin.php';
    }

    private function dashboardCliente($userId) {
        // Obtener datos del cliente
        $reservaModel = new Reserva();
        $misReservas = $reservaModel->obtenerPorUsuario($userId);
        $reservasActivas = array_filter($misReservas, function($r) {
            return $r['estado'] !== 'cancelada' && $r['estado'] !== 'completada';
        });

        // Cargar la vista del dashboard cliente
        include 'app/views/home/dashboard_cliente.php';
    }

    private function dashboardEncargado() {
        // Obtener datos para el encargado
        $reservaModel = new Reserva();
        $canchaModel = new Cancha();
        
        $reservasHoy = $reservaModel->obtenerTodas(); // Aquí filtrar por hoy
        $totalCanchas = count($canchaModel->obtenerTodas());
        $reservasPendientes = array_filter($reservaModel->obtenerTodas(), function($r) {
            return $r['estado'] === 'pendiente';
        });

        // Cargar la vista del dashboard encargado
        include 'app/views/home/dashboard_encargado.php';
    }
}
