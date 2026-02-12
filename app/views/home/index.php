<?php
/**
 * ARCHIVO DEPRECADO
 * 
 * Este archivo ya no se usa directamente.
 * El HomeController ahora carga archivos específicos:
 * - app/views/home/pagina_publica.php (para visitantes)
 * - app/views/home/dashboard_admin.php (para administradores)
 * - app/views/home/dashboard_cliente.php (para clientes)
 * - app/views/home/dashboard_encargado.php (para encargados)
 * 
 * Este archivo se mantiene solo como respaldo.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está logueado
$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : 'invitado';
$nombreUsuario = isset($_SESSION['user_nombre']) ? $_SESSION['user_nombre'] : '';

// Si está logueado, mostrar el dashboard según su rol
if ($rol !== 'invitado') {
    include __DIR__ . '/../layout/header.php';
    
    // DASHBOARD PARA ADMIN
    if ($rol === 'admin') {
        ?>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Dashboard Administrador</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>150</h3>
                                    <p>Reservas Totales</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <a href="<?php echo URL; ?>app/controllers/ReservaController.php" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>53</h3>
                                    <p>Usuarios Registrados</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <a href="<?php echo URL; ?>app/controllers/UsuarioController.php" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3 class="text-white">8</h3>
                                    <p class="text-white">Canchas Disponibles</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-futbol"></i>
                                </div>
                                <a href="<?php echo URL; ?>app/controllers/CanchaController.php" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>$12,450</h3>
                                    <p>Ingresos del Mes</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <a href="#" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Gráficos y Tablas -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Reservas Recientes</h3>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Cliente</th>
                                                <th>Cancha</th>
                                                <th>Fecha</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Juan Pérez</td>
                                                <td>Cancha 1</td>
                                                <td>14/01/2026</td>
                                                <td><span class="badge bg-success">Confirmada</span></td>
                                            </tr>
                                            <tr>
                                                <td>María García</td>
                                                <td>Cancha 2</td>
                                                <td>14/01/2026</td>
                                                <td><span class="badge bg-warning">Pendiente</span></td>
                                            </tr>
                                            <tr>
                                                <td>Carlos López</td>
                                                <td>Cancha 3</td>
                                                <td>15/01/2026</td>
                                                <td><span class="badge bg-success">Confirmada</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Gestión Rápida</h3>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="<?php echo URL; ?>app/views/reservas/crear.php" class="btn btn-primary btn-lg">
                                            <i class="fas fa-plus-circle"></i> Nueva Reserva
                                        </a>
                                        <a href="<?php echo URL; ?>app/views/canchas/crear.php" class="btn btn-success btn-lg">
                                            <i class="fas fa-futbol"></i> Añadir Cancha
                                        </a>
                                        <a href="<?php echo URL; ?>app/controllers/UsuarioController.php?action=crear" class="btn btn-info btn-lg">
                                            <i class="fas fa-user-plus"></i> Nuevo Usuario
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php
    }
    
    // DASHBOARD PARA CLIENTE
    elseif ($rol === 'cliente') {
        ?>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Mis Reservas</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <!-- Boxes para cliente -->
                    <div class="row">
                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>5</h3>
                                    <p>Reservas Activas</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <a href="<?php echo URL; ?>app/controllers/ReservaController.php" class="small-box-footer">Ver mis reservas <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>12</h3>
                                    <p>Reservas Completadas</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <a href="#" class="small-box-footer">Ver historial <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3 class="text-white">8</h3>
                                    <p class="text-white">Canchas Disponibles</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-futbol"></i>
                                </div>
                                <a href="<?php echo URL; ?>app/controllers/CanchaController.php" class="small-box-footer">Ver canchas <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Próximas reservas -->
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header bg-primary">
                                    <h3 class="card-title">Mis Próximas Reservas</h3>
                                </div>
                                <div class="card-body">
                                    <div class="timeline">
                                        <div class="time-label">
                                            <span class="bg-success">Hoy - 14 Ene 2026</span>
                                        </div>
                                        <div>
                                            <i class="fas fa-futbol bg-info"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fas fa-clock"></i> 18:00 - 19:00</span>
                                                <h3 class="timeline-header">Cancha 1 - Fútbol 7</h3>
                                                <div class="timeline-body">
                                                    <strong>Estado:</strong> <span class="badge bg-success">Confirmada</span><br>
                                                    <strong>Precio:</strong> $50.00
                                                </div>
                                                <div class="timeline-footer">
                                                    <a href="#" class="btn btn-danger btn-sm">Cancelar</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="time-label">
                                            <span class="bg-warning">Mañana - 15 Ene 2026</span>
                                        </div>
                                        <div>
                                            <i class="fas fa-futbol bg-success"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fas fa-clock"></i> 20:00 - 21:00</span>
                                                <h3 class="timeline-header">Cancha 3 - Fútbol 5</h3>
                                                <div class="timeline-body">
                                                    <strong>Estado:</strong> <span class="badge bg-success">Confirmada</span><br>
                                                    <strong>Precio:</strong> $40.00
                                                </div>
                                                <div class="timeline-footer">
                                                    <a href="#" class="btn btn-danger btn-sm">Cancelar</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="fas fa-clock bg-gray"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-success">
                                    <h3 class="card-title">Acciones Rápidas</h3>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="<?php echo URL; ?>app/views/reservas/crear.php" class="btn btn-primary btn-lg">
                                            <i class="fas fa-plus-circle"></i> Nueva Reserva
                                        </a>
                                        <a href="<?php echo URL; ?>app/controllers/CanchaController.php" class="btn btn-info btn-lg">
                                            <i class="fas fa-list"></i> Ver Canchas
                                        </a>
                                        <a href="<?php echo URL; ?>app/controllers/ReservaController.php" class="btn btn-secondary btn-lg">
                                            <i class="fas fa-history"></i> Mi Historial
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-header">
                                    <h3 class="card-title">Promociones</h3>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-success">
                                        <h5><i class="icon fas fa-gift"></i> Oferta Especial!</h5>
                                        20% de descuento en reservas de lunes a viernes antes de las 14:00
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php
    }
    
    // DASHBOARD PARA ENCARGADO
    elseif ($rol === 'encargado') {
        ?>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Panel del Encargado</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <!-- Boxes para encargado -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>24</h3>
                                    <p>Reservas Hoy</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                                <a href="<?php echo URL; ?>app/controllers/ReservaController.php" class="small-box-footer">Ver todas <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>8</h3>
                                    <p>Canchas Activas</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-futbol"></i>
                                </div>
                                <a href="<?php echo URL; ?>app/controllers/CanchaController.php" class="small-box-footer">Gestionar <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3 class="text-white">2</h3>
                                    <p class="text-white">En Mantenimiento</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-tools"></i>
                                </div>
                                <a href="<?php echo URL; ?>app/controllers/CanchaController.php" class="small-box-footer">Ver estado <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>5</h3>
                                    <p>Pendientes de Pago</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <a href="#" class="small-box-footer">Ver detalles <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Reservas del día -->
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h3 class="card-title">Agenda del Día - 14 de Enero</h3>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Hora</th>
                                                <th>Cancha</th>
                                                <th>Cliente</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>08:00 - 09:00</td>
                                                <td>Cancha 1</td>
                                                <td>Juan Pérez</td>
                                                <td><span class="badge bg-success">Confirmada</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>
                                                    <button class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>09:00 - 10:00</td>
                                                <td>Cancha 2</td>
                                                <td>María García</td>
                                                <td><span class="badge bg-warning">Pendiente</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>
                                                    <button class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>10:00 - 11:00</td>
                                                <td>Cancha 1</td>
                                                <td>Carlos López</td>
                                                <td><span class="badge bg-success">Confirmada</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>
                                                    <button class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>18:00 - 19:00</td>
                                                <td>Cancha 3</td>
                                                <td>Ana Martínez</td>
                                                <td><span class="badge bg-info">En curso</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>
                                                    <button class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-success">
                                    <h3 class="card-title">Gestión de Canchas</h3>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="<?php echo URL; ?>app/views/reservas/crear.php" class="btn btn-primary btn-lg">
                                            <i class="fas fa-plus-circle"></i> Nueva Reserva
                                        </a>
                                        <a href="<?php echo URL; ?>app/controllers/CanchaController.php" class="btn btn-warning btn-lg">
                                            <i class="fas fa-tools"></i> Estado de Canchas
                                        </a>
                                        <a href="<?php echo URL; ?>app/controllers/ReservaController.php" class="btn btn-info btn-lg">
                                            <i class="fas fa-list"></i> Todas las Reservas
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-header bg-warning">
                                    <h3 class="card-title">Alertas</h3>
                                </div>
                                <div class="card-body">
                                    <div class="callout callout-warning">
                                        <h5><i class="fas fa-exclamation-triangle"></i> Atención!</h5>
                                        <p>Cancha 2 requiere mantenimiento del césped esta semana.</p>
                                    </div>
                                    <div class="callout callout-info">
                                        <h5><i class="fas fa-info-circle"></i> Recordatorio</h5>
                                        <p>5 reservas pendientes de confirmación de pago.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php
    }
    
    include __DIR__ . '/../layout/footer.php';
    
} else {
    // Si NO está logueado, mostrar la página pública
    include __DIR__ . '/../layout/header.php';
?>

<section id="inicio" class="hero-section" style="
    background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('<?php echo URL; ?>public/img/cancha_fondo.jpeg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 80vh; /* Esto define el tamaño de la imagen */
    display: flex;
    align-items: center;
    margin-top: -20px; /* Ajuste para que suba un poco */
