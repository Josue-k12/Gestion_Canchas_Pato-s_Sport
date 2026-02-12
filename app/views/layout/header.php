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
        
        .bg-patos-dark { 
            background-color: var(--oscuro-patos) !important; 
        }
        
        .navbar {
            background-color: var(--oscuro-patos) !important;
            padding: 0.65rem 0 !important;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .navbar-collapse {
            align-items: center;
            justify-content: flex-end;
        }
        
        @media (min-width: 768px) {
            .navbar-collapse {
                display: flex !important;
            }
        }

        .navbar-nav {
            flex-wrap: wrap;
            align-items: center;
            gap: 0.25rem;
        }

        @media (max-width: 767.98px) {
            .navbar-nav {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
                padding: 0.75rem 0;
            }

            .navbar-collapse {
                background-color: var(--oscuro-patos);
                border-radius: 0 0 12px 12px;
                padding: 0 0.75rem 0.75rem 0.75rem;
            }
        }
        
        .nav-link { 
            color: rgba(255,255,255,0.9) !important; 
            transition: 0.3s;
            padding: 0.5rem 1rem !important;
            border-radius: 999px;
            font-weight: 600;
        }
        
        .nav-link:hover { 
            color: var(--verde-patos) !important; 
            background-color: rgba(15, 178, 154, 0.12);
        }

        .navbar-brand img {
            height: 42px;
        }

        @media (min-width: 992px) {
            .navbar .container-fluid {
                max-width: 1200px;
            }

            .navbar-nav .nav-item {
                display: flex;
                align-items: center;
            }

            .btn-patos,
            .btn-outline-light {
                padding: 0.4rem 1rem;
                font-weight: 600;
            }
        }
        
        .btn-patos { 
            background-color: var(--verde-patos) !important; 
            color: white !important; 
            border: none !important;
            transition: 0.3s;
            display: inline-block !important;
        }
        
        .btn-patos:hover { 
            background-color: #0d9682 !important; 
            color: white !important;
        }
        
        .navbar-toggler {
            border: 1px solid rgba(255,255,255,0.3) !important;
        }
        
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255,255,255,1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
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

    <nav class="navbar navbar-expand-md sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="<?php echo URL; ?>index.php?c=Home&a=index">
                <img src="<?php echo URL; ?>public/img/logo_patos.png" alt="Logo" style="height: 40px; width: auto;">
                <span class="ms-2 fw-bold text-white">PATO'S SPORT</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URL; ?>index.php?c=Home&a=index">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#servicios">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#noticias">Noticias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#torneos">Torneos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacto">Contacto</a>
                    </li>
                    
                    <?php if(!isset($_SESSION['user_id'])): ?>
                        <li class="nav-item ms-2">
                            <a href="<?php echo URL; ?>index.php?c=Auth&a=register" class="btn btn-patos btn-sm rounded-pill px-3 me-2">
                                <i class="bi bi-person-plus"></i> Registrarse
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo URL; ?>index.php?c=Auth&a=login" class="btn btn-outline-light btn-sm rounded-pill px-3">
                                <i class="bi bi-person-circle"></i> Iniciar Sesión
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item dropdown ms-2">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i> <?php echo explode(' ', $_SESSION['user_nombre'])[0]; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="<?php echo URL; ?>index.php?c=Home&a=index"><i class="bi bi-speedometer2 me-2"></i>Mi Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="<?php echo URL; ?>index.php?c=Auth&a=logout"><i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</body>
</html>

