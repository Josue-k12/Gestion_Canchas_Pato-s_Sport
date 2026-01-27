<?php
require_once 'app/models/Encargado.php';

class EncargadoController {
    private $modelo;

    public function __construct() {
        // Verificamos si hay sesión iniciada (Seguridad)
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Opcional: Si quieres que solo administradores vean esto
        /*
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: " . URL . "index.php?c=Auth&a=login");
            exit;
        }
        */

        $this->modelo = new Encargado();
    }

    // Acción principal: Listar encargados
    public function index() {
        $encargados = $this->modelo->listar();
        
        // Esta ruta debe coincidir con tu carpeta de vistas
        include 'app/views/encargados/index.php';
    }

    // Acción para mostrar el formulario de registro
    public function nuevo() {
        include 'app/views/encargados/crear.php';
    }

    // Acción para guardar el registro en la DB
    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datos = [
                'nombre'   => trim($_POST['nombre']),
                'email'    => trim($_POST['email']),
                'password' => $_POST['password'],
                'telefono' => trim($_POST['telefono']),
                'rol_id'   => 2 // ID que corresponde al rol 'encargado' en tu DB
            ];

            if ($this->modelo->registrar($datos)) {
                header("Location: " . URL . "index.php?c=Encargado&a=index&success=1");
            } else {
                header("Location: " . URL . "index.php?c=Encargado&a=nuevo&error=1");
            }
        }
    }
    // Añade esto dentro de la clase EncargadoController
public function eliminar() {
    $id = $_GET['id'] ?? null;
    if ($id) {
        // Suponiendo que añades el método eliminar en el modelo
        if ($this->modelo->eliminar($id)) {
            header("Location: " . URL . "index.php?c=Encargado&a=index&deleted=1");
        }
    }
}
}