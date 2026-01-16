<footer id="contacto" class="pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row text-center text-md-start">
            
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold mb-3 text-uppercase brand-title">Pato's Sport</h5>
                <p class="footer-text">Contamos con césped sintético profesional de última generación e iluminación LED para tus partidos nocturnos en Latacunga.</p>
                <a href="#servicios" class="btn btn-outline-patos btn-sm rounded-pill px-3">Conocer más</a>
            </div>

            <div class="col-md-4 mb-4 text-center">
                <h5 class="fw-bold mb-3 text-uppercase section-title">Mapa del Sitio</h5>
                <ul class="list-unstyled d-inline-block text-start">
                    <li class="mb-2"><a href="#inicio" class="footer-link"><i class="bi bi-house-door me-2"></i>Inicio</a></li>
                    <li class="mb-2"><a href="#servicios" class="footer-link"><i class="bi bi-trophy me-2"></i>Servicios</a></li>
                    <li class="mb-2"><a href="#ubicacion" class="footer-link"><i class="bi bi-geo-alt me-2"></i>Dirección</a></li>
                </ul>
            </div>

            <div class="col-md-4 mb-4 text-center">
                <h5 class="fw-bold mb-3 text-uppercase section-title">Síguenos en Redes</h5>
                <div class="d-flex justify-content-center gap-3 mb-3">
                    <a href="https://vm.tiktok.com/ZMDkhc2pL/" target="_blank" class="social-icon">
                        <i class="bi bi-tiktok"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="https://wa.me/593984577224" target="_blank" class="social-icon">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                </div>
                <p class="small text-white-50">¡Conéctate con nosotros!</p>
            </div>
        </div>

        <hr class="footer-divider">
        
        <div class="text-center">
            <p class="footer-text small mb-0">&copy; 2026 <strong>Pato's Sport</strong>. Latacunga, Ecuador.</p>
        </div>
    </div>
</footer>

<style>
    #contacto {
        background-color: #0b0f15; 
        color: #ffffff !important;
        padding: 60px 0 20px 0;
        border-top: 3px solid #0fb29a;
    }

    /* Colores de Títulos */
    .brand-title, .section-title {
        color: #0fb29a !important;
        font-weight: 800 !important;
    }

    /* Texto para que se vea claro (Blanco) */
    .footer-text, .footer-link {
        color: #ffffff !important;
        font-size: 0.95rem;
        opacity: 1 !important;
    }

    .footer-link {
        text-decoration: none;
        transition: 0.3s;
    }

    .footer-link:hover {
        color: #0fb29a !important;
        padding-left: 5px;
    }

    /* Iconos Sociales con el archivo CSS que pasaste */
    .social-icon {
        width: 48px;
        height: 48px;
        border: 2px solid #ffffff;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #ffffff !important;
        font-size: 1.4rem; /* Tamaño del icono bi-tiktok */
        transition: 0.3s ease;
        text-decoration: none;
    }

    .social-icon:hover {
        background-color: #0fb29a;
        border-color: #0fb29a;
        transform: translateY(-5px);
        box-shadow: 0 4px 10px rgba(15, 178, 154, 0.4);
    }

    .footer-divider {
        background-color: rgba(255,255,255,0.1);
        height: 1px;
        border: none;
    }

    .btn-outline-patos {
        color: #0fb29a;
        border-color: #0fb29a;
    }
    .btn-outline-patos:hover {
        background-color: #0fb29a;
        color: white;
    }
</style>

<!-- jQuery -->
<script src="<?php echo URL; ?>public/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap Bundle -->
<script src="<?php echo URL; ?>public/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>
