<?php
require_once 'app/models/Conexion.php';

class HoraController {
    
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 1) {
            header("Location: " . URL . "index.php");
            exit();
        }

        $conexion = new Conexion();
        $db = $conexion->conectar();
        
        $query = "SELECT * FROM horas ORDER BY hora";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $horas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include 'app/views/horas/index.php';
    }

    public function crear() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 1) {
            header("Location: " . URL . "index.php");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $conexion = new Conexion();
            $db = $conexion->conectar();
            
            $hora = $_POST['hora'];

            $query = "INSERT INTO horas (hora) VALUES (:hora)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':hora', $hora);
            
            if ($stmt->execute()) {
                $_SESSION['mensaje'] = 'Hora creada exitosamente';
                header("Location: " . URL . "index.php?c=Hora&a=index");
                exit();
            } else {
                $_SESSION['error'] = 'Error al crear la hora';
            }
        }

        include 'app/views/horas/crear.php';
    }

    public function editar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 1) {
            header("Location: " . URL . "index.php");
            exit();
        }

        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            header("Location: " . URL . "index.php?c=Hora&a=index");
            exit();
        }

        $conexion = new Conexion();
        $db = $conexion->conectar();
        
        $id = (int)$id;
        $query = "SELECT * FROM horas WHERE id_hora = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $hora = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$hora) {
            $_SESSION['error'] = 'Hora no encontrada';
            header("Location: " . URL . "index.php?c=Hora&a=index");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $horaValue = $_POST['hora'];

            $query = "UPDATE horas SET hora = :hora WHERE id_hora = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':hora', $horaValue);
            $stmt->bindParam(':id', $id);
            
            if ($stmt->execute()) {
                $_SESSION['mensaje'] = 'Hora actualizada exitosamente';
                header("Location: " . URL . "index.php?c=Hora&a=index");
                exit();
            } else {
                $_SESSION['error'] = 'Error al actualizar la hora';
            }
        }

        include 'app/views/horas/editar.php';
    }

    public function eliminar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 1) {
            header("Location: " . URL . "index.php");
            exit();
        }

        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            header("Location: " . URL . "index.php?c=Hora&a=index");
            exit();
        }

        $conexion = new Conexion();
        $db = $conexion->conectar();
        
        $id = (int)$id;
        $query = "DELETE FROM horas WHERE id_hora = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
            $_SESSION['mensaje'] = 'Hora eliminada exitosamente';
        } else {
            $_SESSION['error'] = 'Error al eliminar la hora';
        }

        header("Location: " . URL . "index.php?c=Hora&a=index");
        exit();
    }

    public function verificarDisponibilidad($horaInicio, $horaFin) {
        $conexion = new Conexion();
        $db = $conexion->conectar();

        $query = "SELECT COUNT(*) as total FROM reservas WHERE (hora_inicio < :horaFin AND hora_fin > :horaInicio)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':horaInicio', $horaInicio);
        $stmt->bindParam(':horaFin', $horaFin);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'] == 0;
    }
}
