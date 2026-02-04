<?php
require_once 'app/models/Conexion.php';

class RolController {
    
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
        
        $query = "SELECT * FROM roles ORDER BY id";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include 'app/views/roles/index.php';
    }

    public function crear() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 1) {
            header("Location: " . URL . "index.php");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $conexion = new Conexion();
            $db = $conexion->conectar();
            
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'] ?? '';

            $query = "INSERT INTO roles (nombre, descripcion) VALUES (:nombre, :descripcion)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            
            if ($stmt->execute()) {
                $_SESSION['mensaje'] = 'Rol creado exitosamente';
                header("Location: " . URL . "index.php?c=Rol&a=index");
                exit();
            } else {
                $_SESSION['error'] = 'Error al crear el rol';
            }
        }

        include 'app/views/roles/crear.php';
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
            header("Location: " . URL . "index.php?c=Rol&a=index");
            exit();
        }

        $conexion = new Conexion();
        $db = $conexion->conectar();
        
        $id = (int)$id;
        $query = "SELECT * FROM roles WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $rol = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$rol) {
            $_SESSION['error'] = 'Rol no encontrado';
            header("Location: " . URL . "index.php?c=Rol&a=index");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'] ?? '';

            $query = "UPDATE roles SET nombre = :nombre, descripcion = :descripcion WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':id', $id);
            
            if ($stmt->execute()) {
                $_SESSION['mensaje'] = 'Rol actualizado exitosamente';
                header("Location: " . URL . "index.php?c=Rol&a=index");
                exit();
            } else {
                $_SESSION['error'] = 'Error al actualizar el rol';
            }
        }

        include 'app/views/roles/editar.php';
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
            header("Location: " . URL . "index.php?c=Rol&a=index");
            exit();
        }

        $conexion = new Conexion();
        $db = $conexion->conectar();
        
        $id = (int)$id;
        $query = "DELETE FROM roles WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
            $_SESSION['mensaje'] = 'Rol eliminado exitosamente';
        } else {
            $_SESSION['error'] = 'Error al eliminar el rol';
        }

        header("Location: " . URL . "index.php?c=Rol&a=index");
        exit();
    }
}
