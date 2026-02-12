<?php
// Ya no necesitamos require_once de la configuración aquí, 
// porque el index.php de la raíz ya lo hace.

class AuthController {

    // 1. Esta función ahora SÍ muestra el formulario cuando entras por primera vez
    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Si ya está logueado, mandarlo al inicio
        if (isset($_SESSION['user_id'])) {
            header("Location: " . URL);
            exit;
        }

        // Si el usuario envía el formulario (POST)
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            require_once 'app/models/Conexion.php';
            $baseDatos = new Conexion();
            $conexion = $baseDatos->conectar();

            $email = trim($_POST['usuario']); 
            $password = trim($_POST['password']);

            if (!empty($email) && !empty($password)) {
                try {
                    // Mantenemos el JOIN que hizo tu compañero para traer el nombre del rol
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
                        // Guardamos el ID numérico para el HomeController
                        $_SESSION['rol'] = $usuario['rol_id']; 
                        $_SESSION['rol_nombre'] = $usuario['rol_nombre'];

                        header("Location: " . URL . "index.php?c=Home&a=index");
                        exit;
                    } else {
                        echo "<script>alert('Credenciales incorrectas'); window.location.href='".URL."index.php?c=Auth&a=login';</script>";
                        exit;
                    }
                } catch (PDOException $e) {
                    error_log("Error en login: " . $e->getMessage());
                    die("Error crítico en el servidor.");
                }
            }
        }

        // SI NO ES POST, simplemente cargamos la vista del login
        include 'app/views/auth/login.php';
    }

    public function register() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Si ya está logueado, mandarlo al inicio
        if (isset($_SESSION['user_id'])) {
            header("Location: " . URL);
            exit;
        }

        // Si el usuario envía el formulario (POST)
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            require_once 'app/models/Usuario.php';
            require_once 'app/models/Conexion.php';

            $nombre = trim($_POST['nombre']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $passwordConfirm = trim($_POST['password_confirm']);

            // Validaciones
            if (empty($nombre) || empty($email) || empty($password)) {
                echo "<script>alert('Todos los campos son obligatorios'); window.history.back();</script>";
                exit;
            }

            if ($password !== $passwordConfirm) {
                echo "<script>alert('Las contraseñas no coinciden'); window.history.back();</script>";
                exit;
            }

            if (strlen($password) < 6) {
                echo "<script>alert('La contraseña debe tener al menos 6 caracteres'); window.history.back();</script>";
                exit;
            }

            // Verificar si el email ya existe
            $usuarioModel = new Usuario();
            if ($usuarioModel->emailExiste($email)) {
                echo "<script>alert('Este correo electrónico ya está registrado'); window.history.back();</script>";
                exit;
            }

            // Crear el usuario con rol de cliente (rol_id = 2)
            $datos = [
                'rol_id' => 2, // Cliente por defecto
                'nombre' => $nombre,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'estado' => 'activo'
            ];

            if ($usuarioModel->crear($datos)) {
                echo "<script>
                    alert('¡Cuenta creada exitosamente! Ahora puedes iniciar sesión.');
                    window.location.href='".URL."index.php?c=Auth&a=login';
                </script>";
                exit;
            } else {
                echo "<script>alert('Error al crear la cuenta. Intenta nuevamente.'); window.history.back();</script>";
                exit;
            }
        }

        // Si no es POST, mostrar el formulario
        include 'app/views/auth/registro.php';
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header("Location: " . URL . "index.php?c=Home&a=index");
        exit();
    }
}

// BORRAMOS TODA LA LÓGICA DE ABAJO (el if isset GET action), 
// porque de eso ya se encarga el index.php de la raíz.