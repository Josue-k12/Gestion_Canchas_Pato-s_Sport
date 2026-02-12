<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Alquileres - Pato's Sport</title>
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
        .badge-registrado { background-color: #6c757d; }
        .badge-aprobado { background-color: #28a745; }
        .badge-finalizado { background-color: #17a2b8; }
        .badge-anulado { background-color: #dc3545; }
        
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
            /* Filtros responsive */
            .filtros-container {
                display: flex;
                flex-direction: column;
                gap: 15px;
            }
            .filtros-container .form-group {
                margin: 0 !important;
                width: 100%;
            }
            .filtros-container .form-group label {
                display: block;
                margin-bottom: 5px;
            }
            .filtros-container .form-control {
                width: 100%;
            }
            .filtros-container .btn-group-filtros {
                display: flex;
                gap: 10px;
                margin-top: 5px;
            }
            .filtros-container .btn-group-filtros .btn {
                flex: 1;
            }
            
            .small-box h3 {
                font-size: 1.3rem;
            }
            
            /* Contenedor con scroll horizontal para tabla */
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
                background: #dc3545;
                border-radius: 4px;
            }
            
            #tablaReporte {
                min-width: 700px;
                font-size: 0.85rem;
            }
            #tablaReporte th,
            #tablaReporte td {
                padding: 8px 10px;
                white-space: nowrap;
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
            .dataTables_filter input {
                width: 100% !important;
            }
        }
        
        /* Estilos para impresión */
        @media print {
            .main-header, .main-sidebar, .content-header, .card-light, .small-box, .btn, .card-tools, footer, 
            .dataTables_wrapper > .row:first-child, .dataTables_wrapper > .row:last-child {
                display: none !important;
            }
            .content-wrapper {
                margin-left: 0 !important;
                padding: 0 !important;
            }
            .card {
                border: none !important;
                box-shadow: none !important;
            }
            .card-header {
                display: block !important;
                background: none !important;
                border: none !important;
                text-align: center;
                padding: 20px 0;
            }
            .card-header h3 {
                font-size: 18px !important;
                margin: 0;
            }
            .table {
                font-size: 11px !important;
                width: 100% !important;
            }
            .table th, .table td {
                padding: 5px 8px !important;
            }
            .table-scroll-container {
                overflow: visible !important;
            }
            body {
                background: white !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .badge {
                border: 1px solid #333 !important;
            }
            .print-header {
                display: block !important;
                text-align: center;
                margin-bottom: 20px;
            }
        }
        
        .print-header {
            display: none;
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
                            <h1><i class="fas fa-chart-bar text-danger"></i> Reporte de Alquileres</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo URL; ?>index.php">Inicio</a></li>
                                <li class="breadcrumb-item active">Reportes</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Filtros -->
                    <div class="card card-light">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-filter"></i> Filtros</h3>
                        </div>
                        <div class="card-body">
                            <form method="GET" class="filtros-container">
                                <input type="hidden" name="c" value="Reporte">
                                <input type="hidden" name="a" value="alquileres">
                                
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="estado">Estado:</label>
                                            <select class="form-control" id="estado" name="estado">
                                                <option value="">-- Todos --</option>
                                                <?php foreach ($estados as $estado): ?>
                                                    <option value="<?php echo $estado['estado_id']; ?>" <?php echo $filtroEstado == $estado['estado_id'] ? 'selected' : ''; ?>>
                                                        <?php echo $estado['estado_nombre']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <label for="fecha">Fecha:</label>
                                            <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $filtroFecha; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="d-none d-md-block">&nbsp;</label>
                                            <div class="btn-group-filtros d-flex">
                                                <button type="submit" class="btn btn-primary mr-2">
                                                    <i class="fas fa-search"></i> Filtrar
                                                </button>
                                                <a href="<?php echo URL; ?>index.php?c=Reporte&a=alquileres" class="btn btn-secondary">
                                                    <i class="fas fa-redo"></i> Limpiar
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Totales -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?php echo $totales['total']; ?></h3>
                                    <p>Alquileres Registrados</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>$<?php echo number_format($totales['ingresos'], 2); ?></h3>
                                    <p>Ingresos Total</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?php echo $totales['total'] > 0 ? number_format($totales['ingresos'] / $totales['total'], 2) : '0.00'; ?></h3>
                                    <p>Promedio por Alquiler</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-chart-pie"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabla de Alquileres -->
                    <div class="card">
                        <div class="print-header">
                            <h2>Pato's Sport - Reporte de Alquileres</h2>
                            <p>Fecha de generación: <?php echo date('d/m/Y H:i'); ?></p>
                            <?php if ($filtroEstado || $filtroFecha): ?>
                            <p>Filtros aplicados: 
                                <?php if ($filtroFecha): ?>Fecha: <?php echo date('d/m/Y', strtotime($filtroFecha)); ?><?php endif; ?>
                                <?php if ($filtroEstado): ?> | Estado: <?php 
                                    foreach ($estados as $e) {
                                        if ($e['estado_id'] == $filtroEstado) echo $e['estado_nombre'];
                                    }
                                ?><?php endif; ?>
                            </p>
                            <?php endif; ?>
                        </div>
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-list"></i> Detalle de Alquileres</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-warning btn-sm" onclick="window.print()">
                                    <i class="fas fa-print"></i> Imprimir
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="generarPDF()">
                                    <i class="fas fa-file-pdf"></i> Generar PDF
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-scroll-container">
                                <table id="tablaReporte" class="table table-bordered table-striped">
                                    <thead class="bg-danger text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Usuario</th>
                                            <th>Cancha</th>
                                            <th>Fecha</th>
                                            <th>Hora Inicio</th>
                                            <th>Hora Fin</th>
                                            <th>Valor</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($alquileres)): ?>
                                            <?php $contador = 1; ?>
                                            <?php foreach ($alquileres as $alquiler): ?>
                                                <tr>
                                                    <td><?php echo $contador++; ?></td>
                                                    <td><?php echo $alquiler['usuario_nombre'] ?? '-'; ?></td>
                                                    <td><?php echo $alquiler['cancha_nombre'] ?? '-'; ?></td>
                                                    <td><?php echo date('d/m/Y', strtotime($alquiler['alquiler_fecha'])); ?></td>
                                                    <td><?php echo substr($alquiler['alquiler_hora_inicial'], 0, 5); ?></td>
                                                    <td><?php echo substr($alquiler['alquiler_hora_final'], 0, 5); ?></td>
                                                    <td>$<?php echo number_format($alquiler['alquiler_valor'], 2); ?></td>
                                                    <td>
                                                        <span class="badge badge-<?php 
                                                            $estado = strtolower($alquiler['estado_nombre'] ?? '');
                                                            echo str_replace(' ', '-', $estado);
                                                        ?>">
                                                            <?php echo $alquiler['estado_nombre'] ?? '-'; ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr><td colspan="8" class="text-center text-muted">No hay alquileres registrados</td></tr>
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
            $('#tablaReporte').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                },
                pageLength: 15,
                responsive: true
            });
        });
    </script>

    <!-- Bibliotecas para generar PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
    <script>
        function generarPDF() {
            // Acceder correctamente al objeto jsPDF desde la versión UMD
            const { jsPDF } = window.jspdf;
            
            // Crear documento en orientación horizontal para mejor visualización
            const doc = new jsPDF('landscape');
            
            // Título del reporte
            doc.setFontSize(18);
            doc.setTextColor(220, 53, 69); // Color rojo
            doc.text("Pato's Sport - Reporte de Alquileres", 14, 20);
            
            // Fecha de generación
            doc.setFontSize(10);
            doc.setTextColor(100);
            const fechaActual = new Date().toLocaleDateString('es-ES', {
                day: '2-digit',
                month: '2-digit', 
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
            doc.text("Fecha de generación: " + fechaActual, 14, 28);
            
            // Obtener datos de la tabla
            const tabla = document.getElementById('tablaReporte');
            
            // Generar la tabla en el PDF
            doc.autoTable({
                html: tabla,
                startY: 35,
                styles: {
                    fontSize: 9,
                    cellPadding: 3
                },
                headStyles: {
                    fillColor: [220, 53, 69], // Color rojo para el encabezado
                    textColor: 255,
                    fontStyle: 'bold'
                },
                alternateRowStyles: {
                    fillColor: [245, 245, 245]
                },
                margin: { top: 35 }
            });
            
            // Descargar el PDF
            doc.save('reporte_alquileres_' + new Date().toISOString().slice(0,10) + '.pdf');
        }
    </script>
</body>
</html>
