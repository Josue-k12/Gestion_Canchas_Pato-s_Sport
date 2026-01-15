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
            $query = "INSERT INTO canchas (nombre, tipo, capacidad, precio_hora, descripcion, estado)
                      VALUES (:nombre, :tipo, :capacidad, :precio_hora, :descripcion, :estado)";
            
            $stmt = $this->db->prepare($query);
            
            $stmt->bindParam(':nombre', $datos['nombre']);
            $stmt->bindParam(':tipo', $datos['tipo']);
            $stmt->bindParam(':capacidad', $datos['capacidad']);
            $stmt->bindParam(':precio_hora', $datos['precio_hora']);
            $stmt->bindParam(':descripcion', $datos['descripcion']);
            $stmt->bindParam(':estado', $datos['estado']);
            
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
                      capacidad = :capacidad,
                      precio_hora = :precio_hora,
                      descripcion = :descripcion,
                      estado = :estado
                      WHERE id = :id";
            
            $stmt = $this->db->prepare($query);
            
            $stmt->bindParam(':id', $datos['id']);
            $stmt->bindParam(':nombre', $datos['nombre']);
            $stmt->bindParam(':tipo', $datos['tipo']);
            $stmt->bindParam(':capacidad', $datos['capacidad']);
            $stmt->bindParam(':precio_hora', $datos['precio_hora']);
            $stmt->bindParam(':descripcion', $datos['descripcion']);
            $stmt->bindParam(':estado', $datos['estado']);
            
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
