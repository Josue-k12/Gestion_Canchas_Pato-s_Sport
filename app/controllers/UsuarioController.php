<?php
require_once 'app/models/Usuario.php';

class UsuarioController {
    
    public function perfil() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URL . "index.php?c=Auth&a=login");
            exit();
        }

        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->obtenerPorId($_SESSION['user_id']);

        if (!$usuario) {
            $_SESSION['error'] = 'Usuario no encontrado';
            header("Location: " . URL . "index.php");
            exit();
        }

        include 'app/views/usuario/perfil.php';
    }

    public function configuracion() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URL . "index.php?c=Auth&a=login");
            exit();
        }

        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->obtenerPorId($_SESSION['user_id']);

        if (!$usuario) {
            $_SESSION['error'] = 'Usuario no encontrado';
            header("Location: " . URL . "index.php");
            exit();
        }

        // Si es POST, actualizar datos
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipo = $_POST['tipo'] ?? '';

            if ($tipo === 'datos') {
                $datos = [
                    'rol_id' => $usuario['rol_id'],
                    'nombre' => $_POST['nombre'],
                    'email' => $_POST['email'],
                    'estado' => $usuario['estado']
                ];

                if ($usuarioModel->actualizar($_SESSION['user_id'], $datos)) {
                    $_SESSION['user_nombre'] = $_POST['nombre'];
                    $_SESSION['mensaje'] = 'Datos actualizados correctamente';
                } else {
                    $_SESSION['error'] = 'Error al actualizar los datos';
                }
            } elseif ($tipo === 'password') {
                $passwordActual = $_POST['password_actual'];
                $passwordNueva = $_POST['password_nueva'];
                $passwordConfirm = $_POST['password_confirm'];

                if ($passwordNueva !== $passwordConfirm) {
                    $_SESSION['error'] = 'Las contraseñas nuevas no coinciden';
                } elseif (strlen($passwordNueva) < 6) {
                    $_SESSION['error'] = 'La contraseña debe tener al menos 6 caracteres';
                } else {
                    // Verificar contraseña actual
                    require_once 'app/models/Conexion.php';
                    $db = (new Conexion())->conectar();
                    $query = "SELECT password FROM usuarios WHERE id = :id";
                    $stmt = $db->prepare($query);
                    $stmt->bindParam(':id', $_SESSION['user_id']);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);

                    if (password_verify($passwordActual, $result['password'])) {
                        $datos = [
                            'rol_id' => $usuario['rol_id'],
                            'nombre' => $usuario['nombre'],
                            'email' => $usuario['email'],
                            'estado' => $usuario['estado'],
                            'password' => password_hash($passwordNueva, PASSWORD_DEFAULT)
                        ];

                        if ($usuarioModel->actualizar($_SESSION['user_id'], $datos)) {
                            $_SESSION['mensaje'] = 'Contraseña actualizada correctamente';
                        } else {
                            $_SESSION['error'] = 'Error al actualizar la contraseña';
                        }
                    } else {
                        $_SESSION['error'] = 'La contraseña actual es incorrecta';
                    }
                }
            }

            header("Location: " . URL . "index.php?c=Usuario&a=configuracion");
            exit();
        }

        include 'app/views/usuario/configuracion.php';
    }

    // CRUD para administración de usuarios
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 1) {
            header("Location: " . URL . "index.php");
            exit();
        }

        $conexion = new Conexion();
        $db = $conexion->conectar();
        
        $query = "SELECT u.*, r.nombre as rol_nombre FROM usuarios u 
                  LEFT JOIN roles r ON u.rol_id = r.id ORDER BY u.id DESC";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include 'app/views/usuarios/index.php';
    }

    public function crear() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 1) {
            header("Location: " . URL . "index.php");
            exit();
        }

        $conexion = new Conexion();
        $db = $conexion->conectar();
        
        // Obtener roles
        $queryRoles = "SELECT * FROM roles ORDER BY nombre";
        $stmtRoles = $db->prepare($queryRoles);
        $stmtRoles->execute();
        $roles = $stmtRoles->fetchAll(PDO::FETCH_ASSOC);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $rol_id = (int)$_POST['rol_id'];
            $estado = $_POST['estado'];

            $query = "INSERT INTO usuarios (nombre, email, password, rol_id, estado) 
                      VALUES (:nombre, :email, :password, :rol_id, :estado)";
            
            $stmt = $db->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':rol_id', $rol_id);
            $stmt->bindParam(':estado', $estado);
            
            if ($stmt->execute()) {
                $_SESSION['mensaje'] = 'Usuario creado exitosamente';
                header("Location: " . URL . "index.php?c=Usuario&a=index");
                exit();
            } else {
                $_SESSION['error'] = 'Error al crear el usuario';
            }
        }

        include 'app/views/usuarios/crear.php';
    }

    public function editar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 1) {
            header("Location: " . URL . "index.php");
            exit();
        }

        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            header("Location: " . URL . "index.php?c=Usuario&a=index");
            exit();
        }

        $conexion = new Conexion();
        $db = $conexion->conectar();
        
        $id = (int)$id;
        $query = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            $_SESSION['error'] = 'Usuario no encontrado';
            header("Location: " . URL . "index.php?c=Usuario&a=index");
            exit();
        }

        // Obtener roles
        $queryRoles = "SELECT * FROM roles ORDER BY nombre";
        $stmtRoles = $db->prepare($queryRoles);
        $stmtRoles->execute();
        $roles = $stmtRoles->fetchAll(PDO::FETCH_ASSOC);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $rol_id = (int)$_POST['rol_id'];
            $estado = $_POST['estado'];

            $updatePassword = '';
            $query = "UPDATE usuarios SET nombre = :nombre, email = :email, 
                      rol_id = :rol_id, estado = :estado";
            
            if (!empty($_POST['password'])) {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $query .= ", password = :password";
            }
            
            $query .= " WHERE id = :id";
            
            $stmt = $db->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':rol_id', $rol_id);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':id', $id);
            
            if (!empty($_POST['password'])) {
                $stmt->bindParam(':password', $password);
            }
            
            if ($stmt->execute()) {
                $_SESSION['mensaje'] = 'Usuario actualizado exitosamente';
                header("Location: " . URL . "index.php?c=Usuario&a=index");
                exit();
            } else {
                $_SESSION['error'] = 'Error al actualizar el usuario';
            }
        }

        include 'app/views/usuarios/editar.php';
    }

    public function eliminar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 1) {
            header("Location: " . URL . "index.php");
            exit();
        }

        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            header("Location: " . URL . "index.php?c=Usuario&a=index");
            exit();
        }

        // No permitir eliminar al usuario actual
        if ($id == $_SESSION['user_id']) {
            $_SESSION['error'] = 'No puedes eliminar tu propia cuenta';
            header("Location: " . URL . "index.php?c=Usuario&a=index");
            exit();
        }

        $conexion = new Conexion();
        $db = $conexion->conectar();
        
        $id = (int)$id;
        $query = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
            $_SESSION['mensaje'] = 'Usuario eliminado exitosamente';
        } else {
            $_SESSION['error'] = 'Error al eliminar el usuario';
        }

        header("Location: " . URL . "index.php?c=Usuario&a=index");
        exit();
    }
}
?>
