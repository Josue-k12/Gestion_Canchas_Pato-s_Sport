<?php
require_once 'Conexion.php';

class Reserva {
    private $db;

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->conectar();
    }

    public function obtenerTodas() {
        try {
            $query = "SELECT r.*, 
                      c.nombre as cancha_nombre,
                      u.nombre as cliente_nombre
                      FROM reservas r
                      LEFT JOIN canchas c ON r.cancha_id = c.id
                      LEFT JOIN usuarios u ON r.usuario_id = u.id
                      ORDER BY r.fecha DESC, r.hora_inicio DESC";
            
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en obtenerTodas: " . $e->getMessage());
            return [];
        }
    }

    public function obtenerPorId($id) {
        try {
            $query = "SELECT r.*, 
                      c.nombre as cancha_nombre,
                      u.nombre as cliente_nombre,
                      u.email as cliente_email,
                      u.telefono as cliente_telefono
                      FROM reservas r
                      LEFT JOIN canchas c ON r.cancha_id = c.id
                      LEFT JOIN usuarios u ON r.usuario_id = u.id
                      WHERE r.id = :id";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en obtenerPorId: " . $e->getMessage());
            return null;
        }
    }

    public function obtenerPorUsuario($usuario_id) {
        try {
            $query = "SELECT r.*, 
                      c.nombre as cancha_nombre,
                      c.tipo as cancha_tipo
                      FROM reservas r
                      LEFT JOIN canchas c ON r.cancha_id = c.id
                      WHERE r.usuario_id = :usuario_id
                      ORDER BY r.fecha DESC, r.hora_inicio DESC";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':usuario_id', $usuario_id);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en obtenerPorUsuario: " . $e->getMessage());
            return [];
        }
    }

    public function crear($datos) {
        try {
            $query = "INSERT INTO reservas (usuario_id, cancha_id, fecha, hora_inicio, hora_fin, precio_total, estado)
                      VALUES (:usuario_id, :cancha_id, :fecha, :hora_inicio, :hora_fin, :precio_total, :estado)";
            
            $stmt = $this->db->prepare($query);
            
            $stmt->bindParam(':usuario_id', $datos['usuario_id']);
            $stmt->bindParam(':cancha_id', $datos['cancha_id']);
            $stmt->bindParam(':fecha', $datos['fecha']);
            $stmt->bindParam(':hora_inicio', $datos['hora_inicio']);
            $stmt->bindParam(':hora_fin', $datos['hora_fin']);
            $stmt->bindParam(':precio_total', $datos['precio_total']);
            $stmt->bindParam(':estado', $datos['estado']);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en crear: " . $e->getMessage());
            return false;
        }
    }

    public function actualizar($datos) {
        try {
            $query = "UPDATE reservas SET 
                      cancha_id = :cancha_id,
                      fecha = :fecha,
                      hora_inicio = :hora_inicio,
                      hora_fin = :hora_fin,
                      precio_total = :precio_total,
                      estado = :estado
                      WHERE id = :id";
            
            $stmt = $this->db->prepare($query);
            
            $stmt->bindParam(':id', $datos['id']);
            $stmt->bindParam(':cancha_id', $datos['cancha_id']);
            $stmt->bindParam(':fecha', $datos['fecha']);
            $stmt->bindParam(':hora_inicio', $datos['hora_inicio']);
            $stmt->bindParam(':hora_fin', $datos['hora_fin']);
            $stmt->bindParam(':precio_total', $datos['precio_total']);
            $stmt->bindParam(':estado', $datos['estado']);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en actualizar: " . $e->getMessage());
            return false;
        }
    }

    public function eliminar($id) {
        try {
            $query = "DELETE FROM reservas WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en eliminar: " . $e->getMessage());
            return false;
        }
    }
}
