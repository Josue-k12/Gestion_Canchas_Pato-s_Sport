<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Encargado - Pato's Sport</title>
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Registrar Nuevo Encargado</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo URL; ?>index.php?c=Encargado&a=guardar" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nombre Completo</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Correo Electrónico</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contraseña Temporal</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="<?php echo URL; ?>index.php?c=Encargado&a=index" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Guardar Encargado</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>