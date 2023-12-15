<?php
// Agregar encabezados CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
class Database {
    private $host = "localhost";
    private $usuario = "root";
    private $contrasena = ""; 
    private $nombreBaseDatos = "proyectofinal";
    private $puerto = 3307; 
    private $conexion;

    public function conectar() {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->contrasena, $this->nombreBaseDatos, $this->puerto);

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }

        return $this->conexion;
    }

    // Método para ejecutar consultas sin necesidad de prepararlas
    public function ejecutarConsultaSimple($consulta) {
        $this->conectar();
        
        $resultado = $this->conexion->query($consulta);

        if (!$resultado) {
            die("Error en la consulta: " . $this->conexion->error);
        }

        $this->cerrarConexion();

        return $resultado;
    }

    public function eliminarEvento($nombreEvento) {
        $consulta = "DELETE FROM eventos WHERE nombre = ?";
        $stmt = $this->conectar()->prepare($consulta);
        $stmt->bind_param("s", $nombreEvento);

        $resultado = $stmt->execute();

        if (!$resultado) {
            die("Error en la consulta DELETE: " . $stmt->error);
        }

        $stmt->close();
        $this->cerrarConexion();

        return $resultado;
    }

    public function editarEvento($eventId, $nombreEvento, $fechaEvento, $descripcionEvento) {
        $consultaEditar = "UPDATE eventos SET nombre = '$nombreEvento', fecha = '$fechaEvento', descripcion = '$descripcionEvento' WHERE id = '$eventId'";
        $this->ejecutarConsultaSimple($consultaEditar);
    }
        // Método para cerrar la conexión
        private function cerrarConexion() {
            $this->conexion->close();
        }
}

$database = new Database();
$conexion = $database->conectar();

// Manejar solicitud de eliminación
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $eventId = $_GET['id'];
    error_log('Procesando solicitud DELETE para el evento con ID: ' . $eventId);

    try {
        // Consulta para eliminar evento
        $database->eliminarEvento($eventId);

        // Respuesta JSON para éxito
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Evento eliminado correctamente']);
        exit;
    } catch (Exception $e) {
        // Respuesta JSON para error
        error_log('Error al eliminar el evento: ' . $e->getMessage());
        header('Content-Type: application/json', true, 500);  
        echo json_encode(['success' => false, 'message' => 'Error al eliminar el evento: ' . $e->getMessage()]);
        exit;
    }
}

// Manejar solicitud de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editarEvento'])) {
    $eventId = $_POST['editarEvento'];
    $nombreEvento = $_POST['nombreEvento'];
    $fechaEvento = $_POST['fechaEvento'];
    $descripcionEvento = $_POST['descripcionEvento'];

    error_log('Procesando solicitud POST para editar evento');

    try {
        // Consulta para editar evento
        $database->editarEvento($eventId, $nombreEvento, $fechaEvento, $descripcionEvento);

        // Respuesta JSON para éxito
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Evento editado correctamente']);
        exit;
    } catch (Exception $e) {
        // Respuesta JSON para error
        error_log('Error al editar el evento: ' . $e->getMessage());
        header('Content-Type: application/json', true, 500);
        echo json_encode(['success' => false, 'message' => 'Error al editar el evento: ' . $e->getMessage()]);
        exit;
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreEvento = $_POST['nombreEvento'];
    $fechaEvento = $_POST['fechaEvento'];
    $descripcionEvento = $_POST['descripcionEvento'];

    $imagenEvento = $_FILES['imagenEvento'];
    $imagenNombre = $imagenEvento['name'];
    $imagenRutaTemp = $imagenEvento['tmp_name'];
    $imagenRutaDestino = './img/' . $imagenNombre;

    move_uploaded_file($imagenRutaTemp, $imagenRutaDestino);

    $consultaInsertar = "INSERT INTO eventos (nombre, fecha, descripcion, imagen) VALUES ('$nombreEvento', '$fechaEvento', '$descripcionEvento', '$imagenNombre')";
    $database->ejecutarConsultaSimple($consultaInsertar);
    $respuesta = array('success' => true, 'imagen' => $imagenNombre);
    echo json_encode($respuesta);
    exit;
}
?>
