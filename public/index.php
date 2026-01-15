<?php
// 1. Cargamos la configuración 
// (Entramos a ../app/config/ porque config está dentro de app)
require_once '../app/config/config.php';

// 2. Cargamos la vista del home
include '../app/views/home/index.php';
?>