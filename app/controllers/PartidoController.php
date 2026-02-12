<?php
require_once 'app/models/Conexion.php';

class PartidoController {
    
    private $db;

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->conectar();
    }

    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Verificar si el usuario está logueado
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URL . "app/views/auth/login.php");
            exit();
        }

        $rol = $_SESSION['rol'];
        
        // Obtener todos los partidos
        $partidos = $this->obtenerTodos();

        // Incluir la vista
        include 'app/views/partidos/index.php';
    }

    public function obtenerTodos() {
        try {
            $query = "SELECT p.*, c.nombre as cancha_nombre, 
                      u1.nombre as equipo1_nombre, u2.nombre as equipo2_nombre
                      FROM partidos p
                      LEFT JOIN canchas c ON p.cancha_id = c.id
                      LEFT JOIN usuarios u1 ON p.equipo1_id = u1.id
                      LEFT JOIN usuarios u2 ON p.equipo2_id = u2.id
                      ORDER BY p.fecha DESC, p.hora_inicio DESC";
            
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Si la tabla no existe, retornar array vacío
            return [];
        }
    }

    public function crear() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Roles: 1=admin, 3=encargado
        if (!isset($_SESSION['user_id']) || ($_SESSION['rol'] !== 1 && $_SESSION['rol'] !== 3)) {
            header("Location: " . URL . "index.php");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'cancha_id' => $_POST['cancha_id'],
                'equipo1_id' => $_POST['equipo1_id'],
                'equipo2_id' => $_POST['equipo2_id'],
                'fecha' => $_POST['fecha'],
                'hora_inicio' => $_POST['hora_inicio'],
                'hora_fin' => $_POST['hora_fin'],
                'tipo' => $_POST['tipo'], // amistoso, torneo, etc.
                'estado' => $_POST['estado'] ?? 'programado'
            ];

            if ($this->guardar($datos)) {
                $_SESSION['mensaje'] = 'Partido creado exitosamente';
                header("Location: " . URL . "index.php?c=Partido&a=index");
                exit();
            } else {
                $_SESSION['error'] = 'Error al crear el partido';
            }
        }

        include 'app/views/partidos/crear.php';
    }

    public function guardar($datos) {
        try {
            $query = "INSERT INTO partidos (cancha_id, equipo1_id, equipo2_id, fecha, hora_inicio, hora_fin, tipo, estado)
                      VALUES (:cancha_id, :equipo1_id, :equipo2_id, :fecha, :hora_inicio, :hora_fin, :tipo, :estado)";
            
            $stmt = $this->db->prepare($query);
            
            $stmt->bindParam(':cancha_id', $datos['cancha_id']);
            $stmt->bindParam(':equipo1_id', $datos['equipo1_id']);
            $stmt->bindParam(':equipo2_id', $datos['equipo2_id']);
            $stmt->bindParam(':fecha', $datos['fecha']);
            $stmt->bindParam(':hora_inicio', $datos['hora_inicio']);
            $stmt->bindParam(':hora_fin', $datos['hora_fin']);
            $stmt->bindParam(':tipo', $datos['tipo']);
            $stmt->bindParam(':estado', $datos['estado']);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function editar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id']) || ($_SESSION['rol'] !== 1 && $_SESSION['rol'] !== 3)) {
            header("Location: " . URL . "index.php");
            exit();
        }

        if (!isset($_GET['id'])) {
            header("Location: " . URL . "index.php?c=Partido&a=index");
            exit();
        }

        $id = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'id' => $id,
                'cancha_id' => $_POST['cancha_id'],
                'equipo1_id' => $_POST['equipo1_id'],
                'equipo2_id' => $_POST['equipo2_id'],
                'fecha' => $_POST['fecha'],
                'hora_inicio' => $_POST['hora_inicio'],
                'hora_fin' => $_POST['hora_fin'],
                'tipo' => $_POST['tipo'],
                'estado' => $_POST['estado'],
                'resultado' => $_POST['resultado'] ?? null
            ];

            if ($this->actualizar($datos)) {
                $_SESSION['mensaje'] = 'Partido actualizado exitosamente';
                header("Location: " . URL . "index.php?c=Partido&a=index");
                exit();
            } else {
                $_SESSION['error'] = 'Error al actualizar el partido';
            }
        }

        $partido = $this->obtenerPorId($id);
        include 'app/views/partidos/editar.php';
    }

    public function obtenerPorId($id) {
        try {
            $query = "SELECT p.*, c.nombre as cancha_nombre 
                      FROM partidos p
                      LEFT JOIN canchas c ON p.cancha_id = c.id
                      WHERE p.id = :id";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    public function actualizar($datos) {
        try {
            $query = "UPDATE partidos SET 
                      cancha_id = :cancha_id,
                      equipo1_id = :equipo1_id,
                      equipo2_id = :equipo2_id,
                      fecha = :fecha,
                      hora_inicio = :hora_inicio,
                      hora_fin = :hora_fin,
                      tipo = :tipo,
                      estado = :estado,
                      resultado = :resultado
                      WHERE id = :id";
            
            $stmt = $this->db->prepare($query);
            
            $stmt->bindParam(':id', $datos['id']);
            $stmt->bindParam(':cancha_id', $datos['cancha_id']);
            $stmt->bindParam(':equipo1_id', $datos['equipo1_id']);
            $stmt->bindParam(':equipo2_id', $datos['equipo2_id']);
            $stmt->bindParam(':fecha', $datos['fecha']);
            $stmt->bindParam(':hora_inicio', $datos['hora_inicio']);
            $stmt->bindParam(':hora_fin', $datos['hora_fin']);
            $stmt->bindParam(':tipo', $datos['tipo']);
            $stmt->bindParam(':estado', $datos['estado']);
            $stmt->bindParam(':resultado', $datos['resultado']);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function eliminar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 1) {
            header("Location: " . URL . "index.php");
            exit();
        }

        if (!isset($_GET['id'])) {
            header("Location: " . URL . "index.php?c=Partido&a=index");
            exit();
        }

        $id = $_GET['id'];

        try {
            $query = "DELETE FROM partidos WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            
            if ($stmt->execute()) {
                $_SESSION['mensaje'] = 'Partido eliminado exitosamente';
            } else {
                $_SESSION['error'] = 'Error al eliminar el partido';
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = 'Error al eliminar el partido';
        }

        header("Location: " . URL . "index.php?c=Partido&a=index");
        exit();
    }
}
