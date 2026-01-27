    <?php
    // Ya no necesitamos require_once de config aquí porque el index.php ya lo cargó
    require_once __DIR__ . '/../models/Conexion.php';

    class AuthController {

        public function login() {
            // Iniciar sesión si no existe
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // SI EL USUARIO ENVÍA EL FORMULARIO (POST)
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

                            // Al tener éxito, vamos al home a través del enrutador
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

            // SI NO ES POST (es decir, el usuario solo hizo clic en el botón), cargamos la vista
            // La ruta debe ser relativa al index.php de la raíz
            include 'app/views/auth/login.php';
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

    // IMPORTANTE: HE BORRADO TODA LA LÓGICA DE ABAJO ($auth = new AuthController...)
    // El index.php de la raíz ya se encarga de crear el objeto y llamar a la función.