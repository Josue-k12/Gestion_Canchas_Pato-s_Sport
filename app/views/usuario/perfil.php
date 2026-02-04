<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Pato's Sport</title>
    
    <link rel="icon" type="image/png" href="<?php echo URL; ?>public/img/logo_patos.png">
    <link rel="stylesheet" href="<?php echo URL; ?>public/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/adminlte/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/adminlte/dist/css/adminlte.min.css">
    
    <style>
        :root {
            --verde-patos: #0fb29a;
            --oscuro-patos: #121821;
        }
        
        body { background-color: #f4f4f4; }
        
        .main-header {
            background-color: white;
            border-bottom: 3px solid var(--verde-patos);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .main-header .navbar-nav .nav-link {
            color: #333 !important;
            font-weight: 500;
            transition: 0.3s;
        }
        
        .main-header .navbar-nav .nav-link:hover {
            color: var(--verde-patos) !important;
        }
        
        .main-header .navbar-nav .dropdown-menu {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.15);
            border-radius: 8px;
        }
        
        .brand-link { 
            background-color: var(--oscuro-patos) !important;
            border-bottom: 3px solid var(--verde-patos);
        }
        
        .nav-link.active { 
            background-color: var(--verde-patos) !important;
            border-radius: 5px;
        }
        
        .btn-primary { 
            background-color: var(--verde-patos) !important; 
            border-color: var(--verde-patos) !important;
            transition: 0.3s;
        }
        
        .btn-primary:hover { 
            background-color: #0d9682 !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(15, 178, 154, 0.3);
        }
        
        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        
        .card-header {
            background-color: var(--verde-patos) !important;
            color: white;
            font-weight: 600;
            border-radius: 8px 8px 0 0;
        }
        
        .profile-section {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .profile-header {
            text-align: center;
            padding: 30px 0;
            border-bottom: 2px solid var(--verde-patos);
            margin-bottom: 30px;
        }
        
        .profile-avatar {
            font-size: 80px;
            color: var(--verde-patos);
            margin-bottom: 20px;
        }
        
        .profile-info-group {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-left: 4px solid var(--verde-patos);
            border-radius: 4px;
        }
        
        .profile-info-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
            font-size: 0.9em;
            text-transform: uppercase;
        }
        
        .profile-info-value {
            font-size: 1.1em;
            color: #333;
        }
        
        .badge-cliente { background-color: #28a745; }
        .badge-admin { background-color: #dc3545; }
        .badge-encargado { background-color: #ffc107; color: black; }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo URL; ?>index.php" class="nav-link"><i class="fas fa-home"></i> Inicio</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="far fa-user-circle fa-lg"></i>
                        <span class="d-none d-md-inline ml-2"><?php echo explode(' ', $_SESSION['user_nombre'])[0]; ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <div class="dropdown-header text-center">
                            <h5><?php echo $_SESSION['user_nombre']; ?></h5>
                            <span class="badge badge-success">Cliente</span>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo URL; ?>index.php?c=Usuario&a=perfil" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i> Mi Perfil
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-cog mr-2"></i> Configuración
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo URL; ?>index.php?c=Auth&a=logout" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
                        </a>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Sidebar -->
        <?php include 'app/views/layout/sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">
                                <i class="fas fa-user-circle text-success"></i> Mi Perfil
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo URL; ?>index.php">Inicio</a></li>
                                <li class="breadcrumb-item active">Mi Perfil</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <!-- Información del Perfil -->
                            <div class="profile-section">
                                <div class="profile-header">
                                    <div class="profile-avatar">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                    <h2 class="mb-2"><?php echo $usuario['nombre']; ?></h2>
                                    <span class="badge badge-lg badge-<?php echo strtolower($usuario['rol_nombre']); ?>">
                                        <?php echo ucfirst($usuario['rol_nombre']); ?>
                                    </span>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="profile-info-group">
                                            <div class="profile-info-label">
                                                <i class="fas fa-envelope"></i> Correo Electrónico
                                            </div>
                                            <div class="profile-info-value">
                                                <?php echo $usuario['email']; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="profile-info-group">
                                            <div class="profile-info-label">
                                                <i class="fas fa-phone"></i> Teléfono
                                            </div>
                                            <div class="profile-info-value">
                                                <?php echo !empty($usuario['telefono']) ? $usuario['telefono'] : 'No registrado'; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="profile-info-group">
                                            <div class="profile-info-label">
                                                <i class="fas fa-calendar"></i> ID de Usuario
                                            </div>
                                            <div class="profile-info-value">
                                                #<?php echo $usuario['id']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="profile-info-group">
                                            <div class="profile-info-label">
                                                <i class="fas fa-info-circle"></i> Estado de la Cuenta
                                            </div>
                                            <div class="profile-info-value">
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check-circle"></i> Activa
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Acciones -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <a href="<?php echo URL; ?>index.php" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Volver
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2026 <a href="#">Pato's Sport</a>.</strong> Todos los derechos reservados.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>
    </div>

    <script src="<?php echo URL; ?>public/adminlte/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo URL; ?>public/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo URL; ?>public/adminlte/dist/js/adminlte.min.js"></script>

    <script>
        // Inicializar dropdowns de Bootstrap
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownElements = document.querySelectorAll('[data-toggle="dropdown"]');
            dropdownElements.forEach(function(element) {
                new bootstrap.Dropdown(element);
            });
        });
    </script>

</body>
</html>
