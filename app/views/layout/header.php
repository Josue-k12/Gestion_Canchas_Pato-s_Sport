<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pato's Sport</title> 
    
    <link rel="icon" type="image/png" href="<?php echo URL; ?>public/img/logo_patos.png">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/bootstrap.min.css">
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
                        /* Ruta de imagen corregida para CSS */
                        url('<?php echo URL; ?>public/img/cancha_fondo.png');
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
        
        .brand-text {
            letter-spacing: 1px;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-patos-dark py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?php echo URL; ?>">
                <img src="<?php echo URL; ?>public/img/logo_patos.png" alt="Logo" style="height: 50px; width: auto;">
                <span class="ms-2 fw-bold text-white brand-text">PATO'S SPORT</span>
            </a>

            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav mx-auto">
                    <a class="nav-link" href="<?php echo URL; ?>">Inicio</a>
                    <a class="nav-link" href="#">Canchas</a>
                    <a class="nav-link" href="#">Torneos</a>
                    <a class="nav-link" href="#">Contacto</a>
                </div>
                <div class="d-flex">
                    <?php if(!isset($_SESSION['user_id'])): ?>
                        <a href="<?php echo URL; ?>app/views/auth/login.php" class="btn btn-patos px-4 shadow-sm">Iniciar Sesión</a>
                    <?php else: ?>
                        <a href="<?php echo URL; ?>app/controllers/AuthController.php?action=logout" class="btn btn-danger rounded-pill px-4">Cerrar Sesión</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>