<?php
require_once("dbConnection.php");

// Intentar establecer la conexión con la base de datos
$conexion = $database->conectar();

if (!$conexion) {
    // Si no se puede establecer la conexión, devolver un error
    header('HTTP/1.1 500 Internal Server Error');
    die('Error al conectar con la base de datos');
}

$resultado = mysqli_query($conexion, "SELECT * FROM eventos");

if (!$resultado) {
    header('HTTP/1.1 500 Internal Server Error');
    die('Error al realizar la consulta a la base de datos: ' . mysqli_error($conexion));
}

$eventos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
mysqli_free_result($resultado);
mysqli_close($conexion);

header('Content-Type: application/json');

echo json_encode($eventos);
?>
