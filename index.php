<?php
// 1. Cargamos la configuración (Ahora la ruta es directa porque estamos en la raíz)
require_once 'app/config/config.php';

// 2. Iniciamos la sesión para todo el sitio
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 3. Obtenemos el controlador y la acción de la URL
// Por defecto, si no hay nada, cargamos 'Home' e 'index'
$controllerName = isset($_GET['c']) ? $_GET['c'] : 'Home';
$action = isset($_GET['a']) ? $_GET['a'] : 'index';

// 4. Construimos la ruta al archivo del controlador
$controllerFile = 'app/controllers/' . $controllerName . 'Controller.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerClass = $controllerName . 'Controller';

    if (class_exists($controllerClass)) {
        $controllerObject = new $controllerClass();
        
        // Ejecutamos la acción (ej: login, logout, index)
        if (method_exists($controllerObject, $action)) {
            $controllerObject->$action();
        } else {
            die("La acción '$action' no existe en el controlador '$controllerName'.");
        }
    } else {
        die("La clase '$controllerClass' no se encontró dentro del archivo.");
    }
} else {
    // Si intentas entrar a una ruta que no existe, te manda al Home por seguridad
    require_once 'app/controllers/HomeController.php';
    $home = new HomeController();
    $home->index();
}