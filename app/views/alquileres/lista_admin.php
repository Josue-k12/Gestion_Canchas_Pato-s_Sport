<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alquileres - Pato's Sport</title>
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
        .badge-info { background-color: #17a2b8; }
        .badge-success { background-color: #28a745; }
        .badge-danger { background-color: #dc3545; }
        .badge-primary { background-color: #007bff; }
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
                            <h1><i class="fas fa-calendar-check text-success"></i> Gestión de Alquileres</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo URL; ?>index.php">Inicio</a></li>
                                <li class="breadcrumb-item active">Alquileres</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    
                    <?php if(isset($_SESSION['mensaje'])): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <i class="icon fas fa-check"></i> <?php echo $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?>
                    </div>
                    <?php endif; ?>

                    <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <i class="icon fas fa-ban"></i> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                    </div>
                    <?php endif; ?>

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-list mr-2"></i>Listado de Todos los Alquileres</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tablaAlquileres" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Usuario</th>
                                            <th>Cancha</th>
                                            <th>Fecha</th>
                                            <th>Hora Inicio</th>
                                            <th>Hora Final</th>
                                            <th>Valor</th>
                                            <th>Estado</th>
                                            <th>Comprobante</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($alquileres)): ?>
                                            <?php foreach($alquileres as $alquiler): ?>
                                            <tr>
                                                <td><?php echo $alquiler['alquiler_id']; ?></td>
                                                <td>
                                                    <i class="fas fa-user"></i>
                                                    <?php echo htmlspecialchars($alquiler['usuario_nombre']); ?>
                                                </td>
                                                <td>
                                                    <i class="fas fa-futbol"></i>
                                                    <?php echo htmlspecialchars($alquiler['cancha_nombre']); ?>
                                                </td>
                                                <td><?php echo date('d/m/Y', strtotime($alquiler['alquiler_fecha'])); ?></td>
                                                <td><?php echo date('H:i', strtotime($alquiler['alquiler_hora_inicial'])); ?></td>
                                                <td><?php echo date('H:i', strtotime($alquiler['alquiler_hora_final'])); ?></td>
                                                <td>
                                                    <strong>$<?php echo number_format($alquiler['alquiler_valor'], 2); ?></strong>
                                                </td>
                                                <td>
                                                    <?php
                                                    $badgeClass = 'secondary';
                                                    switch(strtolower($alquiler['estado_nombre'])) {
                                                        case 'registrado':
                                                            $badgeClass = 'info';
                                                            break;
                                                        case 'aprobado':
                                                        case 'confirmado':
                                                            $badgeClass = 'success';
                                                            break;
                                                        case 'cancelado':
                                                            $badgeClass = 'danger';
                                                            break;
                                                        case 'finalizado':
                                                        case 'completado':
                                                            $badgeClass = 'primary';
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
                                                <td class="text-center">
                                                    <?php if(!empty($alquiler['alquiler_comprobante_pago'])): ?>
                                                        <a href="<?php echo URL . $alquiler['alquiler_comprobante_pago']; ?>" 
                                                           target="_blank" 
                                                           class="btn btn-sm btn-info" 
                                                           title="Ver comprobante">
                                                            <i class="fas fa-file-invoice"></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <span class="text-muted">Sin comprobante</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group-vertical btn-group-sm">
                                                        <?php if(strtolower($alquiler['estado_nombre']) === 'registrado'): ?>
                                                            <a href="<?php echo URL; ?>index.php?c=Alquiler&a=aprobar&id=<?php echo $alquiler['alquiler_id']; ?>" 
                                                               class="btn btn-success btn-sm mb-1" 
                                                               title="Aprobar"
                                                               onclick="return confirm('¿Aprobar este alquiler?');">
                                                                <i class="fas fa-check"></i> Aprobar
                                                            </a>
                                                        <?php endif; ?>
                                                        
                                                        <?php if(strtolower($alquiler['estado_nombre']) === 'aprobado'): ?>
                                                            <a href="<?php echo URL; ?>index.php?c=Alquiler&a=finalizar&id=<?php echo $alquiler['alquiler_id']; ?>" 
                                                               class="btn btn-primary btn-sm mb-1" 
                                                               title="Finalizar"
                                                               onclick="return confirm('¿Marcar como finalizado?');">
                                                                <i class="fas fa-flag-checkered"></i> Finalizar
                                                            </a>
                                                        <?php endif; ?>
                                                        
                                                        <?php if(in_array(strtolower($alquiler['estado_nombre']), ['registrado', 'aprobado'])): ?>
                                                            <a href="<?php echo URL; ?>index.php?c=Alquiler&a=cancelar&id=<?php echo $alquiler['alquiler_id']; ?>" 
                                                               class="btn btn-warning btn-sm mb-1" 
                                                               title="Cancelar"
                                                               onclick="return confirm('¿Cancelar este alquiler?');">
                                                                <i class="fas fa-times"></i> Cancelar
                                                            </a>
                                                        <?php endif; ?>
                                                        
                                                        <a href="<?php echo URL; ?>index.php?c=Alquiler&a=editar&id=<?php echo $alquiler['alquiler_id']; ?>" 
                                                           class="btn btn-warning btn-sm mb-1" 
                                                           title="Editar">
                                                            <i class="fas fa-edit"></i> Editar
                                                        </a>
                                                        
                                                        <a href="<?php echo URL; ?>index.php?c=Alquiler&a=eliminar&id=<?php echo $alquiler['alquiler_id']; ?>" 
                                                           class="btn btn-danger btn-sm" 
                                                           title="Eliminar"
                                                           onclick="return confirm('¿Está seguro de eliminar este alquiler?');">
                                                            <i class="fas fa-trash"></i> Eliminar
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="10" class="text-center">No hay alquileres registrados</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2026 <a href="#">Pato's Sport</a>.</strong>
            Todos los derechos reservados.
            <div class="float-right d-none d-sm-inline-block">
                <b>Versión</b> 1.0.0
            </div>
        </footer>
    </div>

    <script src="<?php echo URL; ?>public/adminlte/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo URL; ?>public/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="<?php echo URL; ?>public/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo URL; ?>public/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    
    <script>
        $(function () {
            $('#tablaAlquileres').DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                },
                "order": [[0, "desc"]],
                "pageLength": 25
            });
        });
    </script>
</body>
</html>
