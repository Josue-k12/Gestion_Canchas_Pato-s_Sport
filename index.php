<?php
// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cargamos la configuración desde la raíz
require_once 'app/config/config.php';

// Sistema de enrutamiento simple
$controller = isset($_GET['c']) ? $_GET['c'] : 'Home';
$action = isset($_GET['a']) ? $_GET['a'] : 'index';

// Construir el nombre del archivo del controlador
$controllerFile = 'app/controllers/' . $controller . 'Controller.php';

// Verificar si el archivo del controlador existe
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    
    // Construir el nombre de la clase del controlador
    $controllerClass = $controller . 'Controller';
    
    // Verificar si la clase existe
    if (class_exists($controllerClass)) {
        $controllerInstance = new $controllerClass();
        
        // Verificar si el método existe
        if (method_exists($controllerInstance, $action)) {
            $controllerInstance->$action();
        } else {
            // Método no encontrado, cargar vista home por defecto
            include 'app/views/home/index.php';
        }
    } else {
        // Clase no encontrada, cargar vista home por defecto
        include 'app/views/home/index.php';
    }
} else {
    // Controlador no encontrado, cargar vista home por defecto
    include 'app/views/home/index.php';
}