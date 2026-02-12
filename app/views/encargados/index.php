<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Encargados - Pato's Sport</title>
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root { --verde-patos: #0fb29a; --oscuro-patos: #121821; }
        .btn-nuevo { background-color: var(--verde-patos); color: white; font-weight: bold; }
        .btn-nuevo:hover { background-color: #0d9682; color: white; }
        .card-header { background-color: var(--oscuro-patos); color: white; }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-people-fill"></i> Gestión de Encargados</h2>
        <a href="<?php echo URL; ?>index.php?c=Encargado&a=nuevo" class="btn btn-nuevo">
            <i class="bi bi-plus-circle"></i> Nuevo Encargado
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header">Lista de Personal</div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($encargados)): ?>
                        <?php foreach ($encargados as $e): ?>
                        <tr>
                            <td><?php echo $e['nombre']; ?></td>
                            <td><?php echo $e['email']; ?></td>
                            <td><?php echo $e['telefono'] ?? 'N/A'; ?></td>
                            <td><span class="badge bg-success">Activo</span></td>
                            <td class="text-center">
                                <a href="#" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center p-4 text-muted">No hay encargados registrados actualmente.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>