<footer id="contacto" class="bg-patos-dark text-white pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row text-center text-md-start">
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold mb-3">Inf. de Contacto</h5>
                <p class="mb-1">
                    <span class="me-2">📞</span> +123 428 6908
                </p>
                <p>
                    <span class="me-2">📧</span> info@patossport.com
                </p>
            </div>

            <div class="col-md-4 mb-4 text-center">
                <h5 class="fw-bold mb-3">Menú</h5>
                <ul class="list-unstyled">
                    <li><a href="#inicio" class="text-white text-decoration-none hover-verde">Inicio</a></li>
                    <li><a href="#servicios" class="text-white text-decoration-none hover-verde">Servicios</a></li>
                    <li><a href="#noticias" class="text-white text-decoration-none hover-verde">Noticias</a></li>
                    <li><a href="#torneos" class="text-white text-decoration-none hover-verde">Torneos</a></li>
                </ul>
            </div>

            <div class="col-md-4 mb-4 text-center">
                <h5 class="fw-bold mb-3">Social Media</h5>
                <div class="d-flex justify-content-center gap-3">
                    <a href="https://facebook.com" target="_blank" class="social-icon text-white border border-secondary rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="width: 45px; height: 45px;">
                        <i class="bi bi-facebook fs-5"></i>
                    </a>
                    <a href="#" class="social-icon text-white border border-secondary rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="width: 45px; height: 45px;">
                        <i class="bi bi-twitter-x fs-5"></i>
                    </a>
                    <a href="#" class="social-icon text-white border border-secondary rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="width: 45px; height: 45px;">
                        <i class="bi bi-instagram fs-5"></i>
                    </a>
                </div>
            </div>
        </div>

        <hr class="bg-secondary opacity-25">
        
        <div class="row align-items-center">
            <div class="col-md-12 text-center">
                <p class="text-muted small mb-0">&copy; 2026 <strong>Pato's Sport</strong> - Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</footer>

<style>
    /* Estilos para el efecto hover en el footer */
    .hover-verde:hover {
        color: var(--verde-patos) !important;
        transition: 0.3s;
    }
    .social-icon {
        transition: all 0.3s ease;
        background-color: transparent;
    }
    .social-icon:hover {
        background-color: var(--verde-patos) !important;
        border-color: var(--verde-patos) !important;
        transform: translateY(-3px);
        color: white !important;
    }
</style>

<script src="<?php echo URL; ?>public/js/bootstrap.bundle.min.js"></script>

</body>
</html>