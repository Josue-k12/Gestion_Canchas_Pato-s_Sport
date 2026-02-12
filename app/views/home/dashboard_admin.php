<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Pato's Sport</title>
    
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
            .table-responsive table thead,
            #tablaAlquileresRecientes thead {
                display: none;
            }
            .table-responsive table,
            .table-responsive table tbody,
            .table-responsive table tr,
            .table-responsive table td,
            #tablaAlquileresRecientes,
            #tablaAlquileresRecientes tbody,
            #tablaAlquileresRecientes tr,
            #tablaAlquileresRecientes td {
                display: block;
                width: 100%;
            }
            .table-responsive table tr,
            #tablaAlquileresRecientes tr {
                margin-bottom: 15px;
                border: 1px solid #dee2e6;
                border-radius: 10px;
                padding: 12px;
                background: #fff;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            }
            .table-responsive table td,
            #tablaAlquileresRecientes td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 12px;
                border: none;
                border-bottom: 1px solid #f0f0f0;
                text-align: right;
            }
            .table-responsive table td:last-child,
            #tablaAlquileresRecientes td:last-child {
                border-bottom: none;
            }
            .table-responsive table td::before,
            #tablaAlquileresRecientes td::before {
                content: attr(data-label);
                font-weight: 700;
                color: #495057;
                text-align: left;
                flex-shrink: 0;
                margin-right: 10px;
            }
            .table-responsive table td .btn,
            #tablaAlquileresRecientes td .btn {
                margin: 2px;
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
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">3 Notificaciones</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-calendar mr-2"></i> Nueva reserva
                            <span class="float-right text-muted text-sm">3 min</span>
                        </a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user-circle fa-lg"></i>
                        <span class="d-none d-md-inline ml-2"><?php echo explode(' ', $_SESSION['user_nombre'])[0]; ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-header text-center">
                            <h5><?php echo $_SESSION['user_nombre']; ?></h5>
                            <span class="badge badge-danger">Admin</span>
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
                                <i class="fas fa-tachometer-alt text-danger"></i> Dashboard Administrador
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
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?php echo $totalAlquileres; ?></h3>
                                    <p>Alquileres Totales</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <a href="<?php echo URL; ?>index.php?c=Alquiler&a=index" class="small-box-footer">
                                    Ver más <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?php echo $totalUsuarios; ?></h3>
                                    <p>Usuarios Registrados</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <a href="<?php echo URL; ?>index.php?c=Usuario&a=index" class="small-box-footer">
                                    Ver más <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?php echo $totalCanchas; ?></h3>
                                    <p>Canchas Disponibles</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-futbol"></i>
                                </div>
                                <a href="<?php echo URL; ?>index.php?c=Cancha&a=index" class="small-box-footer">
                                    Ver más <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>$<?php echo number_format($ingresosDelMes, 2); ?></h3>
                                    <p>Ingresos del Mes</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <a href="<?php echo URL; ?>index.php?c=Reporte&a=index" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-list"></i> Alquileres Recientes</h3>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="tablaAlquileresRecientes">
                                            <thead>
                                                <tr>
                                                    <th>Cliente</th>
                                                    <th>Cancha</th>
                                                    <th>Fecha</th>
                                                    <th>Horario</th>
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($alquileresRecientes)): ?>
                                                    <?php foreach($alquileresRecientes as $alquiler): ?>
                                                    <tr>
                                                        <td data-label="Cliente"><?php echo $alquiler['usuario_nombre'] ?? 'N/A'; ?></td>
                                                        <td data-label="Cancha"><?php echo $alquiler['cancha_nombre'] ?? 'N/A'; ?></td>
                                                        <td data-label="Fecha"><?php echo date('d/m/Y', strtotime($alquiler['alquiler_fecha'])); ?></td>
                                                        <td data-label="Horario"><?php echo date('H:i', strtotime($alquiler['alquiler_hora_inicial'])); ?> - <?php echo date('H:i', strtotime($alquiler['alquiler_hora_final'])); ?></td>
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
                                                <?php else: ?>
                                                    <tr><td colspan="5" class="text-center">No hay alquileres recientes</td></tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-primary">
                                    <h3 class="card-title"><i class="fas fa-bolt"></i> Acciones Rápidas</h3>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="<?php echo URL; ?>index.php?c=Alquiler&a=crear" class="btn btn-primary btn-block mb-2">
                                            <i class="fas fa-plus-circle"></i> Nuevo Alquiler
                                        </a>
                                        <a href="<?php echo URL; ?>index.php?c=Cancha&a=crear" class="btn btn-success btn-block mb-2">
                                            <i class="fas fa-futbol"></i> Añadir Cancha
                                        </a>
                                        <a href="<?php echo URL; ?>index.php?c=Usuario&a=crear" class="btn btn-info btn-block mb-2">
                                            <i class="fas fa-user-plus"></i> Nuevo Usuario
                                        </a>
                                        <a href="<?php echo URL; ?>index.php?c=Alquiler&a=index" class="btn btn-warning btn-block">
                                            <i class="fas fa-list"></i> Listar Alquileres
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-warning">
                                    <h3 class="card-title"><i class="fas fa-clock"></i> Pendientes por Aprobar (<?php echo count($alquileresPendientes); ?>)</h3>
                                </div>
                                <div class="card-body">
                                    <?php if(!empty($alquileresPendientes)): ?>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Cliente</th>
                                                    <th>Cancha</th>
                                                    <th>Fecha</th>
                                                    <th>Hora Inicio</th>
                                                    <th>Hora Fin</th>
                                                    <th>Valor</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($alquileresPendientes as $alquiler): ?>
                                                <tr>
                                                    <td data-label="Cliente"><strong><?php echo $alquiler['usuario_nombre']; ?></strong></td>
                                                    <td data-label="Cancha"><?php echo $alquiler['cancha_nombre']; ?></td>
                                                    <td data-label="Fecha"><?php echo date('d/m/Y', strtotime($alquiler['alquiler_fecha'])); ?></td>
                                                    <td data-label="Hora Inicio"><?php echo date('H:i', strtotime($alquiler['alquiler_hora_inicial'])); ?></td>
                                                    <td data-label="Hora Fin"><?php echo date('H:i', strtotime($alquiler['alquiler_hora_final'])); ?></td>
                                                    <td data-label="Valor"><strong>$<?php echo number_format($alquiler['alquiler_valor'], 2); ?></strong></td>
                                                    <td data-label="Acciones">
                                                        <a href="<?php echo URL; ?>index.php?c=Alquiler&a=aprobar&id=<?php echo $alquiler['alquiler_id']; ?>" class="btn btn-success btn-sm" onclick="return confirm('¿Aprobar este alquiler?')">
                                                            <i class="fas fa-check"></i> Aprobar
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php else: ?>
                                    <div class="alert alert-success">
                                        <i class="fas fa-check-circle"></i> ¡Excelente! No hay alquileres pendientes de aprobación.
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h3 class="card-title"><i class="fas fa-chart-line"></i> Progreso de Uso por Meses (Últimos 12 meses)</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="chartProgreso" style="min-height: 250px; height: 250px; max-height: 250px;"></canvas>
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
    <script src="<?php echo URL; ?>public/adminlte/plugins/chart.js/Chart.min.js"></script>
    <script>
        // Gráfico de progreso de uso por meses
        const ctx = document.getElementById('chartProgreso').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($datosGrafico['labels']); ?>,
                datasets: [
                    {
                        label: 'Horas de uso',
                        data: <?php echo json_encode($datosGrafico['horas']); ?>,
                        borderColor: '#0fb29a',
                        backgroundColor: 'rgba(15, 178, 154, 0.1)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 2,
                        pointRadius: 4,
                        pointBackgroundColor: '#0fb29a',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2
                    },
                    {
                        label: 'Ingresos ($)',
                        data: <?php echo json_encode($datosGrafico['ingresos']); ?>,
                        borderColor: '#dc3545',
                        backgroundColor: 'rgba(220, 53, 69, 0.1)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 2,
                        pointRadius: 4,
                        pointBackgroundColor: '#dc3545',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: { size: 12 }
                        }
                    },
                    title: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Horas'
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Ingresos ($)'
                        },
                        grid: {
                            drawOnChartArea: false,
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
