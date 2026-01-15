<?php
// 1. Cargamos la configuración (Subimos un nivel con ../ para encontrar la carpeta config)
require_once '../config/config.php';

// 2. Cargamos la vista del home (Subimos un nivel para entrar a app/views)
include '../app/views/home/index.php';
?>