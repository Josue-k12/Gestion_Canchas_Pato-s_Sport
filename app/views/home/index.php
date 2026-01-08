<?php 
// 1. Iniciamos sesión y cargamos configuración
session_start();
require_once '../../config/config.php'; 

// 2. Seguridad: Si no hay sesión, al login
if (!isset($_SESSION['user_id'])) {
    header("Location: " . URL);
    exit();
}

// 3. Incluimos el header (ajustando la ruta a la nueva carpeta includes)
include '../includes/header.php'; 
?>

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
                            <img src="<?php echo URL; ?>public/img/noticia1.png" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <p class="text-muted small mb-2"><i class="bi bi-calendar3"></i> 07/01/2026</p>
                                <h5 class="fw-bold h6">Mantenimiento de Césped</h5>
                                <p class="card-text small text-muted">Estamos renovando la cancha principal.</p>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
        </div>
</div>

<div class="container my-5 pb-5">
    <h3 class="text-center fw-bold mb-4">Torneos en Curso</h3>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow rounded-4 overflow-hidden text-white">
                <div class="position-relative">
                    <img src="<?php echo URL; ?>public/img/cancha_fondo.png" class="card-img" style="height: 220px; object-fit: cover; filter: brightness(0.5);">
                    <div class="card-img-overlay d-flex flex-column justify-content-center text-center">
                        <h4 class="fw-bold">Torneo Apertura 2026</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>