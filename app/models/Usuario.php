<?php
require_once __DIR__ . '/Conexion.php';

class Usuario {
    private $conexion;
    private $tabla = 'usuarios';

    public function __construct() {
        $database = new Conexion();
        $this->conexion = $database->conectar();
    }

    // Obtener todos los usuarios
    public function obtenerTodos() {
        $query = "SELECT u.*, r.nombre AS rol_nombre 
                  FROM " . $this->tabla . " u 
                  INNER JOIN roles r ON u.rol_id = r.id 
                  ORDER BY u.id DESC";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener usuario por ID
    public function obtenerPorId($id) {
        $query = "SELECT u.*, r.nombre AS rol_nombre 
                  FROM " . $this->tabla . " u 
                  INNER JOIN roles r ON u.rol_id = r.id 
                  WHERE u.id = :id 
                  LIMIT 1";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Obtener usuarios por rol
    public function obtenerPorRol($rolId) {
        $query = "SELECT u.* FROM " . $this->tabla . " u 
                  WHERE u.rol_id = :rol_id 
                  ORDER BY u.nombre ASC";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':rol_id', $rolId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear nuevo usuario
    public function crear($datos) {
        $query = "INSERT INTO " . $this->tabla . " 
                  (rol_id, nombre, email, password, estado) 
                  VALUES (:rol_id, :nombre, :email, :password, :estado)";
        
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':rol_id', $datos['rol_id']);
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':email', $datos['email']);
        $stmt->bindParam(':password', $datos['password']);
        $stmt->bindParam(':estado', $datos['estado']);
        
        return $stmt->execute();
    }

    // Actualizar usuario
    public function actualizar($id, $datos) {
        $query = "UPDATE " . $this->tabla . " 
                  SET rol_id = :rol_id, 
                      nombre = :nombre, 
                      email = :email, 
                      estado = :estado";
        
        // Solo actualizar contraseña si se proporciona
        if (!empty($datos['password'])) {
            $query .= ", password = :password";
        }
        
        $query .= " WHERE id = :id";
        
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':rol_id', $datos['rol_id']);
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':email', $datos['email']);
        $stmt->bindParam(':estado', $datos['estado']);
        
        if (!empty($datos['password'])) {
            $stmt->bindParam(':password', $datos['password']);
        }
        
        return $stmt->execute();
    }

    // Eliminar usuario
    public function eliminar($id) {
        $query = "DELETE FROM " . $this->tabla . " WHERE id = :id";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Verificar si el email ya existe
    public function emailExiste($email, $excludeId = null) {
        $query = "SELECT id FROM " . $this->tabla . " WHERE email = :email";
        
        if ($excludeId) {
            $query .= " AND id != :excludeId";
        }
        
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':email', $email);
        
        if ($excludeId) {
            $stmt->bindParam(':excludeId', $excludeId);
        }
        
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Obtener roles disponibles
    public function obtenerRoles() {
        $query = "SELECT * FROM roles ORDER BY id ASC";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
