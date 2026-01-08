<?php
session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['usuario']); // El input del login envía el email aquí
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        try {
            // Consulta que une usuarios con sus nombres de rol
            $query = "SELECT u.*, r.nombre AS rol_nombre 
                      FROM usuarios u 
                      JOIN roles r ON u.rol_id = r.id 
                      WHERE u.email = :email AND u.estado = 'activo' 
                      LIMIT 1";
            
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificación con password_verify para el VARCHAR(255) de tu SQL
            if ($usuario && password_verify($password, $usuario['password'])) {
                $_SESSION['user_id'] = $usuario['id'];
                $_SESSION['user_nombre'] = $usuario['nombre'];
                $_SESSION['rol'] = $usuario['rol_nombre'];

                // Redirigir según el rol
                switch ($_SESSION['rol']) {
                    case 'admin':
                        header("Location: ../admin_dashboard.php");
                        break;
                    case 'encargado':
                        header("Location: ../encargado_dashboard.php");
                        break;
                    case 'cliente':
                        header("Location: ../cliente_dashboard.php");
                        break;
                    default:
                        // Si el rol no es reconocido, cerrar sesión
                        session_destroy();
                        echo "<script>alert('Rol no reconocido. Contacte al administrador.'); window.location.href='../login.php';</script>";
                        break;
                }
                exit;
            } else {
                echo "<script>alert('Credenciales incorrectas o usuario inactivo'); window.location.href='../login.php';</script>";
            }
        } catch (PDOException $e) {
            error_log("Error en login: " . $e->getMessage());
            echo "Ocurrió un error en el servidor.";
        }
    }
}
?>