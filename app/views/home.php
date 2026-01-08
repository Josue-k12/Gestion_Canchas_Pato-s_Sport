<?php include 'includes/header.php'; ?>

<section class="hero-section">
    <div class="container text-center text-white">
        <h1 class="display-4 fw-bold">Tu Cancha, Tu Juego.</h1>
        <h2 class="display-6 mb-4">Reserva Profesional.</h2>
        
        <div class="bg-white p-3 rounded-pill shadow-lg mt-4 d-flex flex-wrap justify-content-center gap-2 mx-auto buscador-container" style="max-width: 850px;">
            <select class="form-select border-0 w-auto bg-transparent fw-bold"><option>Tipo de deporte</option></select>
            <div class="vr d-none d-lg-block"></div>
            <input type="date" class="form-control border-0 w-auto bg-transparent">
            <div class="vr d-none d-lg-block"></div>
            <select class="form-select border-0 w-auto bg-transparent fw-bold"><option>Horario</option></select>
            <button class="btn btn-patos rounded-pill px-4 fw-bold">Buscar disponibilidad</button>
        </div>
    </div>
</section>

<div class="container my-5 py-4">
    <h3 class="text-center fw-bold mb-5">Nuestros Servicios</h3>
    <div class="row g-4 justify-content-center">
        <div class="col-md-4">
            <div class="d-flex align-items-start px-3">
                <i class="bi bi-calendar-check fs-1 text-success me-3"></i>
                <div>
                    <h6 class="fw-bold mb-1">Reservas Online 24/7</h6>
                    <small class="text-muted">Reservas online inmediatas, seguras y puntuales.</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="d-flex align-items-start px-3">
                <i class="bi bi-credit-card-2-front fs-1 text-success me-3"></i>
                <div>
                    <h6 class="fw-bold mb-1">Pagos Digitales Seguros</h6>
                    <small class="text-muted">Asegure pagos digitales seguros y confiables.</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="d-flex align-items-start px-3">
                <i class="bi bi-trophy fs-1 text-success me-3"></i>
                <div>
                    <h6 class="fw-bold mb-1">Gestión de Campeonatos</h6>
                    <small class="text-muted">Vista de campeonatos, noticias recientes y torneos.</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <h3 class="text-center fw-bold mb-4">Noticias del Momento</h3>
    
    <div id="carouselNoticias" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                            <img src="assets/img/noticia1.png" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <p class="text-muted small mb-2"><i class="bi bi-calendar3"></i> 07/01/2026</p>
                                <h5 class="fw-bold h6">Mantenimiento de Césped</h5>
                                <p class="card-text small text-muted">Estamos renovando la cancha principal para el mejor nivel de juego.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                            <img src="assets/img/noticia2.png" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <p class="text-muted small mb-2"><i class="bi bi-calendar3"></i> 05/01/2026</p>
                                <h5 class="fw-bold h6">Nueva Iluminación LED</h5>
                                <p class="card-text small text-muted">Juega de noche con visibilidad perfecta gracias a nuestra tecnología.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                            <img src="assets/img/noticia3.png" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <p class="text-muted small mb-2"><i class="bi bi-calendar3"></i> 01/01/2026</p>
                                <h5 class="fw-bold h6">Torneo Relámpago</h5>
                                <p class="card-text small text-muted">Inscríbete hoy mismo en el torneo de este fin de semana.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                            <img src="assets/img/noticia1.png" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="fw-bold h6">Próximos Eventos</h5>
                                <p class="card-text small text-muted">No te pierdas las sorpresas que tenemos para febrero.</p>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselNoticias" data-bs-slide="prev" style="width: 5%; opacity: 0.8;">
            <span class="bi bi-arrow-left-circle-fill text-dark fs-1" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselNoticias" data-bs-slide="next" style="width: 5%; opacity: 0.8;">
            <span class="bi bi-arrow-right-circle-fill text-dark fs-1" aria-hidden="true"></span>
        </button>
    </div>
</div>

<div class="container my-5 pb-5">
    <h3 class="text-center fw-bold mb-4">Torneos en Curso</h3>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow rounded-4 overflow-hidden text-white">
                <div class="position-relative">
                    <img src="assets/img/cancha_fondo.png" class="card-img" style="height: 220px; object-fit: cover; filter: brightness(0.5);">
                    <div class="card-img-overlay d-flex flex-column justify-content-center text-center">
                        <h4 class="fw-bold">Torneo Apertura 2024</h4>
                        <p class="small mb-0">Fútbol 7 - Masculino</p>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <span class="badge bg-warning text-dark px-3 py-2">Próximamente</span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow rounded-4 overflow-hidden text-white">
                <div class="position-relative">
                    <img src="assets/img/torneo2.png" class="card-img" style="height: 220px; object-fit: cover; filter: brightness(0.5);">
                    <div class="card-img-overlay d-flex flex-column justify-content-center text-center">
                        <h4 class="fw-bold">Liga Empresarial</h4>
                        <p class="small mb-0">Fútbol 5 - Libre</p>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <span class="badge bg-danger px-3 py-2">Justo ahora</span>
                    <button class="btn btn-patos btn-sm rounded-pill px-4 shadow-sm">Ver Detalles</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>