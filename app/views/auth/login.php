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

        body, html { height: 100%; margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }

        .login-container { height: 100vh; display: flex; overflow: hidden; }

        /* Fondo de la imagen de login */
        .login-image {
            background: url('<?php echo URL; ?>public/img/login_bg.png') center/cover no-repeat;
            width: 55%;
            position: relative;
        }

        .login-form-section {
            width: 45%;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            position: relative;
        }
        
        .btn-volver {
            transition: transform 0.3s ease, color 0.3s ease;
            text-decoration: none;
            color: var(--oscuro-patos);
        }
        
        .btn-volver:hover {
            transform: translateX(-5px);
            color: var(--verde-patos) !important;
        }

        .form-card { width: 100%; max-width: 400px; }

        .btn-ingresar {
            background-color: #28a745; 
            color: white;
            border: none;
            padding: 12px;
            font-weight: bold;
            width: 100%;
            transition: 0.3s;
            border-radius: 5px;
        }

        .btn-ingresar:hover { background-color: #218838; color: white; transform: translateY(-2px); }

        .input-group-text { background: transparent; border-right: none; }
        .form-control { border-left: none; }
        .form-control:focus { border-color: var(--verde-patos); box-shadow: none; }

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
        <a href="<?php echo URL; ?>index.php" class="btn-volver position-absolute" style="top: 20px; left: 20px; font-size: 1.1rem;" title="Volver al inicio">
            <i class="bi bi-arrow-left-circle"></i> Volver al inicio
        </a>
        
        <div class="form-card text-center">
            <img src="<?php echo URL; ?>public/img/logo_patos.png" alt="Logo Pato's Sport" style="height: 120px;" class="mb-3">
            <h2 class="fw-bold mb-1">Bienvenido de Nuevo</h2>
            <p class="text-muted mb-4">Accede a tu panel de gestión.</p>

            <form action="<?php echo URL; ?>index.php?c=Auth&a=login" method="POST">
                
                <div class="text-start mb-3">
                    <label class="form-label small fw-bold">Correo Electrónico</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
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

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember">
                        <label class="form-check-label small text-muted" for="remember">Recordar mi sesión</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-ingresar shadow-sm mb-3">INGRESAR</button>
            </form>

            <p class="small text-muted mt-3">
                ¿No tienes una cuenta? <br>
                <span class="text-dark fw-bold">Contacta a la administración para solicitar acceso.</span>
            </p>
        </div>
    </div>
</div>

<script>
    // Lógica para mostrar/ocultar contraseña
    const togglePassword = document.querySelector('#togglePassword');
    const passwordField = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });
</script>

</body>
</html>