">
    <div class="container text-center text-white">
        <h1 class="display-4 fw-bold">Tu Cancha, Tu Juego.</h1>
        <h2 class="display-6 mb-4">Reserva Profesional.</h2>
        
        <div class="bg-white p-3 rounded-pill shadow-lg mt-4 d-flex flex-wrap justify-content-center gap-2 mx-auto" style="max-width: 900px;">
            <select class="form-select border-0 w-auto bg-transparent fw-bold text-dark">
                <option selected disabled>Tipo de deporte</option>
                <option>Fútbol 7</option>
                <option>Fútbol 5</option>
            </select>
            
            <div class="vr d-none d-lg-block text-dark"></div>
            
            <input type="date" class="form-control border-0 w-auto bg-transparent text-dark">
            
            <div class="vr d-none d-lg-block text-dark"></div>
            
            <select class="form-select border-0 w-auto bg-transparent fw-bold text-dark">
                <option selected disabled>Horario</option>
                <option>Mañana</option>
                <option>Tarde</option>
                <option>Noche</option>
            </select>
            
            <button class="btn btn-success rounded-pill px-4 fw-bold">Buscar disponibilidad</button>
        </div>
    </div>
</section>

<div id="servicios" class="container my-5 py-5">
    <h3 class="text-center fw-bold mb-5 text-uppercase" style="letter-spacing: 2px;">Nuestros Servicios</h3>
    <div class="row g-4 justify-content-center">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-4 text-center hover-card">
                <i class="bi bi-calendar-check fs-1 text-success mb-3"></i>
                <h5 class="fw-bold">Reservas Online 24/7</h5>
                <p class="text-muted small">Gestiona tus partidos en cualquier momento con confirmación inmediata.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-4 text-center hover-card">
                <i class="bi bi-clock-history fs-1 text-success mb-3"></i>
                <h5 class="fw-bold">Gestión en Tiempo Real</h5>
                <p class="text-muted small">Consulta disponibilidad instantánea y gestiona tus reservas al momento.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-4 text-center hover-card">
                <i class="bi bi-trophy fs-1 text-success mb-3"></i>
                <h5 class="fw-bold">Torneos y Ligas</h5>
                <p class="text-muted small">Sigue tus estadísticas, resultados y tablas de posiciones en tiempo real.</p>
            </div>
        </div>
    </div>
