<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$rol = $_SESSION['rol'] ?? 'invitado';
$nombreUsuario = $_SESSION['user_nombre'] ?? '';

include 'app/views/layout/plantilla.php';
ob_start();
?>

<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-trophy text-warning"></i> Gestión de Partidos
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo URL; ?>index.php">Inicio</a></li>
                    <li class="breadcrumb-item active">Partidos</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        
        <!-- Botón crear partido (solo admin y encargado) -->
        <?php if($rol === 'admin' || $rol === 'encargado'): ?>
        <div class="row mb-3">
            <div class="col-12">
                <a href="<?php echo URL; ?>index.php?c=Partido&a=crear" class="btn btn-success">
                    <i class="fas fa-plus-circle"></i> Nuevo Partido
                </a>
            </div>
        </div>
        <?php endif; ?>

        <!-- Tabla de partidos -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-gradient-warning">
                        <h3 class="card-title">
                            <i class="fas fa-list"></i> 
                            Listado de Partidos
                        </h3>
                    </div>
                    <div class="card-body">
                        <?php if(empty($partidos)): ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> No hay partidos programados actualmente.
                            <?php if($rol === 'admin' || $rol === 'encargado'): ?>
                                <a href="<?php echo URL; ?>index.php?c=Partido&a=crear" class="alert-link">¿Deseas crear uno?</a>
                            <?php endif; ?>
                        </div>
                        <?php else: ?>
                        <table id="tablaPartidos" class="table table-bordered table-striped datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Cancha</th>
                                    <th>Equipos</th>
                                    <th>Tipo</th>
                                    <th>Estado</th>
                                    <th>Resultado</th>
                                    <?php if($rol === 'admin' || $rol === 'encargado'): ?>
                                    <th>Acciones</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($partidos as $partido): ?>
                                <tr>
                                    <td><?php echo $partido['id']; ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($partido['fecha'])); ?></td>
                                    <td>
                                        <?php echo date('H:i', strtotime($partido['hora_inicio'])); ?> - 
                                        <?php echo date('H:i', strtotime($partido['hora_fin'])); ?>
                                    </td>
                                    <td>
                                        <span class="badge badge-info">
                                            <?php echo $partido['cancha_nombre']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <strong><?php echo $partido['equipo1_nombre'] ?? 'Equipo 1'; ?></strong> 
                                        <span class="text-muted">vs</span> 
                                        <strong><?php echo $partido['equipo2_nombre'] ?? 'Equipo 2'; ?></strong>
                                    </td>
                                    <td>
                                        <span class="badge badge-<?php echo $partido['tipo'] === 'torneo' ? 'success' : 'secondary'; ?>">
                                            <?php echo ucfirst($partido['tipo']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php
                                        $estadoBadge = '';
                                        switch($partido['estado']) {
                                            case 'programado':
                                                $estadoBadge = 'primary';
                                                break;
                                            case 'en_curso':
                                                $estadoBadge = 'warning';
                                                break;
                                            case 'finalizado':
                                                $estadoBadge = 'success';
                                                break;
                                            case 'cancelado':
                                                $estadoBadge = 'danger';
                                                break;
                                            default:
                                                $estadoBadge = 'secondary';
                                        }
                                        ?>
                                        <span class="badge badge-<?php echo $estadoBadge; ?>">
                                            <?php echo ucfirst(str_replace('_', ' ', $partido['estado'])); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php echo $partido['resultado'] ?? '-'; ?>
                                    </td>
                                    <?php if($rol === 'admin' || $rol === 'encargado'): ?>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?php echo URL; ?>index.php?c=Partido&a=editar&id=<?php echo $partido['id']; ?>" 
                                               class="btn btn-sm btn-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <?php if($rol === 'admin'): ?>
                                            <a href="<?php echo URL; ?>index.php?c=Partido&a=eliminar&id=<?php echo $partido['id']; ?>" 
                                               class="btn btn-sm btn-danger" 
                                               onclick="return confirm('¿Está seguro de eliminar este partido?')"
                                               title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estadísticas rápidas -->
        <div class="row mt-4">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo count(array_filter($partidos, function($p) { return $p['estado'] === 'programado'; })); ?></h3>
                        <p>Programados</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?php echo count(array_filter($partidos, function($p) { return $p['estado'] === 'en_curso'; })); ?></h3>
                        <p>En Curso</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-futbol"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?php echo count(array_filter($partidos, function($p) { return $p['estado'] === 'finalizado'; })); ?></h3>
                        <p>Finalizados</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?php echo count(array_filter($partidos, function($p) { return $p['estado'] === 'cancelado'; })); ?></h3>
                        <p>Cancelados</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-times-circle"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?php
$contenido = ob_get_clean();
?>
