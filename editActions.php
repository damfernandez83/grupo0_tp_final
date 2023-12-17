<?php
require_once("dbConnection.php");

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombreEvento'];
    $fecha = $_POST['fechaEvento'];
    $descripcion = $_POST['descripcionEvento'];    

    $imagenEvento = $_FILES['imagenEvento'];
    $imagenNombre = $imagenEvento['name'];
    $imagenRutaTemp = $imagenEvento['tmp_name'];
    $imagenRutaDestino = './img/' . $imagenNombre;

    move_uploaded_file($imagenRutaTemp, $imagenRutaDestino);

    if (empty($nombre) || empty($fecha) || empty($descripcion)) {
        echo "<p><font color='red'>Por favor, complete todos los campos.</font></p>";
    } else {
        try {
            $database = new Database();
            $database->editarEvento($id, $nombre, $fecha, $descripcion);
            
            echo "<p><font color='green'>Evento actualizado sarpadamente bien!</font></p>";
            echo "<a href='tablaAdmin.php'>Ver Resultado</a>";
        } catch (Exception $e) {
            echo "<p><font color='red'>Error al actualizar el evento: " . $e->getMessage() . "</font></p>";
        }
    }
}
?>
