<?php
require_once 'app/models/Conexion.php';

class ReporteController {
    
    public function alquileres() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 1) {
            header("Location: " . URL . "index.php");
            exit();
        }

        $conexion = new Conexion();
        $db = $conexion->conectar();
        
        // Filtros
        $filtroEstado = $_GET['estado'] ?? '';
        $filtroFecha = $_GET['fecha'] ?? '';
        
        $query = "SELECT a.*, u.nombre as usuario_nombre, c.nombre as cancha_nombre, e.estado_nombre
                  FROM alquiler a
                  LEFT JOIN usuarios u ON a.usuario_id = u.id
                  LEFT JOIN canchas c ON a.cancha_id = c.id
                  LEFT JOIN estados e ON a.estado_id = e.estado_id
                  WHERE 1=1";
        
        $params = [];
        
        if ($filtroEstado) {
            $filtroEstado = (int)$filtroEstado;
            $query .= " AND a.estado_id = :estado";
            $params[':estado'] = $filtroEstado;
        }
        
        if ($filtroFecha) {
            $query .= " AND DATE(a.alquiler_fecha) = :fecha";
            $params[':fecha'] = $filtroFecha;
        }
        
        $query .= " ORDER BY a.alquiler_fecha ASC";
        
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        $alquileres = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Obtener estados para el filtro
        $queryEstados = "SELECT * FROM estados ORDER BY estado_nombre";
        $stmtEstados = $db->prepare($queryEstados);
        $stmtEstados->execute();
        $estados = $stmtEstados->fetchAll(PDO::FETCH_ASSOC);

        // Calcular totales
        $queryTotal = "SELECT COUNT(*) as total, SUM(alquiler_valor) as ingresos FROM alquiler WHERE 1=1";
        $paramsTotal = [];
        
        if ($filtroEstado) {
            $queryTotal .= " AND estado_id = :estado";
            $paramsTotal[':estado'] = $filtroEstado;
        }
        if ($filtroFecha) {
            $queryTotal .= " AND DATE(alquiler_fecha) = :fecha";
            $paramsTotal[':fecha'] = $filtroFecha;
        }
        
        $stmtTotal = $db->prepare($queryTotal);
        $stmtTotal->execute($paramsTotal);
        $totales = $stmtTotal->fetch(PDO::FETCH_ASSOC);

        include 'app/views/reportes/alquileres.php';
    }

    public function generarPDF() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 1) {
            header("Location: " . URL . "index.php");
            exit();
        }

        $conexion = new Conexion();
        $db = $conexion->conectar();

        $query = "SELECT a.alquiler_fecha, u.nombre as usuario_nombre, c.nombre as cancha_nombre, e.estado_nombre
                  FROM alquiler a
                  LEFT JOIN usuarios u ON a.usuario_id = u.id
                  LEFT JOIN canchas c ON a.cancha_id = c.id
                  LEFT JOIN estados e ON a.estado_id = e.estado_id
                  ORDER BY a.alquiler_fecha ASC";

        $stmt = $db->prepare($query);
        $stmt->execute();
        $alquileres = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Generar PDF
        require_once 'app/utils/PDFGenerator.php';
        $pdf = new PDFGenerator();
        $pdf->setTitle('Reporte de Alquileres');
        $pdf->addTable($alquileres, ['Fecha', 'Usuario', 'Cancha', 'Estado']);
        $pdf->output();
    }
}
