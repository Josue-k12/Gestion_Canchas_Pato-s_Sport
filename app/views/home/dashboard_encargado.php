<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Encargado - Pato's Sport</title>
    
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
                    <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-danger navbar-badge"><?php echo count($reservasPendientes); ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" aria-labelledby="notificationsDropdown">
                        <span class="dropdown-item dropdown-header"><?php echo count($reservasPendientes); ?> Reservas Pendientes</span>
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo URL; ?>index.php?c=Reserva&a=index" class="dropdown-item">
                            <i class="fas fa-calendar mr-2"></i> Ver todas
                        </a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="far fa-user-circle fa-lg"></i>
                        <span class="d-none d-md-inline ml-2"><?php echo explode(' ', $_SESSION['user_nombre'])[0]; ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <div class="dropdown-header text-center">
                            <h5><?php echo $_SESSION['user_nombre']; ?></h5>
                            <span class="badge badge-warning">Encargado</span>
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
                                <i class="fas fa-clipboard-check text-warning"></i> Dashboard Encargado
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
                    <!-- Estadísticas del día -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?php echo count($reservasHoy); ?></h3>
                                    <p>Reservas Hoy</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                                <a href="<?php echo URL; ?>index.php?c=Reserva&a=index" class="small-box-footer">
                                    Ver más <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3><?php echo count($reservasPendientes); ?></h3>
                                    <p>Pendientes</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-exclamation-circle"></i>
                                </div>
                                <a href="<?php echo URL; ?>index.php?c=Reserva&a=index" class="small-box-footer">
                                    Gestionar <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?php echo $totalCanchas; ?></h3>
                                    <p>Canchas Activas</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <a href="<?php echo URL; ?>index.php?c=Cancha&a=index" class="small-box-footer">
                                    Ver estado <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>$5,240</h3>
                                    <p>Pagos Hoy</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <a href="<?php echo URL; ?>index.php?c=Pago&a=index" class="small-box-footer">
                                    Ver más <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Agenda del día y alertas -->
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-tasks"></i> Agenda del Día</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Hora</th>
                                                <th>Cancha</th>
                                                <th>Cliente</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($reservasHoy)): ?>
                                                <?php foreach(array_slice($reservasHoy, 0, 10) as $reserva): ?>
                                                <tr>
                                                    <td data-label="Hora"><?php echo date('H:i', strtotime($reserva['alquiler_hora_inicial'])); ?></td>
                                                    <td data-label="Cancha"><?php echo $reserva['cancha_nombre']; ?></td>
                                                    <td data-label="Cliente"><?php echo $reserva['usuario_nombre']; ?></td>
                                                    <td data-label="Estado">
                                                        <span class="badge badge-<?php 
                                                            $estado = strtolower($reserva['estado_nombre']);
                                                            echo $estado === 'aprobado' ? 'success' : 
                                                                ($estado === 'registrado' ? 'warning' : 
                                                                ($estado === 'finalizado' ? 'primary' : 'danger')); 
                                                        ?>">
                                                            <?php echo ucfirst($reserva['estado_nombre']); ?>
                                                        </span>
                                                    </td>
                                                    <td data-label="Acciones">
                                                        <a href="<?php echo URL; ?>index.php?c=Alquiler&a=editar&id=<?php echo $reserva['alquiler_id']; ?>" class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr><td colspan="5" class="text-center">No hay reservas para hoy</td></tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-bell"></i> Alertas</h3>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-warning">
                                        <h5><i class="icon fas fa-exclamation-triangle"></i> Atención!</h5>
                                        Tienes <?php echo count($reservasPendientes); ?> reservas pendientes de confirmación.
                                    </div>
                                    <div class="d-grid gap-2">
                                        <a href="<?php echo URL; ?>index.php?c=Reserva&a=index" class="btn btn-warning btn-block mb-2">
                                            <i class="fas fa-clipboard-check"></i> Gestionar Reservas
                                        </a>
                                        <a href="<?php echo URL; ?>index.php?c=Calendario&a=index" class="btn btn-primary btn-block mb-2">
                                            <i class="fas fa-calendar-alt"></i> Ver Calendario
                                        </a>
                                        <a href="<?php echo URL; ?>index.php?c=Cancha&a=index" class="btn btn-success btn-block mb-2">
                                            <i class="fas fa-futbol"></i> Estado Canchas
                                        </a>
                                        <a href="<?php echo URL; ?>index.php?c=Partido&a=index" class="btn btn-info btn-block">
                                            <i class="fas fa-trophy"></i> Partidos
                                        </a>
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
