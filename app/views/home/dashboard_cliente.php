<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Cliente - Pato's Sport</title>
    
    <link rel="icon" type="image/png" href="<?php echo URL; ?>public/img/logo_patos.png">
    <link rel="stylesheet" href="<?php echo URL; ?>public/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    
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
        
        .small-box {
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        
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
            .small-box h3 {
                font-size: 1.5rem;
            }
            .small-box p {
                font-size: 0.85rem;
            }
            .card-header h3 {
                font-size: 1rem;
            }
            
            /* Tablas responsivas estilo cards */
            .table-responsive table thead {
                display: none;
            }
            .table-responsive table,
            .table-responsive table tbody,
            .table-responsive table tr,
            .table-responsive table td {
                display: block;
                width: 100%;
            }
            .table-responsive table tr {
                margin-bottom: 15px;
                border: 1px solid #dee2e6;
                border-radius: 8px;
                padding: 10px;
                background: #fff;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
            .table-responsive table td {
                text-align: right;
                padding: 8px 10px;
                position: relative;
                padding-left: 50%;
                border: none;
                border-bottom: 1px solid #eee;
            }
            .table-responsive table td:last-child {
                border-bottom: none;
            }
            .table-responsive table td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                width: 45%;
                text-align: left;
                font-weight: bold;
                color: #333;
            }
            .table-responsive table td .btn {
                width: 100%;
                margin-top: 5px;
            }
        }
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
                        <a href="<?php echo URL; ?>index.php?c=Usuario&a=configuracion" class="dropdown-item">
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
                                <i class="fas fa-user text-success"></i> Bienvenido, <?php echo explode(' ', $_SESSION['user_nombre'])[0]; ?>
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo URL; ?>index.php">Inicio</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <!-- RF03: Estadísticas del cliente -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3><?php echo $total_alquileres; ?></h3>
                                    <p>Total Alquileres</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <a href="<?php echo URL; ?>index.php?c=Alquiler&a=misAlquileres" class="small-box-footer">
                                    Ver todos <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?php echo $total_horas; ?></h3>
                                    <p>Horas Totales</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <a href="<?php echo URL; ?>index.php?c=Alquiler&a=misAlquileres" class="small-box-footer">
                                    Ver más <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3 style="color: white;">$<?php echo number_format($total_gastado, 2); ?></h3>
                                    <p style="color: white;">Total Gastado</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <a href="<?php echo URL; ?>index.php?c=Alquiler&a=misAlquileres" class="small-box-footer">
                                    Ver detalle <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>Nuevo</h3>
                                    <p>Alquilar</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-plus-circle"></i>
                                </div>
                                <a href="<?php echo URL; ?>index.php?c=Alquiler&a=crear" class="small-box-footer">
                                    Crear alquiler <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Mis reservas próximas -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-primary">
                                    <h3 class="card-title"><i class="fas fa-history"></i> Mis Últimos 10 Alquileres</h3>
                                </div>
                                <div class="card-body">
                                    <?php if(!empty($ultimos_alquileres)): ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Fecha</th>
                                                    <th>Cancha</th>
                                                    <th>Horario</th>
                                                    <th>Valor</th>
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($ultimos_alquileres as $alquiler): ?>
                                                <tr>
                                                    <td data-label="Fecha"><?php echo date('d/m/Y', strtotime($alquiler['alquiler_fecha'])); ?></td>
                                                    <td data-label="Cancha"><i class="fas fa-futbol"></i> <?php echo $alquiler['cancha_nombre']; ?></td>
                                                    <td data-label="Horario"><?php echo date('H:i', strtotime($alquiler['alquiler_hora_inicial'])); ?> - <?php echo date('H:i', strtotime($alquiler['alquiler_hora_final'])); ?></td>
                                                    <td data-label="Valor"><strong>$<?php echo number_format($alquiler['alquiler_valor'], 2); ?></strong></td>
                                                    <td data-label="Estado">
                                                        <?php
                                                        $badgeClass = 'secondary';
                                                        switch(strtolower($alquiler['estado_nombre'])) {
                                                            case 'registrado':
                                                                $badgeClass = 'info';
                                                                break;
                                                            case 'aprobado':
                                                                $badgeClass = 'success';
                                                                break;
                                                            case 'finalizado':
                                                                $badgeClass = 'primary';
                                                                break;
                                                            case 'cancelado':
                                                                $badgeClass = 'danger';
                                                                break;
                                                            case 'anulado':
                                                                $badgeClass = 'dark';
                                                                break;
                                                        }
                                                        ?>
                                                        <span class="badge badge-<?php echo $badgeClass; ?>">
                                                            <?php echo ucfirst($alquiler['estado_nombre']); ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php else: ?>
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle"></i> No tienes alquileres registrados todavía.
                                        <a href="<?php echo URL; ?>index.php?c=Alquiler&a=crear" class="alert-link">¿Deseas crear uno?</a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Acciones rápidas -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-bolt"></i> Acceso Rápido</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a href="<?php echo URL; ?>index.php?c=Cancha&a=index" class="btn btn-app btn-primary">
                                                <i class="fas fa-search"></i> Ver Canchas
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="<?php echo URL; ?>index.php?c=Calendario&a=index" class="btn btn-app btn-warning">
                                                <i class="fas fa-calendar"></i> Calendario
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="<?php echo URL; ?>index.php?c=Partido&a=index" class="btn btn-app bg-orange">
                                                <i class="fas fa-trophy"></i> Torneos
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="<?php echo URL; ?>index.php?c=Pago&a=misPagos" class="btn btn-app btn-info">
                                                <i class="fas fa-file-invoice"></i> Mis Pagos
                                            </a>
                                        </div>
                                    </div>
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
</body>
</html>
