<?php
require_once 'Conexion.php';

class Encargado {
    private $db;

    public function __construct() {
        $baseDatos = new Conexion();
        $this->db = $baseDatos->conectar();
    }

    // Listar todos los encargados
    public function listar() {
        try {
            // Suponiendo que el rol de encargado tiene un ID específico (ej. 2) 
            // o lo buscamos por nombre de rol
            $query = "SELECT u.*, r.nombre AS rol_nombre 
                      FROM usuarios u 
                      JOIN roles r ON u.rol_id = r.id 
                      WHERE r.nombre = 'encargado' AND u.estado = 'activo'";
            
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en Encargado::listar: " . $e->getMessage());
            return [];
        }
    }

    // Registrar un nuevo encargado
    public function registrar($datos) {
        try {
            $query = "INSERT INTO usuarios (nombre, email, password, telefono, rol_id, estado) 
                      VALUES (:nombre, :email, :password, :telefono, :rol_id, 'activo')";
            
            $stmt = $this->db->prepare($query);
            return $stmt->execute([
                ':nombre'   => $datos['nombre'],
                ':email'    => $datos['email'],
                ':password' => password_hash($datos['password'], PASSWORD_DEFAULT),
                ':telefono' => $datos['telefono'],
                ':rol_id'   => $datos['rol_id']
            ]);
        } catch (PDOException $e) {
            error_log("Error en Encargado::registrar: " . $e->getMessage());
            return false;
        }
    }
    // Añade esto dentro de la clase Encargado
public function eliminar($id) {
    try {
        $query = "UPDATE usuarios SET estado = 'inactivo' WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':id' => $id]);
    } catch (PDOException $e) {
        return false;
    }
}
}