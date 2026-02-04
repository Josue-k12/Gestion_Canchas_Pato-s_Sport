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
    <title>Crear Alquiler - Pato's Sport</title>
    
    <link rel="icon" type="image/png" href="<?php echo URL; ?>public/img/logo_patos.png">
    <link rel="stylesheet" href="<?php echo URL; ?>public/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    
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
        
        .form-control:focus {
            border-color: var(--verde-patos);
            box-shadow: 0 0 0 0.2rem rgba(15, 178, 154, 0.25);
        }
        
        .custom-file-label::after {
            content: "Examinar";
            background-color: var(--verde-patos);
            color: white;
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
                                <i class="fas fa-plus text-success"></i> Nueva Reserva
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo URL; ?>index.php">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo URL; ?>index.php?c=Alquiler&a=misAlquileres">Mis Alquileres</a></li>
                                <li class="breadcrumb-item active">Nueva Reserva</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
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
                        <div class="col-md-8">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Formulario de Alquiler</h3>
                                </div>

                                <form action="<?php echo URL; ?>index.php?c=Alquiler&a=crear" method="POST" enctype="multipart/form-data" id="formAlquiler">
                                    <div class="card-body">
                                        
                                        <!-- Cancha -->
                                        <div class="form-group">
                                            <label for="cancha_id">Selecciona una Cancha</label>
                                            <select name="cancha_id" id="cancha_id" class="form-control" required>
                                                <option value="">-- Selecciona una cancha --</option>
                                                <?php foreach ($canchas as $cancha): ?>
                                                    <option value="<?php echo $cancha['id']; ?>">
                                                        <?php echo $cancha['nombre']; ?> (<?php echo $cancha['tipo']; ?>) - $<?php echo number_format($cancha['precio_hora'], 0, ',', '.'); ?>/hora
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- Fecha -->
                                        <div class="form-group">
                                            <label for="alquiler_fecha">Fecha de Alquiler</label>
                                            <input type="date" name="alquiler_fecha" id="alquiler_fecha" class="form-control" required min="<?php echo date('Y-m-d'); ?>">
                                        </div>

                                        <!-- Hora Inicial -->
                                        <div class="form-group">
                                            <label for="alquiler_hora_inicial">Hora Inicial</label>
                                            <select name="alquiler_hora_inicial" id="alquiler_hora_inicial" class="form-control" required>
                                                <option value="">-- Selecciona hora inicial --</option>
                                                <?php foreach ($horas as $hora): ?>
                                                    <option value="<?php echo $hora['hora']; ?>">
                                                        <?php echo $hora['hora']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- Hora Final -->
                                        <div class="form-group">
                                            <label for="alquiler_hora_final">Hora Final</label>
                                            <select name="alquiler_hora_final" id="alquiler_hora_final" class="form-control" required>
                                                <option value="">-- Selecciona hora final --</option>
                                                <?php foreach ($horas as $hora): ?>
                                                    <option value="<?php echo $hora['hora']; ?>">
                                                        <?php echo $hora['hora']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- Valor Total -->
                                        <div class="form-group">
                                            <label for="valor_total">Valor Total a Pagar</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="text" id="valor_total" class="form-control" readonly>
                                            </div>
                                            <small class="form-text text-muted">Precio por hora: $<?php echo number_format($precioHora, 0, ',', '.'); ?></small>
                                        </div>

                                        <!-- Comprobante de Pago -->
                                        <div class="form-group">
                                            <label for="alquiler_comprobante_pago">Comprobante de Pago <span class="text-danger">*</span></label>
                                            <div class="custom-file">
                                                <input type="file" name="alquiler_comprobante_pago" id="alquiler_comprobante_pago" class="custom-file-input" accept=".jpg,.jpeg,.png,.pdf" required>
                                                <label class="custom-file-label" for="alquiler_comprobante_pago">Selecciona un archivo (JPG, PNG o PDF)</label>
                                            </div>
                                            <small class="form-text text-muted">Máximo 5MB. Formatos: JPG, PNG, PDF</small>
                                        </div>

                                        <!-- Información de comprobante -->
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle"></i> <strong>Instrucciones:</strong>
                                            <ul class="mb-0 mt-2">
                                                <li>Realiza el pago al valor total mostrado arriba</li>
                                                <li><strong>Número de cuenta:</strong> 2009232010</li>
                                                <li>Adjunta la foto o PDF del comprobante de pago (obligatorio)</li>
                                                <li>Tu reserva quedará en estado "Pendiente de Validación"</li>
                                                <li>El administrador validará tu pago en un máximo de 24 horas</li>
                                            </ul>
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Crear Reserva
                                        </button>
                                        <a href="<?php echo URL; ?>index.php?c=Alquiler&a=misAlquileres" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left"></i> Cancelar
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Resumen -->
                        <div class="col-md-4">
                            <div class="card card-outline card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Resumen de tu Alquiler</h3>
                                </div>
                                <div class="card-body">
                                    <p>
                                        <strong>Cancha:</strong> 
                                        <span id="resumen_cancha">Sin seleccionar</span>
                                    </p>
                                    <p>
                                        <strong>Fecha:</strong> 
                                        <span id="resumen_fecha">Sin seleccionar</span>
                                    </p>
                                    <p>
                                        <strong>Hora Inicial:</strong> 
                                        <span id="resumen_hora_inicial">--:--</span>
                                    </p>
                                    <p>
                                        <strong>Hora Final:</strong> 
                                        <span id="resumen_hora_final">--:--</span>
                                    </p>
                                    <hr>
                                    <p>
                                        <strong>Horas:</strong> 
                                        <span id="resumen_horas">0</span> hora(s)
                                    </p>
                                    <p>
                                        <strong>Precio/Hora:</strong> 
                                        $<?php echo number_format($precioHora, 0, ',', '.'); ?>
                                    </p>
                                    <hr>
                                    <h5 class="text-success">
                                        <strong>Total a Pagar: $<span id="resumen_total">0</span></strong>
                                    </h5>
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

    <script src="<?php echo URL; ?>public/adminlte/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo URL; ?>public/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo URL; ?>public/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="<?php echo URL; ?>public/adminlte/dist/js/adminlte.min.js"></script>

    <script>
        // Inicializar dropdowns de Bootstrap
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownElements = document.querySelectorAll('[data-toggle="dropdown"]');
            dropdownElements.forEach(function(element) {
                new bootstrap.Dropdown(element);
            });
        });

        const precioHora = <?php echo $precioHora; ?>;
        const canchasSelect = document.getElementById('cancha_id');
        const fechaInput = document.getElementById('alquiler_fecha');
        const horaInicialInput = document.getElementById('alquiler_hora_inicial');
        const horaFinalInput = document.getElementById('alquiler_hora_final');
        const valorTotalInput = document.getElementById('valor_total');

        const resumenCancha = document.getElementById('resumen_cancha');
        const resumenFecha = document.getElementById('resumen_fecha');
        const resumenHoraInicial = document.getElementById('resumen_hora_inicial');
        const resumenHoraFinal = document.getElementById('resumen_hora_final');
        const resumenHoras = document.getElementById('resumen_horas');
        const resumenTotal = document.getElementById('resumen_total');

        function calcularValor() {
            const horaInicial = horaInicialInput.value;
            const horaFinal = horaFinalInput.value;

            if (horaInicial && horaFinal) {
                const inicio = new Date(`2000-01-01 ${horaInicial}`);
                const final = new Date(`2000-01-01 ${horaFinal}`);
                const horas = (final - inicio) / (1000 * 60 * 60);

                if (horas > 0) {
                    const total = precioHora * horas;
                    valorTotalInput.value = new Intl.NumberFormat('es-CO', { 
                        minimumFractionDigits: 0 
                    }).format(total);
                    resumenHoras.textContent = horas;
                    resumenTotal.textContent = new Intl.NumberFormat('es-CO', { 
                        minimumFractionDigits: 0 
                    }).format(total);
                } else {
                    valorTotalInput.value = '0';
                    resumenTotal.textContent = '0';
                }
            }
            
            resumenHoraInicial.textContent = horaInicial || '--:--';
            resumenHoraFinal.textContent = horaFinal || '--:--';
        }

        canchasSelect.addEventListener('change', function() {
            const option = this.options[this.selectedIndex];
            resumenCancha.textContent = option.text || 'Sin seleccionar';
        });

        fechaInput.addEventListener('change', function() {
            const fecha = new Date(this.value);
            const opciones = { year: 'numeric', month: 'long', day: 'numeric' };
            resumenFecha.textContent = fecha.toLocaleDateString('es-ES', opciones);
        });

        horaInicialInput.addEventListener('change', calcularValor);
        horaFinalInput.addEventListener('change', calcularValor);

        // Inicializar custom file input
        bsCustomFileInput.init();
    </script>

</body>
</html>
