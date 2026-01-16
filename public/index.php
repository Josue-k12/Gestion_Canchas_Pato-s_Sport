<?php
// Usamos rutas absolutas para que no importe desde dónde se llame
require_once __DIR__ . '/../app/config/config.php';

$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';

if ($url === 'auth/login') {
    // Aquí cargamos la vista, el config ya está cargado arriba
    require_once __DIR__ . '/../app/views/auth/login.php';
} else {
    require_once __DIR__ . '/../app/views/home/index.php';
}