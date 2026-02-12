<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Noticias - Pato's Sport</title>
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
        html, body {
            overflow-x: hidden;
            max-width: 100vw;
        }
        .btn-primary { background-color: var(--verde-patos); border-color: var(--verde-patos); }
        .btn-primary:hover { background-color: #0d9682; }
        
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
            .card-body {
                padding: 10px;
            }
            
            /* Contenedor con scroll horizontal */
            .table-scroll-container {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                margin: 0 -10px;
                padding: 0 10px;
            }
            .table-scroll-container::-webkit-scrollbar {
                height: 8px;
            }
            .table-scroll-container::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 4px;
            }
            .table-scroll-container::-webkit-scrollbar-thumb {
                background: var(--verde-patos);
                border-radius: 4px;
            }
            .table-scroll-container::-webkit-scrollbar-thumb:hover {
                background: #0d9682;
            }
            
            #tablaNoticias {
                min-width: 800px;
                font-size: 0.85rem;
            }
            #tablaNoticias th,
            #tablaNoticias td {
                padding: 8px 10px;
                white-space: nowrap;
            }
            #tablaNoticias .btn {
                padding: 4px 8px;
                font-size: 0.75rem;
            }
            #tablaNoticias td img {
                max-width: 50px;
                height: 35px;
                object-fit: cover;
            }
            
            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter {
                text-align: left !important;
                margin-bottom: 10px;
            }
            .dataTables_wrapper .dataTables_filter input {
                width: 100% !important;
            }
            .dataTables_wrapper .row:first-child,
            .dataTables_wrapper .row:last-child {
                flex-direction: column;
            }
            .dataTables_length, .dataTables_filter,
            .dataTables_info, .dataTables_paginate {
                margin: 0.5rem 0;
                text-align: center !important;
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
                        <i class="far fa-user-circle fa-lg"></i>
                        <span class="d-none d-md-inline ml-2"><?php echo explode(' ', $_SESSION['user_nombre'])[0]; ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-header text-center">
                            <h5><?php echo $_SESSION['user_nombre']; ?></h5>
                            <span class="badge badge-danger">Admin</span>
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
            <!-- Content Header -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><i class="fas fa-newspaper text-info"></i> Gestión de Noticias</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo URL; ?>index.php">Inicio</a></li>
                                <li class="breadcrumb-item active">Noticias</li>
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
                            <h3 class="card-title"><i class="fas fa-list mr-2"></i>Listado de Noticias</h3>
                            <div class="card-tools">
                                <a href="<?php echo URL; ?>index.php?c=Noticia&a=crear" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Nueva Noticia
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-scroll-container">
                                <table id="tablaNoticias" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Título</th>
                                            <th>Descripción</th>
                                            <th>Imagen</th>
                                            <th>Autor</th>
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($noticias)): ?>
                                            <?php foreach($noticias as $noticia): ?>
                                            <tr>
                                                <td><?php echo $noticia['id']; ?></td>
                                                <td><?php echo htmlspecialchars($noticia['titulo']); ?></td>
                                                <td><?php echo htmlspecialchars(substr($noticia['descripcion'] ?? '', 0, 50)); ?>...</td>
                                                <td>
                                                    <?php if(!empty($noticia['imagen'])): ?>
                                                        <img src="<?php echo URL; ?>public/img/<?php echo htmlspecialchars($noticia['imagen']); ?>" 
                                                             alt="<?php echo htmlspecialchars($noticia['titulo']); ?>" 
                                                             style="height: 40px; width: 60px; object-fit: cover; border-radius: 4px;">
                                                    <?php else: ?>
                                                        <span class="text-muted">Sin imagen</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo htmlspecialchars($noticia['autor_nombre'] ?? 'Sistema'); ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($noticia['fecha_creacion'])); ?></td>
                                                <td>
                                                    <?php if($noticia['estado'] === 'activa'): ?>
                                                        <span class="badge badge-success">Activa</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-secondary">Inactiva</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="<?php echo URL; ?>index.php?c=Noticia&a=editar&id=<?php echo $noticia['id']; ?>" 
                                                       class="btn btn-warning btn-sm" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="<?php echo URL; ?>index.php?c=Noticia&a=eliminar&id=<?php echo $noticia['id']; ?>" 
                                                       class="btn btn-danger btn-sm" title="Eliminar"
                                                       onclick="return confirm('¿Está seguro de eliminar esta noticia?');">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="8" class="text-center">No hay noticias registradas</td>
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
    
    <script src="<?php echo URL; ?>public/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo URL; ?>public/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    
    <script>
        $(function () {
            $("#tablaNoticias").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#tablaNoticias_wrapper .col-md-6:eq(0)');
        });
    </script>
</body>
</html>
