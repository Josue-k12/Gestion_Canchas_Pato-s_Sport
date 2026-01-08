<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pato's Sport</title> 
    
    <link rel="icon" type="image/png" href="assets/img/logo_patos.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --verde-patos: #0fb29a;
            --oscuro-patos: #121821;
        }

        .bg-patos-dark { background-color: var(--oscuro-patos); }
        
        .nav-link { 
            color: rgba(255,255,255,0.8) !important; 
            margin-right: 15px;
            transition: 0.3s;
        }
        
        .nav-link:hover { color: var(--verde-patos) !important; }

        .btn-patos { 
            background-color: var(--verde-patos); 
            color: white; 
            border-radius: 20px;
            font-weight: bold;
            border: none;
            transition: 0.3s;
        }
        
        .btn-patos:hover { 
            background-color: #0d9682; 
            transform: scale(1.05);
            color: white;
        }

        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)), 
                        url('./assets/img/cancha_fondo.png');
            background-size: cover;
            background-position: center;
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .buscador-container { max-width: 850px; margin: 0 auto; }
        .form-select, .form-control { border-radius: 0; }
        
        /* Estilo extra para el texto del logo */
        .brand-text {
            letter-spacing: 1px;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-patos-dark py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="assets/img/logo_patos.png" alt="Logo" style="height: 50px; width: auto;">
                <span class="ms-2 fw-bold text-white brand-text">PATO'S SPORT</span>
            </a>

            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav mx-auto">
                    <a class="nav-link" href="index.php">Inicio</a>
                    <a class="nav-link" href="#">Canchas</a>
                    
                    <?php if(isset($_SESSION['rol']) && ($_SESSION['rol'] == 'admin' || $_SESSION['rol'] == 'encargado')): ?>
                        <a class="nav-link text-warning fw-bold" href="admin_dashboard.php">Gestión</a>
                    <?php endif; ?>
                    
                    <a class="nav-link" href="#">Torneos</a>
                </div>
                
                <div class="d-flex align-items-center">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle btn-sm rounded-pill px-3" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i> <?php echo explode(' ', $_SESSION['user_nombre'])[0]; ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item text-danger" href="config/logout.php">Cerrar Sesión</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-patos px-4 shadow-sm">Iniciar Sesión</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>