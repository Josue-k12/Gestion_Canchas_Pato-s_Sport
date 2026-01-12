<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluimos el header que ya tiene los estilos y la navegación
include 'app/views/layout/header.php'; 
?>

<section id="inicio" class="hero-section">
    <div class="container text-center text-white">
        <h1 class="display-4 fw-bold">Tu Cancha, Tu Juego.</h1>
        <h2 class="display-6 mb-4">Reserva Profesional.</h2>
        
        <div class="bg-white p-3 rounded-pill shadow-lg mt-4 d-flex flex-wrap justify-content-center gap-2 mx-auto buscador-container">
            <select class="form-select border-0 w-auto bg-transparent fw-bold">
                <option>Tipo de deporte</option>
                <option>Fútbol 7</option>
                <option>Fútbol 5</option>
            </select>
            <div class="vr d-none d-lg-block"></div>
            <input type="date" class="form-control border-0 w-auto bg-transparent">
            <div class="vr d-none d-lg-block"></div>
            <select class="form-select border-0 w-auto bg-transparent fw-bold">
                <option>Horario</option>
                <option>Mañana</option>
                <option>Tarde</option>
                <option>Noche</option>
            </select>
            <button class="btn btn-patos rounded-pill px-4 fw-bold">Buscar disponibilidad</button>
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
                <i class="bi bi-credit-card-2-front fs-1 text-success mb-3"></i>
                <h5 class="fw-bold">Pagos Digitales</h5>
                <p class="text-muted small">Múltiples métodos de pago integrados para tu seguridad y comodidad.</p>
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
                                <img src="<?php echo URL; ?>public/img/noticia1.png" class="card-img-top" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <p class="text-muted small mb-2"><i class="bi bi-calendar3"></i> 07/01/2026</p>
                                    <h5 class="fw-bold h6">Mantenimiento de Césped</h5>
                                    <p class="card-text small text-muted">Estamos renovando la cancha principal para el mejor nivel de juego.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                                <img src="<?php echo URL; ?>public/img/noticia2.png" class="card-img-top" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <p class="text-muted small mb-2"><i class="bi bi-calendar3"></i> 05/01/2026</p>
                                    <h5 class="fw-bold h6">Nueva Iluminación LED</h5>
                                    <p class="card-text small text-muted">Juega de noche con visibilidad perfecta gracias a la nueva tecnología.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                                <img src="<?php echo URL; ?>public/img/noticia3.png" class="card-img-top" style="height: 200px; object-fit: cover;">
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
                    <img src="<?php echo URL; ?>public/img/cancha_fondo.png" class="card-img" style="height: 250px; object-fit: cover; filter: brightness(0.4);">
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
                    <img src="<?php echo URL; ?>public/img/torneo2.png" class="card-img" style="height: 250px; object-fit: cover; filter: brightness(0.4);">
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

<?php 
// El footer ya contiene el cierre de body y html
include 'app/views/layout/footer.php'; 
?>