</div>

<div id="noticias" class="bg-light py-5">
    <div class="container">
        <h3 class="text-center fw-bold mb-4">Noticias del Momento</h3>
        <div id="carouselNoticias" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                                <img src="<?php echo URL; ?>public/img/noticia1.jpeg" class="card-img-top" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <p class="text-muted small mb-2"><i class="bi bi-calendar3"></i> 07/01/2026</p>
                                    <h5 class="fw-bold h6">Mantenimiento de Césped</h5>
                                    <p class="card-text small text-muted">Estamos renovando la cancha principal para el mejor nivel de juego.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                                <img src="<?php echo URL; ?>public/img/noticia2.jpeg" class="card-img-top" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <p class="text-muted small mb-2"><i class="bi bi-calendar3"></i> 05/01/2026</p>
                                    <h5 class="fw-bold h6">Nueva Iluminación LED</h5>
                                    <p class="card-text small text-muted">Juega de noche con visibilidad perfecta gracias a la nueva tecnología.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                                <img src="<?php echo URL; ?>public/img/noticia3.jpeg" class="card-img-top" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <p class="text-muted small mb-2"><i class="bi bi-calendar3"></i> 01/01/2026</p>
                                    <h5 class="fw-bold h6">Torneo Relámpago</h5>
                                    <p class="card-text small text-muted">¡Inscríbete hoy mismo! Cupos limitados para este fin de semana.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselNoticias" data-bs-slide="prev" style="width: 5%;">
                <span class="bi bi-arrow-left-circle-fill text-dark fs-1" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselNoticias" data-bs-slide="next" style="width: 5%;">
                <span class="bi bi-arrow-right-circle-fill text-dark fs-1" aria-hidden="true"></span>
            </button>
        </div>
    </div>
