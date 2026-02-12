<?php
require_once 'app/config/config.php';
require_once 'app/models/Conexion.php';

echo "<h2>Test de Conexión a Base de Datos</h2>";
echo "<hr>";

try {
    $conexion = new Conexion();
    $db = $conexion->conectar();
    
    if ($db) {
        echo "<h3 style='color: green;'>✓ CONEXIÓN EXITOSA</h3>";
        echo "<p><strong>Host:</strong> " . HOST . "</p>";
        echo "<p><strong>Base de Datos:</strong> " . DB . "</p>";
        echo "<p><strong>Usuario:</strong> " . USER . "</p>";
        
        // Verificar tablas
        echo "<h3>Tablas en la base de datos:</h3>";
        $query = "SHOW TABLES";
        $stmt = $db->query($query);
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        if (count($tables) > 0) {
            echo "<ul>";
            foreach ($tables as $table) {
                echo "<li>" . htmlspecialchars($table) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p style='color: orange;'>⚠ No hay tablas en la base de datos</p>";
        }
        
        // Verificar roles
        echo "<h3>Roles registrados:</h3>";
        $query = "SELECT * FROM roles";
        try {
            $stmt = $db->prepare($query);
            $stmt->execute();
            $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (count($roles) > 0) {
                echo "<table border='1' cellpadding='10'>";
                echo "<tr><th>ID</th><th>Nombre</th></tr>";
                foreach ($roles as $rol) {
                    echo "<tr><td>" . $rol['id'] . "</td><td>" . $rol['nombre'] . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<p style='color: orange;'>⚠ No hay roles registrados</p>";
            }
        } catch (PDOException $e) {
            echo "<p style='color: red;'>Error al leer roles: " . $e->getMessage() . "</p>";
        }
        
        // Verificar usuarios
        echo "<h3>Usuarios registrados:</h3>";
        $query = "SELECT id, nombre, email, rol_id FROM usuarios LIMIT 5";
        try {
            $stmt = $db->prepare($query);
            $stmt->execute();
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (count($usuarios) > 0) {
                echo "<table border='1' cellpadding='10'>";
                echo "<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Rol ID</th></tr>";
                foreach ($usuarios as $user) {
                    echo "<tr><td>" . $user['id'] . "</td><td>" . $user['nombre'] . "</td><td>" . $user['email'] . "</td><td>" . $user['rol_id'] . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<p style='color: orange;'>⚠ No hay usuarios registrados</p>";
            }
        } catch (PDOException $e) {
            echo "<p style='color: red;'>Error al leer usuarios: " . $e->getMessage() . "</p>";
        }
        
    } else {
        echo "<h3 style='color: red;'>✗ CONEXIÓN FALLIDA</h3>";
    }
} catch (PDOException $e) {
    echo "<h3 style='color: red;'>✗ ERROR DE CONEXIÓN</h3>";
    echo "<p><strong>Mensaje:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>Código:</strong> " . htmlspecialchars($e->getCode()) . "</p>";
}

echo "<hr>";
echo "<p><a href='index.php'>← Volver al inicio</a></p>";
?>
