<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE');
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

    public function mostrarEventos() {
        $consultaSelect = "SELECT * FROM eventos";
        $resultadoSelect = $this->db->ejecutarConsultaSimple($consultaSelect);

        if ($resultadoSelect) {
            while ($fila = $resultadoSelect->fetch_assoc()) {
                $id = $fila['id'];
                $nombre = $fila['nombre'];
                $ruta = $fila['ruta'];
                $fecha = $fila['fecha'];
                $descripcion = $fila['descripcion'];

                echo "ID: $id, Nombre: $nombre, Ruta: $ruta, Fecha: $fecha, Descripción: $descripcion<br>";
            }
        } else {
            echo "Error al ejecutar la consulta SELECT: " . $this->db->conectar()->error;
        }
    }
    public function editarEvento($id, $nombre, $fecha, $descripcion, $imagen) {
        $rutaImagen = $this->subirImagen($imagen);
    
        if (!$rutaImagen) {
            return false;
        }
    
        $consulta = "UPDATE eventos SET nombre = ?, ruta = ?, fecha = ?, descripcion = ? WHERE id = ?";
        $stmt = $this->db->conectar()->prepare($consulta);
        $stmt->bind_param("ssssi", $nombre, $rutaImagen, $fecha, $descripcion, $id);
    
        $resultado = $stmt->execute();
    
        if (!$resultado) {
            die("Error en la consulta UPDATE: " . $stmt->error);
        }
    
        $stmt->close();
        $this->db->cerrarConexion();
    
        return $resultado;
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
        echo "Evento agregado correctamente";
    } else {
        echo "Error al agregar el evento";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $_PUT);

    $idEvento = $_PUT['id'];
    $nombreEvento = $_PUT['nombreEvento'];
    $fechaEvento = $_PUT['fechaEvento'];
    $descripcionEvento = $_PUT['descripcionEvento'];

    error_log('Procesando solicitud PUT para editar el evento con ID: ' . $idEvento);

    try {
        $resultado = $eventos->editarEvento($idEvento, $nombreEvento, $fechaEvento, $descripcionEvento, $_FILES["imagenEvento"]);

        if ($resultado) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Evento editado correctamente']);
            exit;
        } else {
            header('Content-Type: application/json', true, 500);
            echo json_encode(['success' => false, 'message' => 'Error al editar el evento']);
            exit;
        }
    } catch (Exception $e) {
        error_log('Error al editar el evento: ' . $e->getMessage());
        header('Content-Type: application/json', true, 500);
        echo json_encode(['success' => false, 'message' => 'Error al editar el evento: ' . $e->getMessage()]);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $eventId = $_GET['id'];
    error_log('Procesando solicitud DELETE para el evento con ID: ' . $eventId);

    try {
        // Consulta para eliminar evento
        $database->eliminarEvento($eventId);

        // Respuesta simple para éxito
        http_response_code(200);
        echo 'Evento eliminado correctamente';
        exit;
    } catch (Exception $e) {
        // Respuesta simple para error
        error_log('Error al eliminar el evento: ' . $e->getMessage());
        http_response_code(500);
        echo 'Error al eliminar el evento: ' . $e->getMessage();
        exit;
    }
}

?>
