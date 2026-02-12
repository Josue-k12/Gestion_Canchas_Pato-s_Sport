<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Reservas - Pato's Sport</title>
    
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
        
        /* Botones de acción principales responsive */
        @media (max-width: 991.98px) {
            .content-wrapper {
                margin-left: 0 !important;
            }
        }
        
        @media (max-width: 767px) {
            .row.mb-3 .col-12 {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }
            .row.mb-3 .btn {
                width: 100%;
                padding: 12px;
            }
        }
        
        /* Estilos responsive para tabla */
        @media (max-width: 767px) {
            #tablaReservas thead { display: none; }
            #tablaReservas tbody tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #dee2e6;
                border-radius: 8px;
                background: #fff;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
            #tablaReservas tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.75rem 1rem;
                border: none;
                border-bottom: 1px solid #eee;
                text-align: right;
            }
            #tablaReservas tbody td:last-child { border-bottom: none; }
            #tablaReservas tbody td::before {
                content: attr(data-label);
                font-weight: 600;
                color: #495057;
                text-align: left;
                margin-right: 10px;
            }
            #tablaReservas .btn-group { justify-content: flex-end; }
            .dataTables_wrapper .row:first-child,
            .dataTables_wrapper .row:last-child { flex-direction: column; }
            .dataTables_length, .dataTables_filter,
            .dataTables_info, .dataTables_paginate { margin: 0.5rem 0; text-align: center !important; }
            .dataTables_filter input { width: 100% !important; }
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
                            <h1><i class="fas fa-calendar-check text-info"></i> Gestión de Reservas</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo URL; ?>index.php">Inicio</a></li>
                                <li class="breadcrumb-item active">Reservas</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row mb-3">
                        <div class="col-12">
                            <a href="<?php echo URL; ?>index.php?c=Reserva&a=crear" class="btn btn-primary">
                                <i class="fas fa-plus-circle"></i> Nueva Reserva
                            </a>
                            <a href="<?php echo URL; ?>index.php?c=Calendario&a=index" class="btn btn-info">
                                <i class="fas fa-calendar-alt"></i> Ver Calendario
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary">
                                    <h3 class="card-title"><i class="fas fa-list"></i> Listado de Reservas</h3>
                                </div>
                                <div class="card-body">
                                    <?php if(!empty($reservas)): ?>
                                    <table id="tablaReservas" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Fecha</th>
                                                <th>Hora</th>
                                                <th>Cancha</th>
                                                <?php if($_SESSION['rol'] !== 'cliente'): ?>
                                                <th>Cliente</th>
                                                <?php endif; ?>
                                                <th>Estado</th>
                                                <th>Precio</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($reservas as $reserva): ?>
                                            <tr>
                                                <td data-label="ID"><?php echo $reserva['id']; ?></td>
                                                <td data-label="Fecha"><?php echo date('d/m/Y', strtotime($reserva['fecha'])); ?></td>
                                                <td data-label="Hora">
                                                    <?php echo date('H:i', strtotime($reserva['hora_inicio'])); ?> - 
                                                    <?php echo date('H:i', strtotime($reserva['hora_fin'])); ?>
                                                </td>
                                                <td data-label="Cancha">
                                                    <span class="badge badge-info">
                                                        <?php echo $reserva['cancha_nombre'] ?? 'N/A'; ?>
                                                    </span>
                                                </td>
                                                <?php if($_SESSION['rol'] !== 'cliente'): ?>
                                                <td data-label="Cliente"><?php echo $reserva['cliente_nombre'] ?? 'N/A'; ?></td>
                                                <?php endif; ?>
                                                <td data-label="Estado">
                                                    <span class="badge badge-<?php 
                                                        echo $reserva['estado'] === 'confirmada' ? 'success' : 
                                                            ($reserva['estado'] === 'pendiente' ? 'warning' : 
                                                            ($reserva['estado'] === 'cancelada' ? 'danger' : 'secondary')); 
                                                    ?>">
                                                        <?php echo ucfirst($reserva['estado']); ?>
                                                    </span>
                                                </td>
                                                <td data-label="Precio">$<?php echo number_format($reserva['precio_total'], 2); ?></td>
                                                <td data-label="Acciones">
                                                    <div class="btn-group">
                                                        <a href="<?php echo URL; ?>index.php?c=Reserva&a=detalle&id=<?php echo $reserva['id']; ?>" 
                                                           class="btn btn-sm btn-info" title="Ver detalles">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <?php if($_SESSION['rol'] === 'admin' || $_SESSION['rol'] === 'encargado'): ?>
                                                        <a href="<?php echo URL; ?>index.php?c=Reserva&a=editar&id=<?php echo $reserva['id']; ?>" 
                                                           class="btn btn-sm btn-warning" title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <?php endif; ?>
                                                        <?php if($_SESSION['rol'] === 'admin'): ?>
                                                        <a href="<?php echo URL; ?>index.php?c=Reserva&a=eliminar&id=<?php echo $reserva['id']; ?>" 
                                                           class="btn btn-sm btn-danger" 
                                                           onclick="return confirm('¿Está seguro de eliminar esta reserva?')"
                                                           title="Eliminar">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <?php else: ?>
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle"></i> No hay reservas registradas.
                                            <a href="<?php echo URL; ?>index.php?c=Reserva&a=crear" class="alert-link">¿Deseas crear una?</a>
                                        </div>
                                    <?php endif; ?>
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
        </footer>
    </div>

    <script src="<?php echo URL; ?>public/adminlte/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo URL; ?>public/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="<?php echo URL; ?>public/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo URL; ?>public/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#tablaReservas').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                },
                "order": [[1, 'desc']]
            });
        });
    </script>
</body>
</html>
