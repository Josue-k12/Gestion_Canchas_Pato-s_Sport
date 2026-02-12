<?php
// 1. Cargamos la configuración
require_once 'app/config/config.php';

// 2. Iniciamos la sesión para todo el sitio
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 3. Obtenemos el controlador y la acción de la URL
$controllerName = isset($_GET['c']) ? $_GET['c'] : 'Home';
$action = isset($_GET['a']) ? $_GET['a'] : 'index';

// 4. Construimos la ruta al archivo del controlador
$controllerFile = 'app/controllers/' . $controllerName . 'Controller.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerClass = $controllerName . 'Controller';

    if (class_exists($controllerClass)) {
        $controllerObject = new $controllerClass();
        
        // Ejecutamos la acción
        if (method_exists($controllerObject, $action)) {
            $controllerObject->$action();
        } else {
            // Si la acción no existe, al Home
            require_once 'app/controllers/HomeController.php';
            $home = new HomeController();
            $home->index();
        }
    } else {
        require_once 'app/controllers/HomeController.php';
        $home = new HomeController();
        $home->index();
    }
} else {
    // Si el controlador no existe, al Home
    require_once 'app/controllers/HomeController.php';
    $home = new HomeController();
    $home->index();
}