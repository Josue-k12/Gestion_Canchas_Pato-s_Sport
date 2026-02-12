<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cancha - Pato's Sport</title>
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
        .preview-image, .current-image {
            max-width: 300px;
            max-height: 300px;
            margin-top: 10px;
        }
        /* Estilos responsivos */
        @media (max-width: 991.98px) {
            .main-header .navbar-nav { flex-direction: row !important; }
            .main-header .navbar-nav .nav-item { display: flex !important; }
        }
        @media (max-width: 576px) {
            .btn { width: 100%; margin-bottom: 0.5rem; }
            .card-footer { display: flex; flex-direction: column; }
            .preview-image, .current-image { max-width: 100%; }
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
                            <h1><i class="fas fa-futbol text-success"></i> Editar Cancha</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo URL; ?>index.php">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo URL; ?>index.php?c=Cancha&a=index">Canchas</a></li>
                                <li class="breadcrumb-item active">Editar</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-edit mr-2"></i>Datos de la Cancha</h3>
                                </div>
                                
                                <form action="<?php echo URL; ?>index.php?c=Cancha&a=editar&id=<?php echo $cancha['id']; ?>" method="POST" enctype="multipart/form-data">
                                    <div class="card-body">
                                        
                                        <?php if(isset($_SESSION['error'])): ?>
                                        <div class="alert alert-danger alert-dismissible fade show">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <i class="icon fas fa-ban"></i> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                                        </div>
                                        <?php endif; ?>

                                        <div class="form-group">
                                            <label for="nombre">Nombre <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($cancha['nombre']); ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="tipo">Tipo <span class="text-danger">*</span></label>
                                            <select class="form-control" id="tipo" name="tipo" required>
                                                <option value="">Seleccione...</option>
                                                <option value="futbol" <?php echo $cancha['tipo'] === 'futbol' ? 'selected' : ''; ?>>Fútbol</option>
                                                <option value="futsal" <?php echo $cancha['tipo'] === 'futsal' ? 'selected' : ''; ?>>Futsal</option>
                                                <option value="tenis" <?php echo $cancha['tipo'] === 'tenis' ? 'selected' : ''; ?>>Tenis</option>
                                                <option value="basquet" <?php echo $cancha['tipo'] === 'basquet' ? 'selected' : ''; ?>>Básquet</option>
                                                <option value="voley" <?php echo $cancha['tipo'] === 'voley' ? 'selected' : ''; ?>>Vóley</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="precio_hora">Precio por Hora <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="number" step="0.01" class="form-control" id="precio_hora" name="precio_hora" value="<?php echo $cancha['precio_hora']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="estado">Estado <span class="text-danger">*</span></label>
                                            <select class="form-control" id="estado" name="estado" required>
                                                <option value="disponible" <?php echo $cancha['estado'] === 'disponible' ? 'selected' : ''; ?>>Disponible</option>
                                                <option value="mantenimiento" <?php echo $cancha['estado'] === 'mantenimiento' ? 'selected' : ''; ?>>Mantenimiento</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Foto Actual</label>
                                            <?php if(!empty($cancha['imagen'])): ?>
                                                <div>
                                                    <img src="<?php echo URL; ?>public/img/canchas/<?php echo $cancha['imagen']; ?>" class="current-image img-thumbnail" alt="Foto actual">
                                                    <div class="custom-control custom-checkbox mt-2">
                                                        <input type="checkbox" class="custom-control-input" id="eliminar_imagen" name="eliminar_imagen" value="1">
                                                        <label class="custom-control-label" for="eliminar_imagen">Eliminar imagen actual</label>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <p class="text-muted">Sin imagen</p>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="imagen">Nueva Foto de la Cancha</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="imagen" name="imagen" accept="image/*" onchange="previewImage(event)">
                                                <label class="custom-file-label" for="imagen">Seleccionar archivo...</label>
                                            </div>
                                            <small class="form-text text-muted">
                                                Formatos permitidos: JPG, JPEG, PNG, GIF, WEBP, BMP. Sin límite de tamaño.
                                            </small>
                                            <img id="preview" class="preview-image img-thumbnail" alt="Vista previa" style="display: none;">
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Actualizar Cancha
                                        </button>
                                        <a href="<?php echo URL; ?>index.php?c=Cancha&a=index" class="btn btn-default">
                                            <i class="fas fa-times"></i> Cancelar
                                        </a>
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
    <script src="<?php echo URL; ?>public/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    
    <script>
        $(function () {
            bsCustomFileInput.init();
        });

        function previewImage(event) {
            const preview = document.getElementById('preview');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
