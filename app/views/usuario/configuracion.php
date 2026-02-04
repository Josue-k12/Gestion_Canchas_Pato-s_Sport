<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración - Pato's Sport</title>
    
    <link rel="icon" type="image/png" href="<?php echo URL; ?>public/img/logo_patos.png">
    <link rel="stylesheet" href="<?php echo URL; ?>public/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/adminlte/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/adminlte/dist/css/adminlte.min.css">
    
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
        
        .brand-link { 
            background-color: var(--oscuro-patos) !important;
            border-bottom: 3px solid var(--verde-patos);
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
        
        .form-control:focus {
            border-color: var(--verde-patos);
            box-shadow: 0 0 0 0.2rem rgba(15, 178, 154, 0.25);
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
                                <i class="fas fa-cogs text-info"></i> Configuración
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo URL; ?>index.php">Inicio</a></li>
                                <li class="breadcrumb-item active">Configuración</li>
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

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['error']; ?>
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>

                    <div class="row">
                        <!-- Datos Personales -->
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-user-edit"></i> Datos Personales</h3>
                                </div>
                                <form action="<?php echo URL; ?>index.php?c=Usuario&a=configuracion" method="POST">
                                    <input type="hidden" name="tipo" value="datos">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nombre">Nombre Completo <span class="text-danger">*</span></label>
                                            <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $usuario['nombre']; ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Correo Electrónico <span class="text-danger">*</span></label>
                                            <input type="email" name="email" id="email" class="form-control" value="<?php echo $usuario['email']; ?>" required>
                                        </div>

                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle"></i> <strong>Nota:</strong> Al cambiar tu correo, asegúrate de tener acceso al nuevo correo.
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Guardar Cambios
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Cambiar Contraseña -->
                        <div class="col-md-6">
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-lock"></i> Cambiar Contraseña</h3>
                                </div>
                                <form action="<?php echo URL; ?>index.php?c=Usuario&a=configuracion" method="POST" id="formPassword">
                                    <input type="hidden" name="tipo" value="password">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="password_actual">Contraseña Actual <span class="text-danger">*</span></label>
                                            <input type="password" name="password_actual" id="password_actual" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="password_nueva">Nueva Contraseña <span class="text-danger">*</span></label>
                                            <input type="password" name="password_nueva" id="password_nueva" class="form-control" minlength="6" required>
                                            <small class="form-text text-muted">Mínimo 6 caracteres</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="password_confirm">Confirmar Nueva Contraseña <span class="text-danger">*</span></label>
                                            <input type="password" name="password_confirm" id="password_confirm" class="form-control" minlength="6" required>
                                        </div>

                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle"></i> <strong>Importante:</strong> Después de cambiar tu contraseña, deberás iniciar sesión nuevamente.
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-warning">
                                            <i class="fas fa-key"></i> Cambiar Contraseña
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <a href="<?php echo URL; ?>index.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver al Inicio
                            </a>
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
    <script src="<?php echo URL; ?>public/adminlte/dist/js/adminlte.min.js"></script>

    <script>
        // Inicializar dropdowns de Bootstrap
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownElements = document.querySelectorAll('[data-toggle="dropdown"]');
            dropdownElements.forEach(function(element) {
                new bootstrap.Dropdown(element);
            });
        });

        // Validar que las contraseñas coincidan
        document.getElementById('formPassword').addEventListener('submit', function(e) {
            const passwordNueva = document.getElementById('password_nueva').value;
            const passwordConfirm = document.getElementById('password_confirm').value;

            if (passwordNueva !== passwordConfirm) {
                e.preventDefault();
                alert('Las contraseñas nuevas no coinciden');
                return false;
            }
        });
    </script>

</body>
</html>
