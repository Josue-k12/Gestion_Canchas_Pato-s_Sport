<?php
class Conexion {
    private $host = HOST;
    private $db_name = DB;
    private $username = USER;
    private $password = PASSWORD;
    private $charset = CHARSET;
    private $conexion;

    public function conectar() {
        $this->conexion = null;
        try {
            $this->conexion = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=" . $this->charset,
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