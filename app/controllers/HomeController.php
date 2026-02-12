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
        
        // VERIFICACIÓN: Si no hay sesión o falta el rol, cargamos home público
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['rol'])) {
            session_unset();
            $this->mostrarHomePublico();
            return;
        }

        $rol = $_SESSION['rol']; // Recuerda que en AuthController pusimos el ID (1, 2 o 3)
        $userId = $_SESSION['user_id'];

        // Redirección por ROL (Usando los IDs de la base de datos que insertamos)
        if ($rol == 1) { // Admin
            $this->dashboardAdmin();
        } elseif ($rol == 2) { // Cliente
            $this->dashboardCliente($userId);
        } elseif ($rol == 3) { // Encargado
            $this->dashboardEncargado();
        } else {
            // Si el rol es desconocido, mostrar el home normal
            $this->mostrarHomePublico();
        }
    }

    private function mostrarHomePublico() {
        // Obtener noticias activas
        require_once 'app/models/Noticia.php';
        $noticiaModel = new Noticia();
        $noticias = $noticiaModel->obtenerActivas(6); // Obtener últimas 6 noticias activas

        // Obtener canchas activas para disponibilidad
        require_once 'app/models/Cancha.php';
        $canchaModel = new Cancha();
        $canchas = $canchaModel->obtenerActivas();
        
        // Cargar vista pública con el diseño completo
        include 'app/views/home/pagina_publica.php';
    }

    private function dashboardAdmin() {
        require_once 'app/models/Alquiler.php';
        
        $alquilerModel = new Alquiler();
        $canchaModel = new Cancha();
        $usuarioModel = new Usuario();

        // Datos totales
        $todasCanchas = $canchaModel->obtenerTodas() ?? [];
        $todosUsuarios = $usuarioModel->obtenerTodos() ?? [];
        $totalCanchas = count($todasCanchas);
        $totalUsuarios = count($todosUsuarios);
        
        // Alquileres (usando tabla de alquileres en lugar de reservas)
        $alquileresRecientes = $alquilerModel->obtenerAlquileresRecientes(10);
        $alquileresPendientes = $alquilerModel->obtenerAlquileresPendientes();
        $totalAlquileres = count($alquilerModel->obtenerTodos() ?? []);
        
        // Ingresos del mes actual
        $ingresosDelMes = $alquilerModel->obtenerIngresosDelMes();
        
        // Datos para gráfico de progreso mensual
        $datosGrafico = $alquilerModel->obtenerDatosGraficoMeses();

        include 'app/views/home/dashboard_admin.php';
    }

    private function dashboardCliente($userId) {
        require_once 'app/models/Alquiler.php';
        
        $alquilerModel = new Alquiler();
        
        // RF03: Obtener estadísticas completas del cliente
        $estadisticas = $alquilerModel->obtenerEstadisticasCliente($userId);
        
        // Pasar a la vista
        $ultimos_alquileres = $estadisticas['ultimos_alquileres'];
        $total_alquileres = $estadisticas['total_alquileres'];
        $total_gastado = $estadisticas['total_gastado'];
        $total_horas = $estadisticas['total_horas'];
        
        include 'app/views/home/dashboard_cliente.php';
    }

    private function dashboardEncargado() {
        require_once 'app/models/Alquiler.php';
        
        $alquilerModel = new Alquiler();
        $canchaModel = new Cancha();
        
        // Obtener reservas pendientes de aprobación
        $reservasPendientes = $alquilerModel->obtenerAlquileresPendientes() ?? [];
        
        // Obtener reservas/alquileres del día de hoy
        $reservasHoy = $alquilerModel->obtenerAlquileresHoy() ?? [];
        
        // Total de canchas
        $totalCanchas = count($canchaModel->obtenerTodas() ?? []);
        
        include 'app/views/home/dashboard_encargado.php';
    }
}