<?php
$host = "localhost";
$db_name = "gestion_canchas";
$username = "root";
$password = "";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error crítico de conexión: " . $e->getMessage());
}
?>
