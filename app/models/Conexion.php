<?php
class Conexion {
    private $host = "localhost";
    private $db_name = "gestion_canchas";
    private $username = "root";
    private $password = "";
    private $conexion;

    public function conectar() {
        $this->conexion = null;
        try {
            $this->conexion = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8",
                $this->username,
                $this->password
            );
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error crítico de conexión: " . $e->getMessage());
        }
        return $this->conexion;
    }
}
?>
