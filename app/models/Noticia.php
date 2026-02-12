<?php
require_once __DIR__ . '/Conexion.php';

class Noticia {
    private $conexion;
    private $tabla = 'noticias';

    public function __construct() {
        $database = new Conexion();
        $this->conexion = $database->conectar();
    }

    // Obtener todas las noticias
    public function obtenerTodas() {
        $query = "SELECT n.*, u.nombre AS autor_nombre 
                  FROM " . $this->tabla . " n
                  LEFT JOIN usuarios u ON n.autor = u.id
                  ORDER BY n.fecha_creacion DESC";
        
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener noticias activas (para página pública)
    public function obtenerActivas($limite = 6) {
        $query = "SELECT n.*, u.nombre AS autor_nombre 
                  FROM " . $this->tabla . " n
                  LEFT JOIN usuarios u ON n.autor = u.id
                  WHERE n.estado = 'activa'
                  ORDER BY n.fecha_creacion DESC
                  LIMIT :limite";
        
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':limite', $limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener noticia por ID
    public function obtenerPorId($id) {
        $query = "SELECT n.*, u.nombre AS autor_nombre 
                  FROM " . $this->tabla . " n
                  LEFT JOIN usuarios u ON n.autor = u.id
                  WHERE n.id = :id
                  LIMIT 1";
        
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear noticia
    public function crear($datos) {
        $query = "INSERT INTO " . $this->tabla . " 
                  (titulo, descripcion, contenido, imagen, autor, estado) 
                  VALUES (:titulo, :descripcion, :contenido, :imagen, :autor, :estado)";
        
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':titulo', $datos['titulo']);
        $stmt->bindParam(':descripcion', $datos['descripcion']);
        $stmt->bindParam(':contenido', $datos['contenido']);
        $stmt->bindParam(':imagen', $datos['imagen']);
        $stmt->bindParam(':autor', $datos['autor']);
        $stmt->bindParam(':estado', $datos['estado']);
        
        return $stmt->execute();
    }

    // Actualizar noticia
    public function actualizar($id, $datos) {
        $query = "UPDATE " . $this->tabla . " 
                  SET titulo = :titulo,
                      descripcion = :descripcion,
                      contenido = :contenido,
                      estado = :estado";
        
        if (!empty($datos['imagen'])) {
            $query .= ", imagen = :imagen";
        }
        
        $query .= " WHERE id = :id";
        
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':titulo', $datos['titulo']);
        $stmt->bindParam(':descripcion', $datos['descripcion']);
        $stmt->bindParam(':contenido', $datos['contenido']);
        $stmt->bindParam(':estado', $datos['estado']);
        
        if (!empty($datos['imagen'])) {
            $stmt->bindParam(':imagen', $datos['imagen']);
        }
        
        return $stmt->execute();
    }

    // Eliminar noticia
    public function eliminar($id) {
        $query = "DELETE FROM " . $this->tabla . " WHERE id = :id";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Cambiar estado de noticia
    public function cambiarEstado($id, $estado) {
        $query = "UPDATE " . $this->tabla . " SET estado = :estado WHERE id = :id";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':estado', $estado);
        return $stmt->execute();
    }
}
?>
