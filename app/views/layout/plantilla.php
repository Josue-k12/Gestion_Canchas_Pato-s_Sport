<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pato's Sport - Dashboard</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo URL; ?>public/img/logo_patos.png">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/adminlte/plugins/fontawesome-free/css/all.min.css">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    
    <!-- FullCalendar (para el calendario) -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/adminlte/plugins/fullcalendar/main.css">
    
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    
    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/adminlte/plugins/toastr/toastr.min.css">

    <style>
        :root {
            --verde-patos: #0fb29a;
            --oscuro-patos: #121821;
        }

        .brand-link {
            background-color: var(--oscuro-patos) !important;
        }

        .main-sidebar {
            background-color: #343a40 !important;
        }

        .nav-link.active {
            background-color: var(--verde-patos) !important;
        }

        .btn-primary {
            background-color: var(--verde-patos) !important;
            border-color: var(--verde-patos) !important;
        }

        .btn-primary:hover {
            background-color: #0d9682 !important;
            border-color: #0d9682 !important;
        }

        .navbar-light {
            background-color: white !important;
            border-bottom: 1px solid #dee2e6;
        }

        .content-wrapper {
            background-color: #f4f6f9;
        }

        .small-box .icon {
            font-size: 70px;
        }

        .user-panel .image img {
            width: 2.1rem;
            height: 2.1rem;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo URL; ?>index.php" class="nav-link">
                        <i class="fas fa-home"></i> Inicio
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">3 Notificaciones</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-calendar mr-2"></i> Nueva reserva pendiente
                            <span class="float-right text-muted text-sm">hace 3 min</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 2 nuevos usuarios
                            <span class="float-right text-muted text-sm">hace 12 horas</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-money-bill mr-2"></i> Pago confirmado
                            <span class="float-right text-muted text-sm">hace 2 días</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">Ver todas las notificaciones</a>
                    </div>
                </li>

                <!-- User Account Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user-circle fa-lg"></i>
                        <span class="d-none d-md-inline ml-2">
                            <?php echo isset($_SESSION['user_nombre']) ? explode(' ', $_SESSION['user_nombre'])[0] : 'Usuario'; ?>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-header text-center">
                            <h5><?php echo isset($_SESSION['user_nombre']) ? $_SESSION['user_nombre'] : 'Usuario'; ?></h5>
                            <span class="badge badge-<?php 
                                $rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : 'invitado';
                                echo $rol === 'admin' ? 'danger' : ($rol === 'encargado' ? 'warning' : 'success'); 
                            ?>">
                                <?php echo ucfirst($rol); ?>
                            </span>
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

        <!-- Main Sidebar Container -->
        <?php include 'sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <?php 
            // Aquí se cargará el contenido de cada vista
            if (isset($contenido)) {
                echo $contenido;
            }
            ?>
        </div>

        <!-- Footer -->
        <?php include 'footer.php'; ?>
    </div>

    <!-- jQuery -->
    <script src="<?php echo URL; ?>public/adminlte/plugins/jquery/jquery.min.js"></script>
    
    <!-- Bootstrap 4 -->
    <script src="<?php echo URL; ?>public/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    
    <!-- DataTables -->
    <script src="<?php echo URL; ?>public/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo URL; ?>public/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    
    <!-- FullCalendar -->
    <script src="<?php echo URL; ?>public/adminlte/plugins/fullcalendar/main.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="<?php echo URL; ?>public/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
    
    <!-- Toastr -->
    <script src="<?php echo URL; ?>public/adminlte/plugins/toastr/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inicializar DataTables
            $('.datatable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                }
            });

            // Mostrar notificaciones toastr si existen
            <?php if(isset($_SESSION['mensaje'])): ?>
                toastr.success('<?php echo $_SESSION['mensaje']; ?>');
                <?php unset($_SESSION['mensaje']); ?>
            <?php endif; ?>

            <?php if(isset($_SESSION['error'])): ?>
                toastr.error('<?php echo $_SESSION['error']; ?>');
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
        });
    </script>
</body>
</html>
