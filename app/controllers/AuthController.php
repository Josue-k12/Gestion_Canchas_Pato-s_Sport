<?php
// Requerimos el modelo de conexión que ya configuraste
require_once __DIR__ . '/../models/Conexion.php';

class AuthController {

    // Aquí va la lógica de procesar_login.php
    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            session_start();
            
            // Usamos la clase Conexion profesional que ya creamos
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

                    if ($usuario && password_verify($password, $usuario['password'])) {
                        $_SESSION['user_id'] = $usuario['id'];
                        $_SESSION['user_nombre'] = $usuario['nombre'];
                        $_SESSION['rol'] = $usuario['rol_nombre'];

                        // Redirección profesional usando la constante URL de tu config.php
                        header("Location: " . URL . "app/views/home/index.php");
                        exit;
                    } else {
                        echo "<script>alert('Credenciales incorrectas'); window.location.href='".URL."';</script>";
                    }
                } catch (PDOException $e) {
                    error_log("Error en login: " . $e->getMessage());
                    echo "Error en el servidor.";
                }
            }
        }
    }

    // Aquí va la lógica de logout.php
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        // Redirige al inicio (donde está el login) usando tu constante URL
        header("Location: " . URL);
        exit();
    }
}