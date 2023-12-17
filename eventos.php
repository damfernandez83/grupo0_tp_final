<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', '1');

include 'database.php';

class Eventos {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function agregarEvento($nombre, $fecha, $descripcion, $imagen) {
        $rutaImagen = $this->subirImagen($imagen);

        if (!$rutaImagen) {
            return false;
        }

        $consulta = "INSERT INTO eventos (nombre, ruta, fecha, descripcion) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->conectar()->prepare($consulta);
        $stmt->bind_param("ssss", $nombre, $rutaImagen, $fecha, $descripcion);

        $resultado = $stmt->execute();

        if (!$resultado) {
            die("Error en la consulta INSERT: " . $stmt->error);
        }

        $stmt->close();
        $this->db->cerrarConexion();

        return $resultado;
    }

    private function subirImagen($imagen) {
        if ($imagen['error'] === UPLOAD_ERR_OK) {
            $directorioDestino = __DIR__ . "/img/"; 
            $nombreArchivo = basename($imagen['name']);
            $rutaCompleta = $directorioDestino . $nombreArchivo;

            if (move_uploaded_file($imagen['tmp_name'], $rutaCompleta)) {
                return $rutaCompleta;
            } else {
                echo "Error al subir la imagen.";
                return false;
            }
        } else {
            echo "No se recibió ningún archivo o hubo un error en la subida.";
            return false;
        }
    }
}

$eventos = new Eventos();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nombreEvento"])) {
    $nombre = $_POST["nombreEvento"];
    $fecha = $_POST["fechaEvento"];
    $descripcion = $_POST["descripcionEvento"];
    $imagen = $_FILES["imagenEvento"];

    $resultado = $eventos->agregarEvento($nombre, $fecha, $descripcion, $imagen);

    if ($resultado) {
        echo json_encode(array('success' => true, 'message' => 'Evento agregado correctamente'));
    } else {
        echo json_encode(array('error' => 'Error al agregar el evento'));
    }
}
?>
