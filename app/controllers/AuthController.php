<?php
// 1. Cargamos la configuración y la conexión
require_once __DIR__ . '/../../app/config/config.php';
require_once __DIR__ . '/../models/Conexion.php';

class AuthController {

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            
            $baseDatos = new Conexion();
            $conexion = $baseDatos->conectar();

            $email = trim($_POST['usuario']); 
            $password = trim($_POST['password']);

            if (!empty($email) && !empty($password)) {
                try {
                    $query = "SELECT u.*, r.nombre AS rol_nombre 
                              FROM usuarios u 
                              JOIN roles r ON u.rol_id = r.id 
                              WHERE u.email = :email AND u.estado = 'activo' 
                              LIMIT 1";
                    
                    $stmt = $conexion->prepare($query);
                    $stmt->bindParam(':email', $email);
                    $stmt->execute();
                    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Verificamos si existe el usuario y la contraseña coincide
                    if ($usuario && password_verify($password, $usuario['password'])) {
                        $_SESSION['user_id'] = $usuario['id'];
                        $_SESSION['user_nombre'] = $usuario['nombre'];
                        $_SESSION['rol'] = $usuario['rol_nombre'];

                        // REDIRECCIÓN: Ahora que usamos el index de la raíz como entrada:
                        header("Location: " . URL);
                        exit;
                    } else {
                        echo "<script>alert('Credenciales incorrectas'); window.location.href='".URL."app/views/auth/login.php';</script>";
                    }
                } catch (PDOException $e) {
                    error_log("Error en login: " . $e->getMessage());
                    echo "Error crítico en el servidor.";
                }
            }
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header("Location: " . URL . "app/views/auth/login.php");
        exit();
    }
}

// ==========================================================
// LÓGICA DE ENRUTAMIENTO (Esto activa el controlador)
// ==========================================================
$auth = new AuthController();

// Detectamos la acción que viene por la URL (?action=...)
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'login') {
        $auth->login();
    } elseif ($_GET['action'] == 'logout') {
        $auth->logout();
    }
}