<?php
require_once 'Conexion.php';

class Cancha {
    private $db;

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->conectar();
    }

    public function obtenerTodas() {
        try {
            $query = "SELECT * FROM canchas ORDER BY nombre ASC";
            
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
            $query = "SELECT * FROM canchas WHERE id = :id";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en obtenerPorId: " . $e->getMessage());
            return null;
        }
    }

    public function obtenerActivas() {
        try {
            $query = "SELECT * FROM canchas WHERE estado = 'activa' ORDER BY nombre ASC";
            
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en obtenerActivas: " . $e->getMessage());
            return [];
        }
    }

    public function crear($datos) {
        try {
            $query = "INSERT INTO canchas (nombre, tipo, precio_hora, estado, imagen)
                      VALUES (:nombre, :tipo, :precio_hora, :estado, :imagen)";
            
            $stmt = $this->db->prepare($query);
            
            $stmt->bindParam(':nombre', $datos['nombre']);
            $stmt->bindParam(':tipo', $datos['tipo']);
            $stmt->bindParam(':precio_hora', $datos['precio_hora']);
            $stmt->bindParam(':estado', $datos['estado']);
            $stmt->bindParam(':imagen', $datos['imagen']);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en crear: " . $e->getMessage());
            return false;
        }
    }

    public function actualizar($datos) {
        try {
            $query = "UPDATE canchas SET 
                      nombre = :nombre,
                      tipo = :tipo,
                      precio_hora = :precio_hora,
                      estado = :estado,
                      imagen = :imagen
                      WHERE id = :id";
            
            $stmt = $this->db->prepare($query);
            
            $stmt->bindParam(':id', $datos['id']);
            $stmt->bindParam(':nombre', $datos['nombre']);
            $stmt->bindParam(':tipo', $datos['tipo']);
            $stmt->bindParam(':precio_hora', $datos['precio_hora']);
            $stmt->bindParam(':estado', $datos['estado']);
            $stmt->bindParam(':imagen', $datos['imagen']);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en actualizar: " . $e->getMessage());
            return false;
        }
    }

    public function eliminar($id) {
        try {
            $query = "DELETE FROM canchas WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en eliminar: " . $e->getMessage());
            return false;
        }
    }
}
