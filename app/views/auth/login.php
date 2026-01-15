<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pato's Sport</title>
    
    <link rel="icon" type="image/png" href="<?php echo URL; ?>public/img/logo_patos.png">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --verde-patos: #0fb29a;
            --oscuro-patos: #121821;
        }

        body, html { height: 100%; margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow: hidden; }
        .login-container { height: 100vh; display: flex; }

        .login-image {
            background: url('<?php echo URL; ?>public/img/login_bg.png') center/cover no-repeat;
            width: 55%;
        }

        .login-form-section {
            width: 45%;
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            position: relative; /* Importante para el botón flotante */
        }

        /* BOTÓN REGRESAR POSICIONADO ABSOLUTO */
        .btn-regresar {
            position: absolute;
            top: 30px;
            left: 30px;
            text-decoration: none;
            color: #6c757d;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: 0.3s;
            z-index: 10;
        }

        .btn-regresar:hover { color: var(--verde-patos); transform: translateX(-5px); }

        .form-card { width: 100%; max-width: 380px; }

        .btn-ingresar {
            background-color: #28a745; 
            color: white;
            border: none;
            padding: 10px;
            font-weight: bold;
            width: 100%;
            transition: 0.3s;
        }

        .btn-ingresar:hover { background-color: #218838; }

        .input-group-text { background: transparent; border-right: none; }
        .form-control { border-left: none; height: 45px; }

        @media (max-width: 992px) {
            .login-image { display: none; }
            .login-form-section { width: 100%; }
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-image"></div>

    <div class="login-form-section">
        
        <a href="<?php echo URL; ?>" class="btn-regresar">
            <i class="bi bi-arrow-left-circle fs-4"></i> 
            Regresar al Inicio
        </a>

        <div class="form-card text-center">
            <img src="<?php echo URL; ?>public/img/logo_patos.png" alt="Logo" style="height: 100px;" class="mb-2">
            <h2 class="fw-bold mb-1">Bienvenido de Nuevo</h2>
            <p class="text-muted mb-4 small">Accede a tu panel de gestión.</p>

            <form action="<?php echo URL; ?>auth/login" method="POST">
                <div class="text-start mb-3">
                    <label class="form-label small fw-bold">Correo electrónico</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="usuario" class="form-control" placeholder="admin@patos.com" required>
                    </div>
                </div>

                <div class="text-start mb-3">
                    <label class="form-label small fw-bold">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                        <span class="input-group-text" style="cursor: pointer;">
                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                        </span>
                    </div>
                </div>

                <div class="form-check text-start mb-4">
                    <input class="form-check-input" type="checkbox" id="remember">
                    <label class="form-check-label small text-muted" for="remember">Recordar sesión</label>
                </div>

                <button type="submit" class="btn btn-ingresar rounded-1 shadow-sm">INGRESAR</button>
            </form>

            <p class="x-small text-muted mt-4">
                ¿No tienes una cuenta? <br>
                <span class="text-dark fw-bold">Contacta a la administración.</span>
            </p>
        </div>
    </div>
</div>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });
</script>

</body>
</html>