<?php
// 1. Cargar configuración una sola vez
require_once '../app/config/config.php';

// 2. Detectar la ruta
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';

if ($url == 'auth/login') {
    // Cargamos el login (sin require_once config porque ya se cargó arriba)
    require_once '../app/views/auth/login.php';
} else {
    // Cargamos el Home
    include '../app/views/home/index.php';
}