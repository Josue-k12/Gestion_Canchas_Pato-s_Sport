<?php
require_once 'app/models/Conexion.php';

class NoticiaController {
    
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
        
        // Para noticias, crearemos la tabla dinámicamente si no existe
        $tableCheck = "SHOW TABLES LIKE 'noticias'";
        
        $query = "SELECT n.*, u.nombre as autor_nombre FROM noticias n LEFT JOIN usuarios u ON n.autor = u.id ORDER BY n.fecha_creacion DESC";
        $stmt = $db->prepare($query);
        
        try {
            $stmt->execute();
            $noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            // Crear tabla si no existe
            $createTable = "CREATE TABLE noticias (
                id INT AUTO_INCREMENT PRIMARY KEY,
                titulo VARCHAR(200) NOT NULL,
                contenido TEXT NOT NULL,
                autor INT NOT NULL,
                fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                estado ENUM('activa', 'inactiva') DEFAULT 'activa',
                FOREIGN KEY (autor) REFERENCES usuarios(id) ON DELETE CASCADE
            )";
            $db->exec($createTable);
            $noticias = [];
        }

        include 'app/views/noticias/index.php';
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
            
            $titulo = $_POST['titulo'];
            $contenido = $_POST['contenido'];
            $estado = $_POST['estado'] ?? 'activa';
            $autor = $_SESSION['user_id'];

            $query = "INSERT INTO noticias (titulo, contenido, autor, estado) VALUES (:titulo, :contenido, :autor, :estado)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':contenido', $contenido);
            $stmt->bindParam(':autor', $autor);
            $stmt->bindParam(':estado', $estado);
            
            if ($stmt->execute()) {
                $_SESSION['mensaje'] = 'Noticia creada exitosamente';
                header("Location: " . URL . "index.php?c=Noticia&a=index");
                exit();
            } else {
                $_SESSION['error'] = 'Error al crear la noticia';
            }
        }

        include 'app/views/noticias/crear.php';
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
            header("Location: " . URL . "index.php?c=Noticia&a=index");
            exit();
        }

        $conexion = new Conexion();
        $db = $conexion->conectar();
        
        $id = (int)$id;
        $query = "SELECT * FROM noticias WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $noticia = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$noticia) {
            $_SESSION['error'] = 'Noticia no encontrada';
            header("Location: " . URL . "index.php?c=Noticia&a=index");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'];
            $contenido = $_POST['contenido'];
            $estado = $_POST['estado'] ?? 'activa';

            $query = "UPDATE noticias SET titulo = :titulo, contenido = :contenido, estado = :estado WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':contenido', $contenido);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':id', $id);
            
            if ($stmt->execute()) {
                $_SESSION['mensaje'] = 'Noticia actualizada exitosamente';
                header("Location: " . URL . "index.php?c=Noticia&a=index");
                exit();
            } else {
                $_SESSION['error'] = 'Error al actualizar la noticia';
            }
        }

        include 'app/views/noticias/editar.php';
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
            header("Location: " . URL . "index.php?c=Noticia&a=index");
            exit();
        }

        $conexion = new Conexion();
        $db = $conexion->conectar();
        
        $id = (int)$id;
        $query = "DELETE FROM noticias WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
            $_SESSION['mensaje'] = 'Noticia eliminada exitosamente';
        } else {
            $_SESSION['error'] = 'Error al eliminar la noticia';
        }

        header("Location: " . URL . "index.php?c=Noticia&a=index");
        exit();
    }
}
