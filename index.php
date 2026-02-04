<?php
// 1. Iniciamos el búfer y la sesión
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Cargamos la configuración (Asegúrate que en config.php diga DB_NAME y no DB)
if (file_exists('app/config/config.php')) {
    require_once 'app/config/config.php';
} else {
    die("Error: No se encontró app/config/config.php");
}

// 3. Sistema de Enrutamiento
// Si no hay parámetros, por defecto es Home -> index
$controller = isset($_GET['c']) ? ucfirst($_GET['c']) : 'Home';
$action = isset($_GET['a']) ? $_GET['a'] : 'index';

// 4. Construir la ruta al controlador
$controllerFile = 'app/controllers/' . $controller . 'Controller.php';

// 5. Lógica de carga
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerClass = $controller . 'Controller';
    
    if (class_exists($controllerClass)) {
        $controllerInstance = new $controllerClass();
        
        if (method_exists($controllerInstance, $action)) {
            // Ejecuta la función (ej. login() o index())
            $controllerInstance->$action();
        } else {
            // Si el método no existe, al Home
            include 'app/views/home/index.php';
        }
    } else {
        include 'app/views/home/index.php';
    }
} else {
    // Si el archivo no existe (como cuando buscas Auth y no está el archivo)
    // Mostramos un error claro solo si no es el Home
    if ($controller !== 'Home') {
        echo "<h2>Error 404</h2>";
        echo "No se encuentra el controlador: <b>$controllerFile</b>";
        die();
    }
    // Si falla el Home, cargamos tu vista por defecto
    include 'app/views/home/index.php';
}

ob_end_flush();