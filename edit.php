<?php
require_once("dbConnection.php");

$id = $_GET['id'];

echo "ID: " . $id;

$result = mysqli_query($mysqli, "SELECT * FROM eventos WHERE id = $id");

$resultData = mysqli_fetch_assoc($result);

$nombre = $resultData['nombre'];
$fecha = $resultData['fecha'];
$descripcion = $resultData['descripcion'];
?>
<html>
<head>    
    <title>Editar Evento</title>
</head>

<body>
    <h2>Editar Evento</h2>
    <p>
        <a href="index.php">Inicio</a>
    </p>
    
    <form name="edit" method="post" action="editActions.php" enctype="multipart/form-data">
        <table border="0">
            <tr> 
                <td>Nombre</td>
                <td><input type="text" name="nombreEvento" value="<?php echo $nombre; ?>"></td>
            </tr>
            <tr> 
                <td>Fecha</td>
                <td><input type="text" name="fechaEvento" value="<?php echo $fecha; ?>"></td>
            </tr>
            <tr> 
                <td>Descripción</td>
                <td><input type="text" name="descripcionEvento" value="<?php echo $descripcion; ?>"></td>
            </tr>
            <tr>
                <td>Imagen</td>
                <td><input type="file" name="imagenEvento"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
                <td><input type="submit" name="update" value="ActualizeiSHIOM"></td>
            </tr>
        </table>
    </form>
</body>
</html>
