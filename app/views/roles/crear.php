<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Rol - Pato's Sport</title>
    <link rel="icon" type="image/png" href="<?php echo URL; ?>public/img/logo_patos.png">
    <link rel="stylesheet" href="<?php echo URL; ?>public/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <style>
        :root {
            --verde-patos: #0fb29a;
            --oscuro-patos: #121821;
        }
        .btn-primary { background-color: var(--verde-patos); border-color: var(--verde-patos); }
        .btn-primary:hover { background-color: #0d9682; }
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
                            <h1><i class="fas fa-plus-circle text-info"></i> Crear Nuevo Rol</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo URL; ?>index.php">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo URL; ?>index.php?c=Rol&a=index">Roles</a></li>
                                <li class="breadcrumb-item active">Crear</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Formulario de Rol</h3>
                                </div>
                                <form method="POST" class="form-horizontal">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nombre">Nombre del Rol <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="descripcion">Descripción</label>
                                            <textarea class="form-control" id="descripcion" name="descripcion" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a href="<?php echo URL; ?>index.php?c=Rol&a=index" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left"></i> Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-primary float-right">
                                            <i class="fas fa-save"></i> Crear
                                        </button>
                                    </div>
                                </form>
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
</body>
</html>
