<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$rol = $_SESSION['rol'] ?? 'invitado';
$nombreUsuario = $_SESSION['user_nombre'] ?? '';

include 'app/views/layout/plantilla.php';
ob_start();
?>

<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-calendar-alt text-primary"></i> Calendario de Reservas
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo URL; ?>index.php">Inicio</a></li>
                    <li class="breadcrumb-item active">Calendario</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-calendar"></i> 
                            Vista de Calendario
                        </h3>
                        <div class="card-tools">
                            <?php if($rol === 'admin' || $rol === 'encargado'): ?>
                            <a href="<?php echo URL; ?>index.php?c=Reserva&a=crear" class="btn btn-success btn-sm">
                                <i class="fas fa-plus"></i> Nueva Reserva
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Leyenda de colores -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Leyenda</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <i class="fas fa-circle text-success"></i> Confirmada
                            </div>
                            <div class="col-md-4">
                                <i class="fas fa-circle text-warning"></i> Pendiente
                            </div>
                            <div class="col-md-4">
                                <i class="fas fa-circle text-danger"></i> Cancelada
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal para ver detalles -->
<div class="modal fade" id="modalDetalleReserva" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">
                    <i class="fas fa-info-circle"></i> Detalles de la Reserva
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detalleReservaContent">
                <!-- El contenido se cargará dinámicamente -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día',
            list: 'Lista'
        },
        navLinks: true,
        editable: false,
        dayMaxEvents: true,
        events: '<?php echo URL; ?>index.php?c=Calendario&a=obtenerEventos',
        eventClick: function(info) {
            // Mostrar detalles en el modal
            var evento = info.event;
            var html = `
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Cancha:</strong> ${evento.extendedProps.cancha}</p>
                        <p><strong>Cliente:</strong> ${evento.extendedProps.cliente}</p>
                        <p><strong>Fecha:</strong> ${evento.start.toLocaleDateString('es-ES')}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Hora:</strong> ${evento.start.toLocaleTimeString('es-ES', {hour: '2-digit', minute: '2-digit'})} - ${evento.end.toLocaleTimeString('es-ES', {hour: '2-digit', minute: '2-digit'})}</p>
                        <p><strong>Estado:</strong> <span class="badge badge-${evento.extendedProps.estado === 'confirmada' ? 'success' : (evento.extendedProps.estado === 'pendiente' ? 'warning' : 'danger')}">${evento.extendedProps.estado}</span></p>
                        <p><strong>Precio:</strong> $${evento.extendedProps.precio}</p>
                    </div>
                </div>
                <hr>
                <div class="text-right">
                    <a href="<?php echo URL; ?>index.php?c=Reserva&a=detalle&id=${evento.id}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i> Ver más detalles
                    </a>
                </div>
            `;
            
            document.getElementById('detalleReservaContent').innerHTML = html;
            $('#modalDetalleReserva').modal('show');
        },
        loading: function(isLoading) {
            if (isLoading) {
                // Mostrar loader
            }
        }
    });
    
    calendar.render();
});
</script>

<?php
$contenido = ob_get_clean();
?>
