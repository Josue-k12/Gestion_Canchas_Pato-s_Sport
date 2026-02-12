<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?php echo URL; ?>index.php" class="brand-link">
        <img src="<?php echo URL; ?>public/img/logo_patos.png" alt="Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">Pato's Sport</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?php echo URL; ?>index.php?c=Home&a=index" class="nav-link">
                        <i class="nav-icon bi bi-house"></i>
                        <p>Inicio</p>
                    </a>
                </li>
                
                <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 1): ?>
                    <!-- Menú para ADMINISTRADOR -->
                    
                    <!-- Configuración -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link" data-toggle="treeview" role="button">
                            <i class="nav-icon bi bi-gear"></i>
                            <p>
                                Configuración
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="<?php echo URL; ?>index.php?c=Usuario&a=index" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Usuarios</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo URL; ?>index.php?c=Rol&a=index" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo URL; ?>index.php?c=Cancha&a=index" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Canchas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo URL; ?>index.php?c=Hora&a=index" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Horas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo URL; ?>index.php?c=Alquiler&a=index" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Alquileres</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo URL; ?>index.php?c=Noticia&a=index" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Noticias</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Control de Canchas -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link" data-toggle="treeview" role="button">
                            <i class="nav-icon bi bi-calendar-check"></i>
                            <p>
                                Control de Canchas
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="<?php echo URL; ?>index.php?c=Alquiler&a=index" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Arrendamientos</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Reportes -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link" data-toggle="treeview" role="button">
                            <i class="nav-icon bi bi-file-earmark-text"></i>
                            <p>
                                Reportes
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="<?php echo URL; ?>index.php?c=Reporte&a=alquileres" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Arrendamientos</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                <?php elseif(isset($_SESSION['rol']) && $_SESSION['rol'] == 2): ?>
                    <!-- Menú para CLIENTES -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link" data-toggle="treeview" role="button">
                            <i class="nav-icon bi bi-calendar-event"></i>
                            <p>
                                Arrendamiento
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="<?php echo URL; ?>index.php?c=Alquiler&a=misAlquileres" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Mis Alquileres</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo URL; ?>index.php?c=Alquiler&a=crear" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Nueva Reserva</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</aside>

<script>
    document.querySelectorAll('[data-widget="pushmenu"]').forEach(function(element) {
        element.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            const isMobile = window.innerWidth < 992;

            if (isMobile) {
                document.body.classList.toggle('sidebar-open');
                document.body.classList.remove('sidebar-collapse');
            } else {
                document.body.classList.toggle('sidebar-collapse');
                document.body.classList.remove('sidebar-open');
            }
        });
    });

    document.querySelectorAll('[data-toggle="treeview"]').forEach(function(element) {
        element.addEventListener('click', function(e) {
            e.preventDefault();
            const parent = this.closest('.has-treeview');
            const submenu = parent.querySelector('.nav-treeview');
            const isVisible = submenu.style.display !== 'none';
            
            submenu.style.display = isVisible ? 'none' : 'block';
            parent.classList.toggle('menu-open');
            this.closest('.nav-item').classList.toggle('menu-is-opening');
        });
    });

    // Mostrar menú automáticamente si estamos en páginas de admin
    const currentUrl = window.location.href;
    const queryParams = new URLSearchParams(window.location.search);
    const controller = queryParams.get('c');
    
    // Auto-expandir menú de Configuración
    if (['Usuario', 'Rol', 'Cancha', 'Hora', 'Alquiler', 'Noticia'].includes(controller)) {
        const configMenu = document.querySelectorAll('[data-toggle="treeview"]')[0];
        if (configMenu) {
            const parent = configMenu.closest('.has-treeview');
            const submenu = parent.querySelector('.nav-treeview');
            submenu.style.display = 'block';
            parent.classList.add('menu-open');
        }
    }
    
    // Auto-expandir menú de Control de Canchas
    if (currentUrl.includes('c=Alquiler') && !currentUrl.includes('c=Alquiler&a=crear')) {
        const controlMenu = document.querySelectorAll('[data-toggle="treeview"]')[1];
        if (controlMenu) {
            const parent = controlMenu.closest('.has-treeview');
            const submenu = parent.querySelector('.nav-treeview');
            submenu.style.display = 'block';
            parent.classList.add('menu-open');
        }
    }

    // Auto-expandir menú de Reportes
    if (currentUrl.includes('c=Reporte')) {
        const reporteMenu = document.querySelectorAll('[data-toggle="treeview"]')[2];
        if (reporteMenu) {
            const parent = reporteMenu.closest('.has-treeview');
            const submenu = parent.querySelector('.nav-treeview');
            submenu.style.display = 'block';
            parent.classList.add('menu-open');
        }
    }

    // Auto-expandir menú de Arrendamiento para CLIENTES
    if (currentUrl.includes('c=Alquiler')) {
        // Para clientes, solo hay un menú treeview (Arrendamiento)
        const arrendamientoMenu = document.querySelector('.nav-sidebar > .has-treeview > [data-toggle="treeview"]');
        if (arrendamientoMenu) {
            const parent = arrendamientoMenu.closest('.has-treeview');
            const submenu = parent.querySelector('.nav-treeview');
            if (submenu) {
                submenu.style.display = 'block';
                parent.classList.add('menu-open');
            }
        }
    }

</script>
