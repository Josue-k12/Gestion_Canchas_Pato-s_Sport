<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Alquiler</title>
    <link rel="icon" type="image/png" href="<?php echo URL; ?>public/img/logo_patos.png">
    <link rel="stylesheet" href="<?php echo URL; ?>public/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <style>
        :root {
            --verde-patos: #0fb29a;
            --oscuro-patos: #121821;
        }

        body {
            background-color: #f4f6f9;
        }

        .navbar {
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
        
        @media (max-width: 576px) {
            .card-header h3 {
                font-size: 1rem;
            }
            .form-group label {
                font-size: 0.9rem;
            }
            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }
            .card-footer {
                display: flex;
                flex-direction: column;
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
                        <a href="<?php echo URL; ?>index.php?c=Auth&a=logout" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
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
                            <h1><i class="fas fa-edit"></i> Editar Alquiler</h1>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Formulario de Edición</h3>
                                </div>

                                <form action="<?php echo URL; ?>index.php?c=Alquiler&a=editar&id=<?php echo $alquiler['alquiler_id']; ?>" method="POST" enctype="multipart/form-data" id="formAlquiler">
                                    <div class="card-body">
                                        
                                        <!-- Cancha -->
                                        <div class="form-group">
                                            <label for="cancha_id">Selecciona una Cancha</label>
                                            <select name="cancha_id" id="cancha_id" class="form-control" required>
                                                <option value="">-- Selecciona una cancha --</option>
                                                <?php foreach ($canchas as $cancha): ?>
                                                    <option value="<?php echo $cancha['id']; ?>" <?php echo ($alquiler['cancha_id'] == $cancha['id']) ? 'selected' : ''; ?>>
                                                        <?php echo $cancha['nombre']; ?> (<?php echo $cancha['tipo']; ?>) - $<?php echo number_format($cancha['precio_hora'], 0, ',', '.'); ?>/hora
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- Fecha -->
                                        <div class="form-group">
                                            <label for="alquiler_fecha">Fecha de Alquiler</label>
                                            <input type="date" name="alquiler_fecha" id="alquiler_fecha" class="form-control" required value="<?php echo $alquiler['alquiler_fecha']; ?>">
                                        </div>

                                        <!-- Hora Inicial -->
                                        <div class="form-group">
                                            <label for="alquiler_hora_inicial">Hora Inicial</label>
                                            <select name="alquiler_hora_inicial" id="alquiler_hora_inicial" class="form-control" required>
                                                <option value="">-- Selecciona hora inicial --</option>
                                                <?php foreach ($horas as $hora): ?>
                                                    <option value="<?php echo $hora['hora']; ?>" <?php echo ($alquiler['alquiler_hora_inicial'] == $hora['hora']) ? 'selected' : ''; ?>>
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
                                                    <option value="<?php echo $hora['hora']; ?>" <?php echo ($alquiler['alquiler_hora_final'] == $hora['hora']) ? 'selected' : ''; ?>>
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
                                                <input type="text" id="valor_total" name="alquiler_valor" class="form-control" value="<?php echo number_format($alquiler['alquiler_valor'], 0, ',', '.'); ?>" readonly>
                                            </div>
                                        </div>

                                        <!-- Estado (solo si es admin) -->
                                        <?php if ($_SESSION['rol'] == 1): ?>
                                        <div class="form-group">
                                            <label for="estado_id">Estado</label>
                                            <select name="estado_id" id="estado_id" class="form-control" required>
                                                <option value="">-- Selecciona un estado --</option>
                                                <?php foreach ($estados as $estado): ?>
                                                    <option value="<?php echo $estado['estado_id']; ?>" <?php echo ($alquiler['estado_id'] == $estado['estado_id']) ? 'selected' : ''; ?>>
                                                        <?php echo $estado['estado_nombre']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <?php else: ?>
                                        <input type="hidden" name="estado_id" value="<?php echo $alquiler['estado_id']; ?>">
                                        <div class="form-group">
                                            <label>Estado</label>
                                            <div class="form-control-plaintext">
                                                <span class="badge badge-info"><?php echo $alquiler['estado_nombre']; ?></span>
                                            </div>
                                        </div>
                                        <?php endif; ?>

                                        <!-- Método de Pago (solo admin) -->
                                        <?php if ($_SESSION['rol'] == 1): ?>
                                        <div class="form-group">
                                            <label for="metodo_pago">Método de Pago</label>
                                            <select name="metodo_pago" id="metodo_pago" class="form-control" required>
                                                <?php $metodoPago = !empty($alquiler['metodo_pago']) ? $alquiler['metodo_pago'] : 'transferencia'; ?>
                                                <option value="transferencia" <?php echo ($metodoPago === 'transferencia') ? 'selected' : ''; ?>>Transferencia</option>
                                                <option value="efectivo" <?php echo ($metodoPago === 'efectivo') ? 'selected' : ''; ?>>Efectivo</option>
                                            </select>
                                        </div>

                                        <div class="form-group" id="grupoMontoEfectivo" style="display: none;">
                                            <label for="monto_efectivo">Monto en Efectivo</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="number" step="0.01" min="0" name="monto_efectivo" id="monto_efectivo" class="form-control" value="<?php echo !empty($alquiler['monto_efectivo']) ? $alquiler['monto_efectivo'] : ''; ?>">
                                            </div>
                                            <small class="form-text text-muted">Obligatorio si el método es efectivo.</small>
                                        </div>
                                        <?php endif; ?>

                                        <!-- Comprobante de Pago -->
                                        <div class="form-group">
                                            <label for="alquiler_comprobante_pago">Comprobante de Pago / Evidencia</label>
                                            
                                            <?php $metodoPagoVista = !empty($alquiler['metodo_pago']) ? $alquiler['metodo_pago'] : 'transferencia'; ?>
                                            <?php if ($metodoPagoVista !== 'efectivo'): ?>
                                                <?php if (!empty($alquiler['alquiler_comprobante_pago']) && file_exists($alquiler['alquiler_comprobante_pago'])): ?>
                                                    <div class="mb-3 p-3 bg-light rounded" id="archivoActualBlock">
                                                        <p class="mb-2"><strong>Archivo actual:</strong></p>
                                                        <a href="<?php echo URL . $alquiler['alquiler_comprobante_pago']; ?>" target="_blank" class="btn btn-sm btn-info">
                                                            <i class="fas fa-download"></i> Descargar Comprobante
                                                        </a>
                                                    </div>
                                                <?php else: ?>
                                                    <p class="text-muted" id="archivoActualBlock">Sin comprobante adjunto</p>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            
                                            <div class="custom-file">
                                                <input type="file" name="alquiler_comprobante_pago" id="alquiler_comprobante_pago" class="custom-file-input" accept=".jpg,.jpeg,.png,.pdf">
                                                <label class="custom-file-label" for="alquiler_comprobante_pago">Selecciona un archivo (JPG, PNG o PDF)</label>
                                            </div>
                                            <small class="form-text text-muted">Deja en blanco si no deseas cambiar el comprobante. Máximo 5MB. Formatos: JPG, PNG, PDF</small>
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Guardar Cambios
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
                                    <h3 class="card-title">Resumen del Alquiler</h3>
                                </div>
                                <div class="card-body">
                                    <p>
                                        <strong>Cancha:</strong> 
                                        <span id="resumen_cancha">-</span>
                                    </p>
                                    <p>
                                        <strong>Fecha:</strong> 
                                        <span id="resumen_fecha">-</span>
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
                                        $<?php echo isset($precioHora) ? number_format($precioHora, 0, ',', '.') : number_format($alquiler['precio_hora'], 0, ',', '.'); ?>
                                    </p>
                                    <hr>
                                    <h5 class="text-success">
                                        <strong>Total a Pagar: $<span id="resumen_total"><?php echo number_format($alquiler['alquiler_valor'], 0, ',', '.'); ?></span></strong>
                                    </h5>
                                </div>
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
    <script src="<?php echo URL; ?>public/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="<?php echo URL; ?>public/adminlte/dist/js/adminlte.min.js"></script>

    <script>
        const precioHora = <?php echo isset($precioHora) ? $precioHora : ($alquiler['precio_hora'] ?? 20); ?>;
        const canchasSelect = document.getElementById('cancha_id');
        const fechaInput = document.getElementById('alquiler_fecha');
        const horaInicialInput = document.getElementById('alquiler_hora_inicial');
        const horaFinalInput = document.getElementById('alquiler_hora_final');
        const valorTotalInput = document.getElementById('valor_total');
        const metodoPagoSelect = document.getElementById('metodo_pago');
        const grupoMontoEfectivo = document.getElementById('grupoMontoEfectivo');
        const montoEfectivoInput = document.getElementById('monto_efectivo');
        const archivoActualBlock = document.getElementById('archivoActualBlock');

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

        // Mostrar/ocultar monto efectivo y comprobante según método de pago (solo admin)
        function toggleMontoEfectivo() {
            if (!metodoPagoSelect || !grupoMontoEfectivo || !montoEfectivoInput) {
                return;
            }

            const comprobanteGroup = document.getElementById('alquiler_comprobante_pago').closest('.form-group');

            if (metodoPagoSelect.value === 'efectivo') {
                grupoMontoEfectivo.style.display = 'block';
                montoEfectivoInput.setAttribute('required', 'required');
                if (archivoActualBlock) {
                    archivoActualBlock.style.display = 'none';
                }
                // Ocultar campo de comprobante
                if (comprobanteGroup) {
                    comprobanteGroup.style.display = 'none';
                }
            } else {
                grupoMontoEfectivo.style.display = 'none';
                montoEfectivoInput.removeAttribute('required');
                montoEfectivoInput.value = '';
                if (archivoActualBlock) {
                    archivoActualBlock.style.display = '';
                }
                // Mostrar campo de comprobante
                if (comprobanteGroup) {
                    comprobanteGroup.style.display = 'block';
                }
            }
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

        if (metodoPagoSelect) {
            metodoPagoSelect.addEventListener('change', toggleMontoEfectivo);
            toggleMontoEfectivo();
        }

        // Inicializar con valores actuales
        document.addEventListener('DOMContentLoaded', function() {
            canchasSelect.dispatchEvent(new Event('change'));
            fechaInput.dispatchEvent(new Event('change'));
            calcularValor();
            bsCustomFileInput.init();
        });
    </script>

</body>
</html>
