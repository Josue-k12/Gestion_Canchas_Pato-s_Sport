<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Alquileres - Pato's Sport</title>
    
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
        
        .table thead th {
            background-color: #f9f9f9;
            border-top: none;
            font-weight: 600;
            color: #333;
        }
        
        .badge-registrado { background-color: #ffc107; color: black; }
        .badge-aprobado { background-color: #28a745; }
        .badge-finalizado { background-color: #6c757d; }
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
                                <i class="fas fa-list text-info"></i> Mis Alquileres
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo URL; ?>index.php">Inicio</a></li>
                                <li class="breadcrumb-item active">Mis Alquileres</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <?php if (isset($_SESSION['mensaje'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> <?php echo $_SESSION['mensaje']; ?>
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                        <?php unset($_SESSION['mensaje']); ?>
                    <?php endif; ?>

                    <div class="row mb-3">
                        <div class="col-12">
                            <a href="<?php echo URL; ?>index.php?c=Alquiler&a=crear" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Nueva Reserva
                            </a>
                            <button type="button" class="btn btn-warning ml-2" data-toggle="modal" data-target="#modalImportante">
                                <i class="fas fa-exclamation-circle"></i> Importante
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Listado de Alquileres</h3>
                                </div>

                                <div class="card-body">
                                    <?php if (empty($alquileres)): ?>
                                        <div class="alert alert-info text-center">
                                            <i class="fas fa-info-circle"></i> No hay alquileres registrados.
                                            <a href="<?php echo URL; ?>index.php?c=Alquiler&a=crear" class="alert-link">¿Deseas crear uno?</a>
                                        </div>
                                    <?php else: ?>
                                        <table id="tablaAlquileres" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Cancha</th>
                                                    <th>Fecha</th>
                                                    <th>Hora Inicial</th>
                                                    <th>Hora Final</th>
                                                    <th>Valor</th>
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($alquileres as $alquiler): ?>
                                                    <tr>
                                                        <td><?php echo $alquiler['cancha_nombre']; ?></td>
                                                        <td><?php echo date('d/m/Y', strtotime($alquiler['alquiler_fecha'])); ?></td>
                                                        <td><?php echo $alquiler['alquiler_hora_inicial']; ?></td>
                                                        <td><?php echo $alquiler['alquiler_hora_final']; ?></td>
                                                        <td>$<?php echo number_format($alquiler['alquiler_valor'], 0, ',', '.'); ?></td>
                                                        <td>
                                                            <span class="badge badge-<?php echo $alquiler['estado_nombre']; ?>">
                                                                <?php echo ucfirst($alquiler['estado_nombre']); ?>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Footer -->
        <?php include 'app/views/layout/footer.php'; ?>
    </div>

    <!-- Modal Importante -->
    <div class="modal fade" id="modalImportante" tabindex="-1" role="dialog" aria-labelledby="modalImportanteLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content border-warning">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="modalImportanteLabel">
                        <i class="fas fa-exclamation-triangle"></i> Aviso Importante
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <h5 class="alert-heading font-weight-bold">
                            <i class="fas fa-phone-alt"></i> Cambios en tu Reserva
                        </h5>
                        <hr>
                        <p class="mb-0">
                            Si necesitas realizar cambios en:
                        </p>
                        <ul class="mt-2 mb-3">
                            <li>La fecha de tu reserva</li>
                            <li>La cancha seleccionada</li>
                            <li>Las horas de alquiler</li>
                            <li>Cualquier otra solicitud especial</li>
                        </ul>
                        <p class="mb-0">
                            <strong>Por favor, comunícate directamente al siguiente número:</strong>
                        </p>
                        <div class="mt-3 p-3 bg-white rounded border-left-4 border-warning">
                            <h6 class="font-weight-bold text-warning">
                                <i class="fas fa-mobile-alt"></i> +593 98 457 7224
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo URL; ?>public/adminlte/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo URL; ?>public/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo URL; ?>public/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo URL; ?>public/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo URL; ?>public/adminlte/dist/js/adminlte.min.js"></script>

    <script>
        // Inicializar dropdowns de Bootstrap
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownElements = document.querySelectorAll('[data-toggle="dropdown"]');
            dropdownElements.forEach(function(element) {
                new bootstrap.Dropdown(element);
            });
        });

        $(function () {
            $("#tablaAlquileres").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "pageLength": 10,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            });
        });
    </script>

</body>
</html>
