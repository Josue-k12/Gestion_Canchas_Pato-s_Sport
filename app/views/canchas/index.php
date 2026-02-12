<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Canchas - Pato's Sport</title>
    
    <link rel="icon" type="image/png" href="<?php echo URL; ?>public/img/logo_patos.png">
    <link rel="stylesheet" href="<?php echo URL; ?>public/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    
    <style>
        :root {
            --verde-patos: #0fb29a;
            --oscuro-patos: #121821;
        }
        .brand-link { background-color: var(--oscuro-patos) !important; }
        .nav-link.active { background-color: var(--verde-patos) !important; }
        .btn-primary { background-color: var(--verde-patos) !important; border-color: var(--verde-patos) !important; }
        
        /* Estilos responsivos para móviles */
        @media (max-width: 991.98px) {
            .main-header .navbar-nav {
                flex-direction: row !important;
            }
            .main-header .navbar-nav .nav-item {
                display: flex !important;
            }
            .content-wrapper {
                margin-left: 0 !important;
            }
        }
        
        @media (max-width: 767px) {
            .card-header h3 {
                font-size: 1rem;
            }
            
            /* Tablas responsivas estilo cards */
            #tablaCanchas thead {
                display: none;
            }
            #tablaCanchas,
            #tablaCanchas tbody,
            #tablaCanchas tr,
            #tablaCanchas td {
                display: block;
                width: 100%;
            }
            #tablaCanchas tr {
                margin-bottom: 15px;
                border: 1px solid #dee2e6;
                border-radius: 8px;
                padding: 10px;
                background: #fff;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
            #tablaCanchas td {
                text-align: right;
                padding: 8px 10px;
                position: relative;
                padding-left: 50%;
                border: none;
                border-bottom: 1px solid #eee;
            }
            #tablaCanchas td:last-child {
                border-bottom: none;
            }
            #tablaCanchas td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                width: 45%;
                text-align: left;
                font-weight: bold;
                color: #333;
            }
            #tablaCanchas td .btn {
                margin: 2px;
            }
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
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
                            <span class="badge badge-<?php echo $_SESSION['rol'] === 'admin' ? 'danger' : ($_SESSION['rol'] === 'encargado' ? 'warning' : 'success'); ?>">
                                <?php echo ucfirst($_SESSION['rol']); ?>
                            </span>
                        </div>
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
                            <h1><i class="fas fa-futbol text-success"></i> Gestión de Canchas</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo URL; ?>index.php">Inicio</a></li>
                                <li class="breadcrumb-item active">Canchas</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <?php if($_SESSION['rol'] === 'admin' || $_SESSION['rol'] === 'encargado'): ?>
                    <div class="row mb-3">
                        <div class="col-12">
                            <a href="<?php echo URL; ?>index.php?c=Cancha&a=crear" class="btn btn-primary">
                                <i class="fas fa-plus-circle"></i> Nueva Cancha
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="row">
                        <?php if(!empty($canchas)): ?>
                            <?php foreach($canchas as $cancha): ?>
                            <div class="col-md-4">
                                <div class="card">
                                    <?php if(!empty($cancha['imagen'])): ?>
                                    <img src="<?php echo URL; ?>public/img/canchas/<?php echo $cancha['imagen']; ?>" class="card-img-top" alt="<?php echo $cancha['nombre']; ?>" style="height: 200px; object-fit: cover;">
                                    <?php else: ?>
                                    <div class="card-img-top bg-secondary text-white text-center py-5">
                                        <i class="fas fa-futbol fa-5x"></i>
                                    </div>
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $cancha['nombre']; ?></h5>
                                        <p class="card-text">
                                            <strong>Tipo:</strong> <?php echo ucfirst($cancha['tipo'] ?? 'Fútbol'); ?><br>
                                            <strong>Precio:</strong> $<?php echo number_format($cancha['precio_hora'], 2); ?>/hora<br>
                                            <strong>Estado:</strong> 
                                            <span class="badge badge-<?php echo $cancha['estado'] === 'disponible' ? 'success' : 'warning'; ?>">
                                                <?php echo ucfirst($cancha['estado']); ?>
                                            </span>
                                        </p>
                                        <div class="btn-group btn-block">
                                            <?php if($_SESSION['rol'] === 'cliente'): ?>
                                                <a href="<?php echo URL; ?>index.php?c=Reserva&a=crear&cancha=<?php echo $cancha['id']; ?>" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-calendar-plus"></i> Reservar
                                                </a>
                                            <?php else: ?>
                                                <a href="<?php echo URL; ?>index.php?c=Cancha&a=editar&id=<?php echo $cancha['id']; ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Editar
                                                </a>
                                                <?php if($_SESSION['rol'] === 'admin'): ?>
                                                <a href="<?php echo URL; ?>index.php?c=Cancha&a=eliminar&id=<?php echo $cancha['id']; ?>" 
                                                   class="btn btn-danger btn-sm" 
                                                   onclick="return confirm('¿Está seguro de eliminar esta cancha?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> No hay canchas registradas.
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2026 <a href="#">Pato's Sport</a>.</strong> Todos los derechos reservados.
        </footer>
    </div>

    <script src="<?php echo URL; ?>public/adminlte/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo URL; ?>public/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
