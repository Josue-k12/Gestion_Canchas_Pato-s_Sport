<?php

class AuthController extends Controller {
    private $usuarioModel;

    public function __construct() {
        // Asumiendo que crearás este modelo luego, o puedes usar la conexión directa
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = trim($_POST['usuario']);
            $password = trim($_POST['password']);

            if (!empty($email) && !empty($password)) {
                try {
                    $db = new Conexion();
                    $conexion = $db->conectar();

                    // La consulta que rescatamos de tus compañeros
                    $query = "SELECT u.*, r.nombre AS rol_nombre 
                              FROM usuarios u 
                              JOIN roles r ON u.rol_id = r.id 
                              WHERE u.email = :email AND u.estado = 'activo' 
                              LIMIT 1";

                    $stmt = $conexion->prepare($query);
                    $stmt->bindParam(':email', $email);
                    $stmt->execute();
                    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Verificamos la contraseña (Usa password_verify por seguridad)
                    if ($usuario && password_verify($password, $usuario['password'])) {
                        $_SESSION['usuario_id'] = $usuario['id'];
                        $_SESSION['usuario_nombre'] = $usuario['nombre'];
                        $_SESSION['usuario_rol'] = $usuario['rol_nombre'];

                        // Redirigir según el rol
                        header("Location: " . URL . "/home");
                        exit();
                    } else {
                        $data['error'] = "Credenciales incorrectas o cuenta inactiva.";
                    }
                } catch (PDOException $e) {
                    $data['error'] = "Error en el sistema: " . $e->getMessage();
                }
            } else {
                $data['error'] = "Por favor, complete todos los campos.";
            }
        }
        
        // Carga la vista de login (tienes que tenerla en app/views/auth/login.php)
        $this->view('auth/login', $data ?? []);
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: " . URL . "/auth/login");
        exit();
    }
}