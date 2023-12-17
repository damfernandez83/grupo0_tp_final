<?php
$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$databaseName = 'proyectofinal';
$databasePort = 3307;

$mysqli = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName, $databasePort);

if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

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

    public function editarEvento($eventId, $nombreEvento, $fechaEvento, $descripcionEvento) {
        $consultaEditar = "UPDATE eventos SET nombre = ?, fecha = ?, descripcion = ? WHERE id = ?";
        $stmt = $this->conectar()->prepare($consultaEditar);
        $stmt->bind_param("sssi", $nombreEvento, $fechaEvento, $descripcionEvento, $eventId);

        $resultado = $stmt->execute();

        if (!$resultado) {
            die("Error en la consulta UPDATE: " . $stmt->error);
        }

        $stmt->close();
        $this->cerrarConexion();

        return $resultado;
    }
    public function eliminarEvento($eventId) {
        $consulta = "DELETE FROM eventos WHERE id = ?";
        $stmt = $this->conectar()->prepare($consulta);
        $stmt->bind_param("i", $eventId);

        $resultado = $stmt->execute();

        if (!$resultado) {
            die("Error en la consulta DELETE: " . $stmt->error);
        }

        $stmt->close();
        $this->cerrarConexion();

        return $resultado;
    }

    public function cerrarConexion() {
        $this->conexion->close();
    }
}

$database = new Database();
$conexion = $database->conectar();

?>
