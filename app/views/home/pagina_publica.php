<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../layout/header.php';
?>

<section id="inicio" class="hero-section" style="
    background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('<?php echo URL; ?>public/img/cancha_fondo.jpeg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 80vh;
    display: flex;
    align-items: center;
    margin-top: -20px;
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
                    <img src="<?php echo URL; ?>public/img/torneo1.jpeg" class="card-img" style="height: 250px; object-fit: cover; filter: brightness(0.4);">
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

<?php include __DIR__ . '/../layout/footer.php'; ?>
