<?php
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

    // Método para cerrar la conexión
    private function cerrarConexion() {
        $this->conexion->close();
    }
}

$database = new Database();
$conexion = $database->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreEvento = $_POST['nombreEvento'];
    $fechaEvento = $_POST['fechaEvento'];
    $descripcionEvento = $_POST['descripcionEvento'];

    // Procesar la imagen y guardarla en la carpeta 'img'
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