</div>

<div id="torneos" class="container my-5 pb-5">
    <h3 class="text-center fw-bold mb-4">Torneos en Curso</h3>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow rounded-4 overflow-hidden text-white card-torneo">
                <div class="position-relative">
                    <img src="<?php echo URL; ?>/public/img/torneo1.jpeg" class="card-img" style="height: 250px; object-fit: cover; filter: brightness(0.4);">
                    <div class="card-img-overlay d-flex flex-column justify-content-center text-center">
                        <h4 class="fw-bold">Torneo Apertura 2026</h4>
                        <p class="mb-0">Fútbol 7 - Masculino</p>
                        <div class="mt-3">
                             <span class="badge bg-warning text-dark px-3 py-2">PRÓXIMAMENTE</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow rounded-4 overflow-hidden text-white card-torneo">
                <div class="position-relative">
                    <img src="<?php echo URL; ?>public/img/torneo2.jpeg" class="card-img" style="height: 250px; object-fit: cover; filter: brightness(0.4);">
                    <div class="card-img-overlay d-flex flex-column justify-content-center text-center">
                        <h4 class="fw-bold">Liga Empresarial</h4>
                        <p class="mb-0">Fútbol 5 - Libre</p>
                        <div class="mt-3">
                             <span class="badge bg-danger px-3 py-2">EN VIVO</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-card {
        transition: transform 0.3s ease, shadow 0.3s ease;
    }
    .hover-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .card-torneo {
        transition: 0.3s;
    }
    .card-torneo:hover {
        transform: scale(1.02);
    }
</style>
<section id="contacto" class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-5">
                <h3 class="fw-bold mb-4">Contáctanos</h3>
                <div class="card border-0 shadow-sm p-4 rounded-4">
                    <p class="mb-2"><strong><i class="bi bi-person-fill text-success"></i> Propietario:</strong> Milton Montaluisa</p>
                    
                    <p class="mb-3">
                        <strong><i class="bi bi-whatsapp text-success"></i> WhatsApp:</strong><br>
                        <a href="https://wa.me/593984577224?text=Hola,%20me%20gustaría%20reservar%20la%20cancha" target="_blank" class="btn btn-success btn-sm mt-1">
                            <i class="bi bi-whatsapp"></i> Enviar Mensaje
                        </a>
                    </p>

                    <p class="mb-2"><strong><i class="bi bi-telephone-fill text-success"></i> Teléfono:</strong> <a href="tel:+593984577224" class="text-decoration-none text-dark">+593 98 457 7224</a></p>
                    <p class="mb-2"><strong><i class="bi bi-geo-alt-fill text-success"></i> Dirección:</strong> San Jose, Latacunga</p>
                    <p class="mb-0"><strong><i class="bi bi-clock-fill text-success"></i> Horario:</strong> 08:00 AM - 11:00 PM</p>
                    
                    <a href="https://www.google.com/maps/search/?api=1&query=Cancha+sintetica+Pato+sport+Latacunga&query_place_id=ChIJG0Dr1Tph1JERQWvHAGyIzg0" target="_blank" class="btn btn-primary w-100 rounded-pill mt-3">
                        <i class="bi bi-geo-alt"></i> Cómo llegar (Google Maps)
                    </a>
                </div>
            </div>

            <div class="col-md-7">
                <div class="rounded-4 overflow-hidden shadow-sm" style="height: 350px;">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.23123456789!2d-78.5963148!3d-0.9045925!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91d4613ad5eb401b%3A0x0dad886c00076b41!2sCancha%20sint%C3%A9tica%20%22Pato's%20sport%22!5e0!3m2!1ses!2sec!4v1715800000000!5m2!1ses!2sec" 
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
    } // Cierre del else original
    include __DIR__ . '/../layout/footer.php'; 
?>