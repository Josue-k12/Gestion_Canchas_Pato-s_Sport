<?php
// Iniciamos la sesión para poder destruirla
session_start();

// Eliminamos todas las variables de sesión
session_unset();

// Destruimos la sesión
session_destroy();

// Redirigimos al usuario a la página de inicio
header("Location: ../index.php");
exit();
?>