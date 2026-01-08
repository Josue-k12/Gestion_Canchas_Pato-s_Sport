<?php
// 1. Cargamos la configuración global (URL, BD, etc.)
require_once 'app/config/config.php';

// 2. Redirigimos al usuario al Login que está dentro de las vistas
// Usamos la constante URL que definimos en config.php
header("Location: " . URL . "app/views/auth/login.php");
exit();
?>