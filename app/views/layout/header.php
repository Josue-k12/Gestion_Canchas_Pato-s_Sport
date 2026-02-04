<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pato's Sport</title> 
    
    <link rel="icon" type="image/png" href="<?php echo URL; ?>public/img/logo_patos.png">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/bootstrap-icons.css">

    <style>
        :root {
            --verde-patos: #0fb29a;
            --oscuro-patos: #121821;
        }

        html { scroll-behavior: smooth; }
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
                        url('<?php echo URL; ?>public/img/cancha_fondo.jpeg');
            background-size: cover;
            background-position: center;
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }
        .brand-text {
            letter-spacing: 1px;
            font-size: 1.5rem;
        }
        section, div[id], footer[id] {
            scroll-margin-top: 90px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-patos-dark py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?php echo URL; ?>index.php?c=Home&a=index">
                <img src="<?php echo URL; ?>public/img/logo_patos.png" alt="Logo" style="height: 50px; width: auto;">
                <span class="ms-2 fw-bold text-white brand-text">PATO'S SPORT</span>
            </a>

            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav mx-auto">
                    <a class="nav-link" href="<?php echo URL; ?>index.php?c=Home&a=index">Inicio</a>
                    <a class="nav-link" href="#servicios">Servicios</a>
                    <a class="nav-link" href="#noticias">Noticias</a>
                    <a class="nav-link" href="#torneos">Torneos</a>
                    <a class="nav-link" href="#contacto">Contacto</a>
                </div>
                
                <div class="d-flex">
                    <?php if(!isset($_SESSION['user_id'])): ?>
                        <a href="<?php echo URL; ?>index.php?c=Auth&a=register" class="btn btn-patos fw-bold rounded-pill px-4 me-2">
                            <i class="bi bi-person-plus"></i> Registrarse
                        </a>
                        <a href="<?php echo URL; ?>index.php?c=Auth&a=login" class="btn btn-outline-success border-2 fw-bold rounded-pill px-4">
                            <i class="bi bi-person-circle"></i> Iniciar Sesión
                        </a>
                    <?php else: ?>
                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle rounded-pill px-3 me-2" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i> <?php echo explode(' ', $_SESSION['user_nombre'])[0]; ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                                <li><a class="dropdown-item py-2" href="<?php echo URL; ?>index.php?c=Home&a=index"><i class="bi bi-speedometer2 me-2"></i>Mi Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item py-2 text-danger" href="<?php echo URL; ?>index.php?c=Auth&a=logout"><i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión</a></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>