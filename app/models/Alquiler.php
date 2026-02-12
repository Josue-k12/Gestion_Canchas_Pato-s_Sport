<?php
require_once __DIR__ . '/Conexion.php';

class Alquiler {
    private $conexion;
    private $tabla = 'alquiler';

    public function __construct() {
        $database = new Conexion();
        $this->conexion = $database->conectar();
    }

    // Obtener todos los alquileres
    public function obtenerTodos() {
        $query = "SELECT a.*, u.nombre AS usuario_nombre, c.nombre AS cancha_nombre, 
                  e.estado_nombre
                  FROM " . $this->tabla . " a
                  INNER JOIN usuarios u ON a.usuario_id = u.id
                  INNER JOIN canchas c ON a.cancha_id = c.id
                  INNER JOIN estados e ON a.estado_id = e.estado_id
                  ORDER BY a.alquiler_fecha DESC";
        
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener alquileres por usuario
    public function obtenerPorUsuario($usuario_id) {
        $query = "SELECT a.*, u.nombre AS usuario_nombre, c.nombre AS cancha_nombre, 
                  e.estado_nombre
                  FROM " . $this->tabla . " a
                  INNER JOIN usuarios u ON a.usuario_id = u.id
                  INNER JOIN canchas c ON a.cancha_id = c.id
                  INNER JOIN estados e ON a.estado_id = e.estado_id
                  WHERE a.usuario_id = :usuario_id
                  ORDER BY a.alquiler_fecha DESC";
        
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener alquiler por ID
    public function obtenerPorId($id) {
        $query = "SELECT a.*, u.nombre AS usuario_nombre, c.nombre AS cancha_nombre, 
                  c.precio_hora, e.estado_nombre
                  FROM " . $this->tabla . " a
                  INNER JOIN usuarios u ON a.usuario_id = u.id
                  INNER JOIN canchas c ON a.cancha_id = c.id
                  INNER JOIN estados e ON a.estado_id = e.estado_id
                  WHERE a.alquiler_id = :id
                  LIMIT 1";
        
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear nuevo alquiler
    public function crear($datos) {
        $query = "INSERT INTO " . $this->tabla . " 
                  (usuario_id, cancha_id, estado_id, alquiler_fecha, alquiler_hora_inicial, 
                   alquiler_hora_final, alquiler_valor, alquiler_comprobante_pago) 
                  VALUES (:usuario_id, :cancha_id, :estado_id, :alquiler_fecha, :alquiler_hora_inicial, 
                          :alquiler_hora_final, :alquiler_valor, :alquiler_comprobante_pago)";
        
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':usuario_id', $datos['usuario_id']);
        $stmt->bindParam(':cancha_id', $datos['cancha_id']);
        $stmt->bindParam(':estado_id', $datos['estado_id']);
        $stmt->bindParam(':alquiler_fecha', $datos['alquiler_fecha']);
        $stmt->bindParam(':alquiler_hora_inicial', $datos['alquiler_hora_inicial']);
        $stmt->bindParam(':alquiler_hora_final', $datos['alquiler_hora_final']);
        $stmt->bindParam(':alquiler_valor', $datos['alquiler_valor']);
        $stmt->bindParam(':alquiler_comprobante_pago', $datos['alquiler_comprobante_pago']);
        
        return $stmt->execute();
    }

    // Actualizar alquiler
    public function actualizar($id, $datos) {
        $query = "UPDATE " . $this->tabla . " 
                  SET usuario_id = :usuario_id,
                      cancha_id = :cancha_id,
                      estado_id = :estado_id,
                      alquiler_fecha = :alquiler_fecha,
                      alquiler_hora_inicial = :alquiler_hora_inicial,
                      alquiler_hora_final = :alquiler_hora_final,
                      alquiler_valor = :alquiler_valor,
                      metodo_pago = :metodo_pago,
                      monto_efectivo = :monto_efectivo";
        
        // Solo actualizar comprobante si se proporciona
        if (!empty($datos['alquiler_comprobante_pago'])) {
            $query .= ", alquiler_comprobante_pago = :alquiler_comprobante_pago";
        }
        
        $query .= " WHERE alquiler_id = :id";
        
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':usuario_id', $datos['usuario_id']);
        $stmt->bindParam(':cancha_id', $datos['cancha_id']);
        $stmt->bindParam(':estado_id', $datos['estado_id']);
        $stmt->bindParam(':alquiler_fecha', $datos['alquiler_fecha']);
        $stmt->bindParam(':alquiler_hora_inicial', $datos['alquiler_hora_inicial']);
        $stmt->bindParam(':alquiler_hora_final', $datos['alquiler_hora_final']);
        $stmt->bindParam(':alquiler_valor', $datos['alquiler_valor']);
        $stmt->bindParam(':metodo_pago', $datos['metodo_pago']);
        $stmt->bindParam(':monto_efectivo', $datos['monto_efectivo']);
        
        if (!empty($datos['alquiler_comprobante_pago'])) {
            $stmt->bindParam(':alquiler_comprobante_pago', $datos['alquiler_comprobante_pago']);
        }
        
        return $stmt->execute();
    }

    // Eliminar alquiler
    public function eliminar($id) {
        $query = "DELETE FROM " . $this->tabla . " WHERE alquiler_id = :id";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Obtener estados disponibles
    public function obtenerEstados() {
        $query = "SELECT * FROM estados ORDER BY estado_id ASC";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener configuración (precio/hora)
    public function obtenerConfiguracion($tipo = 'precio_hora_default') {
        // Si solo se pide el precio por hora (compatibilidad con código existente)
        if ($tipo === 'precio_hora_default') {
            $query = "SELECT valor_hora FROM configuracion LIMIT 1";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado ? $resultado['valor_hora'] : 50000;
        }
        
        // Retornar toda la configuración
        $query = "SELECT * FROM configuracion LIMIT 1";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Obtener horas disponibles
    public function obtenerHoras() {
        $query = "SELECT * FROM horas ORDER BY hora ASC";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // RF14: Verificar disponibilidad de cancha (Anti-duplicidad)
    public function verificarDisponibilidad($cancha_id, $fecha, $hora_inicio, $hora_fin, $excluir_id = null) {
        $query = "SELECT COUNT(*) as total FROM " . $this->tabla . " 
                  WHERE cancha_id = :cancha_id 
                  AND alquiler_fecha = :fecha
                  AND estado_id NOT IN (4, 5) -- No contar anulados y cancelados
                  AND (
                      (alquiler_hora_inicial < :hora_fin AND alquiler_hora_final > :hora_inicio)
                  )";
        
        if ($excluir_id) {
            $query .= " AND alquiler_id != :excluir_id";
        }
        
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':cancha_id', $cancha_id);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':hora_inicio', $hora_inicio);
        $stmt->bindParam(':hora_fin', $hora_fin);
        
        if ($excluir_id) {
            $stmt->bindParam(':excluir_id', $excluir_id);
        }
        
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $resultado['total'] == 0; // True si está disponible
    }

    // RF18: Cambiar estado de alquiler
    public function cambiarEstado($alquiler_id, $estado_id) {
        try {
            $query = "UPDATE " . $this->tabla . " SET estado_id = :estado_id WHERE alquiler_id = :alquiler_id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':estado_id', $estado_id);
            $stmt->bindParam(':alquiler_id', $alquiler_id);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en cambiarEstado: " . $e->getMessage());
            return false;
        }
    }

    // RF03: Obtener estadísticas del cliente (últimos 10, horas totales, dinero gastado)
    public function obtenerEstadisticasCliente($usuario_id) {
        try {
            // Últimos 10 alquileres
            $queryUltimos = "SELECT a.*, c.nombre AS cancha_nombre, e.estado_nombre
                            FROM " . $this->tabla . " a
                            INNER JOIN canchas c ON a.cancha_id = c.id
                            INNER JOIN estados e ON a.estado_id = e.estado_id
                            WHERE a.usuario_id = :usuario_id
                            ORDER BY a.alquiler_fecha DESC, a.alquiler_hora_inicial DESC
                            LIMIT 10";
            
            $stmtUltimos = $this->conexion->prepare($queryUltimos);
            $stmtUltimos->bindParam(':usuario_id', $usuario_id);
            $stmtUltimos->execute();
            $ultimos = $stmtUltimos->fetchAll(PDO::FETCH_ASSOC);

            // Totales (solo alquileres aprobados y finalizados)
            $queryTotales = "SELECT 
                            COUNT(*) as total_alquileres,
                            SUM(alquiler_valor) as total_gastado,
                            SUM(TIMESTAMPDIFF(HOUR, alquiler_hora_inicial, alquiler_hora_final)) as total_horas
                            FROM " . $this->tabla . "
                            WHERE usuario_id = :usuario_id
                            AND estado_id IN (2, 3)"; // Aprobados y finalizados
            
            $stmtTotales = $this->conexion->prepare($queryTotales);
            $stmtTotales->bindParam(':usuario_id', $usuario_id);
            $stmtTotales->execute();
            $totales = $stmtTotales->fetch(PDO::FETCH_ASSOC);

            return [
                'ultimos_alquileres' => $ultimos,
                'total_alquileres' => $totales['total_alquileres'] ?? 0,
                'total_gastado' => $totales['total_gastado'] ?? 0,
                'total_horas' => $totales['total_horas'] ?? 0
            ];
        } catch (PDOException $e) {
            error_log("Error en obtenerEstadisticasCliente: " . $e->getMessage());
            return [
                'ultimos_alquileres' => [],
                'total_alquileres' => 0,
                'total_gastado' => 0,
                'total_horas' => 0
            ];
        }
    }

    // Dashboard Admin: Obtener alquileres recientes (últimos 10)
    public function obtenerAlquileresRecientes($limite = 10) {
        try {
            $query = "SELECT a.*, u.nombre AS usuario_nombre, c.nombre AS cancha_nombre, 
                      e.estado_nombre
                      FROM " . $this->tabla . " a
                      INNER JOIN usuarios u ON a.usuario_id = u.id
                      INNER JOIN canchas c ON a.cancha_id = c.id
                      INNER JOIN estados e ON a.estado_id = e.estado_id
                      ORDER BY a.alquiler_fecha DESC, a.alquiler_hora_inicial DESC
                      LIMIT :limite";
            
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':limite', $limite, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en obtenerAlquileresRecientes: " . $e->getMessage());
            return [];
        }
    }

    // Dashboard Admin: Obtener alquileres pendientes de aprobación
    public function obtenerAlquileresPendientes() {
        try {
            $query = "SELECT a.*, u.nombre AS usuario_nombre, c.nombre AS cancha_nombre, 
                      e.estado_nombre
                      FROM " . $this->tabla . " a
                      INNER JOIN usuarios u ON a.usuario_id = u.id
                      INNER JOIN canchas c ON a.cancha_id = c.id
                      INNER JOIN estados e ON a.estado_id = e.estado_id
                      WHERE a.estado_id = 1 -- registrado/pendiente
                      ORDER BY a.alquiler_fecha ASC, a.alquiler_hora_inicial ASC";
            
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en obtenerAlquileresPendientes: " . $e->getMessage());
            return [];
        }
    }

    // Dashboard Encargado: Obtener alquileres del día de hoy
    public function obtenerAlquileresHoy() {
        try {
            $query = "SELECT a.*, u.nombre AS usuario_nombre, c.nombre AS cancha_nombre, 
                      e.estado_nombre
                      FROM " . $this->tabla . " a
                      INNER JOIN usuarios u ON a.usuario_id = u.id
                      INNER JOIN canchas c ON a.cancha_id = c.id
                      INNER JOIN estados e ON a.estado_id = e.estado_id
                      WHERE DATE(a.alquiler_fecha) = CURDATE()
                      ORDER BY a.alquiler_hora_inicial ASC";
            
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en obtenerAlquileresHoy: " . $e->getMessage());
            return [];
        }
    }

    // Dashboard Admin: Obtener ingresos del mes actual (alquileres aprobados)
    public function obtenerIngresosDelMes() {
        try {
            $query = "SELECT COALESCE(SUM(alquiler_valor), 0) as ingresos
                      FROM " . $this->tabla . "
                      WHERE estado_id IN (2, 3) -- aprobado y finalizado
                      AND MONTH(alquiler_fecha) = MONTH(CURDATE())
                      AND YEAR(alquiler_fecha) = YEAR(CURDATE())";
            
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return floatval($resultado['ingresos'] ?? 0);
        } catch (PDOException $e) {
            error_log("Error en obtenerIngresosDelMes: " . $e->getMessage());
            return 0;
        }
    }

    // Dashboard Admin: Obtener datos para gráfico de uso mensual (últimos 12 meses)
    public function obtenerDatosGraficoMeses() {
        try {
            $query = "SELECT 
                      MONTH(alquiler_fecha) as mes,
                      YEAR(alquiler_fecha) as anio,
                      COUNT(*) as total_alquileres,
                      SUM(alquiler_valor) as ingresos,
                      SUM(TIMESTAMPDIFF(HOUR, alquiler_hora_inicial, alquiler_hora_final)) as horas_uso
                      FROM " . $this->tabla . "
                      WHERE estado_id IN (2, 3) -- aprobado y finalizado
                      AND alquiler_fecha >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
                      GROUP BY YEAR(alquiler_fecha), MONTH(alquiler_fecha)
                      ORDER BY YEAR(alquiler_fecha) ASC, MONTH(alquiler_fecha) ASC";
            
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Preparar arrays para el gráfico
            $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 
                      'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
            
            $labels = [];
            $horas = [];
            $ingresos = [];
            
            // Crear array con últimos 12 meses
            for ($i = 11; $i >= 0; $i--) {
                $fecha = strtotime("-$i months");
                $mes = date('n', $fecha) - 1; // 0-11
                $anio = date('Y', $fecha);
                
                $labels[] = $meses[$mes];
                
                // Buscar si existe datos para este mes
                $found = false;
                foreach ($datos as $d) {
                    if ($d['mes'] == ($mes + 1) && $d['anio'] == $anio) {
                        $horas[] = intval($d['horas_uso'] ?? 0);
                        $ingresos[] = floatval($d['ingresos'] ?? 0);
                        $found = true;
                        break;
                    }
                }
                
                if (!$found) {
                    $horas[] = 0;
                    $ingresos[] = 0;
                }
            }
            
            return [
                'labels' => $labels,
                'horas' => $horas,
                'ingresos' => $ingresos
            ];
        } catch (PDOException $e) {
            error_log("Error en obtenerDatosGraficoMeses: " . $e->getMessage());
            return [
                'labels' => [],
                'horas' => [],
                'ingresos' => []
            ];
        }
    }

    // RF14: Obtener horas ocupadas de una cancha en una fecha específica
    public function obtenerHorasOcupadasPorCanchaYFecha($cancha_id, $fecha) {
        try {
            $query = "SELECT 
                        TIME_FORMAT(alquiler_hora_inicial, '%H:%i:%s') as hora_inicial,
                        TIME_FORMAT(alquiler_hora_final, '%H:%i:%s') as hora_final
                      FROM " . $this->tabla . "
                      WHERE cancha_id = :cancha_id
                      AND alquiler_fecha = :fecha
                      AND estado_id NOT IN (4, 5) -- No contar anulados y cancelados
                      ORDER BY alquiler_hora_inicial ASC";
            
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':cancha_id', $cancha_id);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->execute();
            
            $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Generar array de horas ocupadas expandido (todas las horas dentro del rango)
            $horasOcupadas = [];
            foreach ($reservas as $reserva) {
                $inicio = new DateTime($reserva['hora_inicial']);
                $fin = new DateTime($reserva['hora_final']);
                
                // Agregar todas las horas dentro del rango
                while ($inicio < $fin) {
                    $horasOcupadas[] = $inicio->format('H:i:s');
                    $inicio->modify('+1 hour');
                }
            }
            
            return array_unique($horasOcupadas);
        } catch (PDOException $e) {
            error_log("Error en obtenerHorasOcupadasPorCanchaYFecha: " . $e->getMessage());
            return [];
        }
    }

    // RF14: Obtener horas ocupadas por todas las canchas en una fecha
    public function obtenerHorasOcupadasPorFecha($fecha) {
        try {
            $query = "SELECT 
                        c.id as cancha_id,
                        c.nombre as cancha_nombre,
                        TIME_FORMAT(a.alquiler_hora_inicial, '%H:%i:%s') as hora_inicial,
                        TIME_FORMAT(a.alquiler_hora_final, '%H:%i:%s') as hora_final
                      FROM " . $this->tabla . " a
                      INNER JOIN canchas c ON a.cancha_id = c.id
                      WHERE a.alquiler_fecha = :fecha
                      AND a.estado_id NOT IN (4, 5)
                      ORDER BY c.nombre ASC, a.alquiler_hora_inicial ASC";

            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->execute();

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $porCancha = [];

            foreach ($rows as $row) {
                $canchaId = $row['cancha_id'];

                if (!isset($porCancha[$canchaId])) {
                    $porCancha[$canchaId] = [
                        'cancha_id' => $canchaId,
                        'cancha_nombre' => $row['cancha_nombre'],
                        'horas' => []
                    ];
                }

                $inicio = new DateTime($row['hora_inicial']);
                $fin = new DateTime($row['hora_final']);

                while ($inicio < $fin) {
                    $porCancha[$canchaId]['horas'][] = $inicio->format('H:i:s');
                    $inicio->modify('+1 hour');
                }
            }

            $resultado = [];
            foreach ($porCancha as $canchaData) {
                $canchaData['horas'] = array_values(array_unique($canchaData['horas']));
                $resultado[] = $canchaData;
            }

            return $resultado;
        } catch (PDOException $e) {
            error_log("Error en obtenerHorasOcupadasPorFecha: " . $e->getMessage());
            return [];
        }
    }
}
?>
