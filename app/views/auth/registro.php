<?php 

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Pato's Sport</title>
    
    <link rel="icon" type="image/png" href="<?php echo URL; ?>public/img/logo_patos.png">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --verde-patos: #0fb29a;
            --oscuro-patos: #121821;
        }

        body, html { height: 100%; margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }

        .login-container { min-height: 100vh; display: flex; overflow: hidden; }

        /* Lado izquierdo: Imagen */
        .login-image {
            background: url('<?php echo URL; ?>public/img/login_bg.png') center/cover no-repeat;
            width: 55%;
            position: relative;
        }

        /* Lado derecho: Formulario */
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
        }
        
        .btn-volver:hover {
            transform: translateX(-5px);
            color: var(--verde-patos) !important;
        }

        .form-card { width: 100%; max-width: 450px; }

        .btn-registrar {
            background-color: var(--verde-patos); 
            color: white;
            border: none;
            padding: 12px;
            font-weight: bold;
            width: 100%;
            transition: 0.3s;
        }

        .btn-registrar:hover { 
            background-color: #0d9682; 
            color: white;
            transform: scale(1.02);
        }

        .input-group-text { background: transparent; border-right: none; }
        .form-control { border-left: none; }
        .form-control:focus { border-color: #dee2e6; box-shadow: none; }

        .password-strength {
            height: 4px;
            border-radius: 2px;
            transition: all 0.3s;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .form-control.is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

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
        <!-- Botón para volver al inicio -->
        <a href="<?php echo URL; ?>index.php" class="btn btn-link text-dark position-absolute" style="top: 20px; left: 20px; text-decoration: none; font-size: 1.2rem;" title="Volver al inicio">
            <i class="bi bi-arrow-left-circle"></i> Volver al inicio
        </a>
        
        <div class="form-card text-center">
            <img src="<?php echo URL; ?>public/img/logo_patos.png" alt="Logo Pato's Sport" style="height: 110px;" class="mb-3">
            <h2 class="fw-bold mb-1">Crear Nueva Cuenta</h2>
            <p class="text-muted mb-4">Únete a Pato's Sport y reserva tu cancha.</p>

            <form action="<?php echo URL; ?>index.php?c=Auth&a=register" method="POST" id="registerForm">
                
                <div class="text-start mb-3">
                    <label class="form-label small fw-bold">Nombre Completo</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                        <input type="text" name="nombre" class="form-control" placeholder="Juan Pérez" required minlength="3">
                    </div>
                </div>

                <div class="text-start mb-3">
                    <label class="form-label small fw-bold">Correo Electrónico</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="tu@email.com" required>
                    </div>
                </div>

                <div class="text-start mb-3">
                    <label class="form-label small fw-bold">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required minlength="6">
                        <span class="input-group-text" style="cursor: pointer;">
                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                        </span>
                    </div>
                    <div class="password-strength mt-2 bg-light" id="passwordStrength"></div>
                    <small class="text-muted">Mínimo 6 caracteres</small>
                </div>

                <div class="text-start mb-3">
                    <label class="form-label small fw-bold">Confirmar Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" id="password_confirm" name="password_confirm" class="form-control" placeholder="••••••••" required>
                        <span class="input-group-text" style="cursor: pointer;">
                            <i class="bi bi-eye-slash" id="togglePasswordConfirm"></i>
                        </span>
                    </div>
                    <small class="text-danger d-none" id="passwordError">Las contraseñas no coinciden</small>
                </div>

                <div class="text-start mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="terminos" required>
                        <label class="form-check-label small text-muted" for="terminos">
                            Acepto los <a href="#" class="text-decoration-none">términos y condiciones</a>
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-registrar rounded-1 shadow-sm mb-3">CREAR CUENTA</button>
            </form>

            <p class="small text-muted mt-3">
                ¿Ya tienes una cuenta? 
                <a href="<?php echo URL; ?>index.php?c=Auth&a=login" class="text-decoration-none fw-bold" style="color: var(--verde-patos);">
                    Inicia sesión aquí
                </a>
            </p>
        </div>
    </div>
</div>

<script>
    // Toggle password visibility
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });

    const togglePasswordConfirm = document.querySelector('#togglePasswordConfirm');
    const passwordConfirm = document.querySelector('#password_confirm');

    togglePasswordConfirm.addEventListener('click', function () {
        const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordConfirm.setAttribute('type', type);
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });

    // Password strength indicator
    password.addEventListener('input', function() {
        const strength = document.getElementById('passwordStrength');
        const value = this.value;
        let score = 0;

        if (value.length >= 6) score++;
        if (value.length >= 10) score++;
        if (/[A-Z]/.test(value)) score++;
        if (/[0-9]/.test(value)) score++;
        if (/[^A-Za-z0-9]/.test(value)) score++;

        strength.className = 'password-strength mt-2';
        
        if (score === 0) {
            strength.classList.add('bg-light');
        } else if (score <= 2) {
            strength.classList.add('bg-danger');
        } else if (score <= 3) {
            strength.classList.add('bg-warning');
        } else {
            strength.classList.add('bg-success');
        }
    });

    // Validate password match
    const form = document.getElementById('registerForm');
    const passwordError = document.getElementById('passwordError');

    form.addEventListener('submit', function(e) {
        if (password.value !== passwordConfirm.value) {
            e.preventDefault();
            passwordError.classList.remove('d-none');
            passwordConfirm.classList.add('is-invalid');
            passwordConfirm.focus();
        } else {
            passwordError.classList.add('d-none');
            passwordConfirm.classList.remove('is-invalid');
        }
    });

    passwordConfirm.addEventListener('input', function() {
        if (password.value !== passwordConfirm.value) {
            passwordError.classList.remove('d-none');
            passwordConfirm.classList.add('is-invalid');
        } else {
            passwordError.classList.add('d-none');
            passwordConfirm.classList.remove('is-invalid');
        }
    });
</script>

</body>
</html>
