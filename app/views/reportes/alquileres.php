<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Alquileres - Pato's Sport</title>
    <link rel="icon" type="image/png" href="<?php echo URL; ?>public/img/logo_patos.png">
    <link rel="stylesheet" href="<?php echo URL; ?>public/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <style>
        :root {
            --verde-patos: #0fb29a;
            --oscuro-patos: #121821;
        }
        .btn-primary { background-color: var(--verde-patos); border-color: var(--verde-patos); }
        .btn-primary:hover { background-color: #0d9682; }
        .badge-registrado { background-color: #6c757d; }
        .badge-aprobado { background-color: #28a745; }
        .badge-finalizado { background-color: #17a2b8; }
        .badge-anulado { background-color: #dc3545; }
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
                            <span class="badge badge-danger">Admin</span>
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
            <!-- Content Header -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><i class="fas fa-chart-bar text-danger"></i> Reporte de Alquileres</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo URL; ?>index.php">Inicio</a></li>
                                <li class="breadcrumb-item active">Reportes</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Filtros -->
                    <div class="card card-light">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-filter"></i> Filtros</h3>
                        </div>
                        <div class="card-body">
                            <form method="GET" class="form-inline">
                                <input type="hidden" name="c" value="Reporte">
                                <input type="hidden" name="a" value="alquileres">
                                
                                <div class="form-group mr-3">
                                    <label for="estado" class="mr-2">Estado:</label>
                                    <select class="form-control" id="estado" name="estado">
                                        <option value="">-- Todos --</option>
                                        <?php foreach ($estados as $estado): ?>
                                            <option value="<?php echo $estado['estado_id']; ?>" <?php echo $filtroEstado == $estado['estado_id'] ? 'selected' : ''; ?>>
                                                <?php echo $estado['estado_nombre']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group mr-3">
                                    <label for="fecha" class="mr-2">Fecha:</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $filtroFecha; ?>">
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Filtrar
                                </button>
                                <a href="<?php echo URL; ?>index.php?c=Reporte&a=alquileres" class="btn btn-secondary ml-2">
                                    <i class="fas fa-redo"></i> Limpiar
                                </a>
                            </form>
                        </div>
                    </div>

                    <!-- Totales -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?php echo $totales['total']; ?></h3>
                                    <p>Alquileres Registrados</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>$<?php echo number_format($totales['ingresos'], 2); ?></h3>
                                    <p>Ingresos Total</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?php echo $totales['total'] > 0 ? number_format($totales['ingresos'] / $totales['total'], 2) : '0.00'; ?></h3>
                                    <p>Promedio por Alquiler</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-chart-pie"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabla de Alquileres -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-list"></i> Detalle de Alquileres</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-warning btn-sm" onclick="window.print()">
                                    <i class="fas fa-print"></i> Imprimir
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="tablaReporte" class="table table-bordered table-striped">
                                <thead class="bg-danger text-white">
                                    <tr>
                                        <th>ID</th>
                                        <th>Usuario</th>
                                        <th>Cancha</th>
                                        <th>Fecha</th>
                                        <th>Hora Inicio</th>
                                        <th>Hora Fin</th>
                                        <th>Valor</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($alquileres)): ?>
                                        <?php foreach ($alquileres as $alquiler): ?>
                                            <tr>
                                                <td><?php echo $alquiler['alquiler_id']; ?></td>
                                                <td><?php echo $alquiler['usuario_nombre'] ?? '-'; ?></td>
                                                <td><?php echo $alquiler['cancha_nombre'] ?? '-'; ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($alquiler['alquiler_fecha'])); ?></td>
                                                <td><?php echo substr($alquiler['alquiler_hora_inicial'], 0, 5); ?></td>
                                                <td><?php echo substr($alquiler['alquiler_hora_final'], 0, 5); ?></td>
                                                <td>$<?php echo number_format($alquiler['alquiler_valor'], 2); ?></td>
                                                <td>
                                                    <span class="badge badge-<?php 
                                                        $estado = strtolower($alquiler['estado_nombre']);
                                                        echo str_replace(' ', '-', $estado);
                                                    ?>">
                                                        <?php echo $alquiler['estado_nombre'] ?? '-'; ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="8" class="text-center text-muted">No hay alquileres para mostrar</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
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
    <script src="<?php echo URL; ?>public/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo URL; ?>public/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tablaReporte').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                },
                pageLength: 15,
                responsive: true
            });
        });
    </script>
</body>
</html>
