<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../layout/header.php';
?>

<style>
    body {
        overflow-x: hidden;
    }

    .search-bar {
        max-width: 900px;
    }

    @media (max-width: 767.98px) {
        .hero-section {
            height: auto !important;
            padding: 40px 0;
        }

        .hero-section h1 {
            font-size: 2rem;
        }

        .hero-section h2 {
            font-size: 1.25rem;
        }

        .search-bar {
            border-radius: 16px !important;
            padding: 1rem !important;
            gap: 0.75rem !important;
        }

        .search-bar .form-select,
        .search-bar .form-control,
        .search-bar .btn {
            width: 100% !important;
        }

        .search-bar .vr {
            display: none !important;
        }

        #carouselNoticias {
            overflow: hidden;
        }

        #carouselNoticias .carousel-control-prev,
        #carouselNoticias .carousel-control-next {
            width: 40px !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
        }

        #carouselNoticias .carousel-control-prev {
            left: 0 !important;
        }

        #carouselNoticias .carousel-control-next {
            right: 0 !important;
        }
    }

    @media (max-width: 768px) {
        .search-bar button {
            width: 100%;
        }
        .btn-patos {
            width: 100%;
        }
    }
</style>

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
        
        <div class="search-bar bg-white p-3 rounded-pill shadow-lg mt-4 d-flex flex-wrap justify-content-center gap-2 mx-auto">
            <input id="fechaSelect" type="date" class="form-control border-0 w-auto bg-transparent text-dark">
            <button id="buscarDisponibilidad" class="btn btn-success rounded-pill px-4 fw-bold">Buscar disponibilidad</button>
        </div>
        
            <div class="mt-3 d-block d-md-none">
                <a href="<?php echo URL; ?>index.php?c=Auth&a=login" class="btn btn-patos rounded-pill px-4 py-2">
                    Reserva Ahora
                </a>
            </div>
            <div id="resultadoDisponibilidad" class="mt-3"></div>
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
        
        <?php if (!empty($noticias) && count($noticias) > 0): ?>
        <div id="carouselNoticias" class="carousel slide" data-bs-interval="false" style="position: relative;">
            <div class="carousel-inner">
                <?php 
                $noticiasChunks = array_chunk($noticias, 3);
                foreach ($noticiasChunks as $index => $chunk): 
                ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <div class="row g-4">
                        <?php foreach ($chunk as $noticia): ?>
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                                <?php if (!empty($noticia['imagen'])): ?>
                                <img src="<?php echo URL; ?>public/img/<?php echo htmlspecialchars($noticia['imagen']); ?>" 
                                     class="card-img-top" 
                                     style="height: 200px; object-fit: cover;"
                                     alt="<?php echo htmlspecialchars($noticia['titulo']); ?>">
                                <?php else: ?>
                                <img src="<?php echo URL; ?>public/img/noticia_default.jpg" 
                                     class="card-img-top" 
                                     style="height: 200px; object-fit: cover;"
                                     alt="Sin imagen">
                                <?php endif; ?>
                                <div class="card-body">
                                    <p class="text-muted small mb-2">
                                        <i class="bi bi-calendar3"></i> 
                                        <?php echo date('d/m/Y', strtotime($noticia['fecha_creacion'])); ?>
                                    </p>
                                    <h5 class="fw-bold h6"><?php echo htmlspecialchars($noticia['titulo']); ?></h5>
                                    <p class="card-text small text-muted">
                                        <?php echo htmlspecialchars($noticia['descripcion'] ?? substr($noticia['contenido'], 0, 100) . '...'); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <?php if (count($noticiasChunks) > 1): ?>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselNoticias" data-bs-slide="prev" style="left: -60px; width: 50px; height: auto; top: 50%; transform: translateY(-50%);">
                <span class="bi bi-chevron-left" style="font-size: 2rem; color: #0fb29a;"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselNoticias" data-bs-slide="next" style="right: -60px; width: 50px; height: auto; top: 50%; transform: translateY(-50%);">
                <span class="bi bi-chevron-right" style="font-size: 2rem; color: #0fb29a;"></span>
            </button>
            <?php endif; ?>
        </div>
        <?php else: ?>
        <p class="text-center text-muted">No hay noticias disponibles en este momento.</p>
        <?php endif; ?>
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

<?php include __DIR__ . '/../layout/footer_public.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fechaSelect = document.getElementById('fechaSelect');
    const buscarBtn = document.getElementById('buscarDisponibilidad');
    const resultado = document.getElementById('resultadoDisponibilidad');

    function renderResultadoPorCancha(listado) {
        if (!listado.length) {
            resultado.innerHTML = '<div class="alert alert-success mb-0">No hay horas ocupadas para la fecha seleccionada.</div>';
            return;
        }

        const cards = listado.map(cancha => {
            const horasHtml = cancha.horas.length
                ? cancha.horas.map(hora => `<span class="badge bg-danger me-1 mb-1">${hora}</span>`).join('')
                : '<span class="text-muted">Sin horas ocupadas.</span>';

            return `
                <div class="border rounded-3 p-3 mb-3">
                    <div class="fw-bold mb-2">${cancha.cancha_nombre}</div>
                    <div class="d-flex flex-wrap">${horasHtml}</div>
                </div>
            `;
        }).join('');

        resultado.innerHTML = `
            <div class="alert alert-light mb-0">
                <div class="mb-3"><strong>Horas ocupadas por cancha:</strong></div>
                ${cards}
            </div>
        `;
    }

    if (buscarBtn) {
        buscarBtn.addEventListener('click', async function() {
            const fecha = fechaSelect ? fechaSelect.value : '';

            if (!fecha) {
                resultado.innerHTML = '<div class="alert alert-info mb-0">Selecciona una fecha para ver disponibilidad.</div>';
                return;
            }

            resultado.innerHTML = '<div class="alert alert-info mb-0">Consultando disponibilidad...</div>';

            try {
                const response = await fetch(`<?php echo URL; ?>index.php?c=Alquiler&a=obtenerHorasOcupadas&fecha=${fecha}`);
                const data = await response.json();

                if (data.error) {
                    resultado.innerHTML = '<div class="alert alert-danger mb-0">No se pudo consultar la disponibilidad.</div>';
                    return;
                }

                const listado = data.por_cancha || [];
                renderResultadoPorCancha(listado);
            } catch (error) {
                console.error('Error al consultar disponibilidad:', error);
                resultado.innerHTML = '<div class="alert alert-danger mb-0">Error al consultar disponibilidad. Intenta de nuevo.</div>';
            }
        });
    }

    const carouselEl = document.getElementById('carouselNoticias');
    if (carouselEl) {
        const carousel = new bootstrap.Carousel(carouselEl, {
            interval: false,
            wrap: true
        });
        
        // Botón anterior
        document.querySelector('[data-bs-slide="prev"]').addEventListener('click', function(e) {
            e.preventDefault();
            carousel.prev();
        });
        
        // Botón siguiente
        document.querySelector('[data-bs-slide="next"]').addEventListener('click', function(e) {
            e.preventDefault();
            carousel.next();
        });
    }
});
</script>
