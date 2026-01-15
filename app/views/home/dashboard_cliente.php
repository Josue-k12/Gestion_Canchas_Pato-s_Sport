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
        .brand-link { background-color: var(--oscuro-patos) !important; }
        .nav-link.active { background-color: var(--verde-patos) !important; }
        .btn-primary { background-color: var(--verde-patos) !important; border-color: var(--verde-patos) !important; }
        .btn-primary:hover { background-color: #0d9682 !important; }
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
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user-circle fa-lg"></i>
                        <span class="d-none d-md-inline ml-2"><?php echo explode(' ', $_SESSION['user_nombre'])[0]; ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
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
                    <!-- Estadísticas del cliente -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3><?php echo count($misReservas); ?></h3>
                                    <p>Mis Reservas</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <a href="<?php echo URL; ?>index.php?c=Reserva&a=misReservas" class="small-box-footer">
                                    Ver todas <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?php echo count($reservasActivas); ?></h3>
                                    <p>Reservas Activas</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <a href="<?php echo URL; ?>index.php?c=Reserva&a=misReservas" class="small-box-footer">
                                    Ver más <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3 style="color: white;">Ver</h3>
                                    <p style="color: white;">Canchas</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-futbol"></i>
                                </div>
                                <a href="<?php echo URL; ?>index.php?c=Cancha&a=index" class="small-box-footer">
                                    Explorar <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>Nuevo</h3>
                                    <p>Reservar</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-plus-circle"></i>
                                </div>
                                <a href="<?php echo URL; ?>index.php?c=Reserva&a=crear" class="small-box-footer">
                                    Crear reserva <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Mis reservas próximas -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-primary">
                                    <h3 class="card-title"><i class="fas fa-calendar-alt"></i> Mis Próximas Reservas</h3>
                                </div>
                                <div class="card-body">
                                    <?php if(!empty($reservasActivas)): ?>
                                    <div class="timeline">
                                        <?php foreach($reservasActivas as $reserva): ?>
                                        <div>
                                            <i class="fas fa-futbol bg-success"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fas fa-clock"></i> <?php echo date('H:i', strtotime($reserva['hora_inicio'])); ?></span>
                                                <h3 class="timeline-header"><strong><?php echo $reserva['cancha_nombre']; ?></strong></h3>
                                                <div class="timeline-body">
                                                    <p><strong>Fecha:</strong> <?php echo date('d/m/Y', strtotime($reserva['fecha'])); ?></p>
                                                    <p><strong>Horario:</strong> <?php echo date('H:i', strtotime($reserva['hora_inicio'])); ?> - <?php echo date('H:i', strtotime($reserva['hora_fin'])); ?></p>
                                                    <p><strong>Estado:</strong> 
                                                        <span class="badge badge-<?php echo $reserva['estado'] === 'confirmada' ? 'success' : 'warning'; ?>">
                                                            <?php echo ucfirst($reserva['estado']); ?>
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="timeline-footer">
                                                    <a href="<?php echo URL; ?>index.php?c=Reserva&a=detalle&id=<?php echo $reserva['id']; ?>" class="btn btn-primary btn-sm">Ver detalles</a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                        <div><i class="fas fa-clock bg-gray"></i></div>
                                    </div>
                                    <?php else: ?>
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle"></i> No tienes reservas activas en este momento.
                                        <a href="<?php echo URL; ?>index.php?c=Reserva&a=crear" class="alert-link">¿Deseas crear una?</a>
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
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
