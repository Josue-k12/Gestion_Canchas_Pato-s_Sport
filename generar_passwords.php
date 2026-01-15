<?php
// Script para generar contraseñas hash para los usuarios de prueba
// Ejecutar este script desde el navegador: http://localhost/Gestion_Canchas_Pato-s_Sport/generar_passwords.php

echo "<h2>Generador de Contraseñas Hash para Usuarios</h2>";
echo "<p>Contraseñas generadas con password_hash() de PHP (Bcrypt)</p>";
echo "<hr>";

$passwords = [
    'admin123' => 'Contraseña para Admin',
    'cliente123' => 'Contraseña para Cliente',
    'encargado123' => 'Contraseña para Encargado'
];

echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
echo "<tr><th>Contraseña Original</th><th>Descripción</th><th>Hash Generado</th></tr>";

foreach ($passwords as $pass => $desc) {
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    echo "<tr>";
    echo "<td><strong>$pass</strong></td>";
    echo "<td>$desc</td>";
    echo "<td style='font-family: monospace; font-size: 11px;'>$hash</td>";
    echo "</tr>";
}

echo "</table>";

echo "<hr>";
echo "<h3>SQL para insertar usuarios:</h3>";
echo "<pre style='background: #f4f4f4; padding: 15px; border: 1px solid #ccc;'>";
echo "-- Usuario Admin (admin@patos.com | admin123)\n";
echo "INSERT INTO usuarios (rol_id, nombre, email, password) VALUES\n";
echo "(1, 'Admin Principal', 'admin@patos.com', '" . password_hash('admin123', PASSWORD_DEFAULT) . "');\n\n";

echo "-- Usuario Cliente (cliente@patos.com | cliente123)\n";
echo "INSERT INTO usuarios (rol_id, nombre, email, password) VALUES\n";
echo "(2, 'Cliente de Prueba', 'cliente@patos.com', '" . password_hash('cliente123', PASSWORD_DEFAULT) . "');\n\n";

echo "-- Usuario Encargado (encargado@patos.com | encargado123)\n";
echo "INSERT INTO usuarios (rol_id, nombre, email, password) VALUES\n";
echo "(3, 'Encargado de Canchas', 'encargado@patos.com', '" . password_hash('encargado123', PASSWORD_DEFAULT) . "');\n";
echo "</pre>";

echo "<hr>";
echo "<h3>Credenciales de Acceso:</h3>";
echo "<ul>";
echo "<li><strong>Admin:</strong> admin@patos.com / admin123</li>";
echo "<li><strong>Cliente:</strong> cliente@patos.com / cliente123</li>";
echo "<li><strong>Encargado:</strong> encargado@patos.com / encargado123</li>";
echo "</ul>";
?>
