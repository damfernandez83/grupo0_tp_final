<?php
require_once("dbConnection.php");

$result = mysqli_query($mysqli, "SELECT * FROM eventos ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <h2>Eventos Dashboard</h2>
    <p>
        <a href="index.php">Volver al index</a>
    </p>
    <table width='80%' border=0>
        <tr bgcolor='#DDDDDD'>
            <td><strong>ID</strong></td>
            <td><strong>Nombre</strong></td>
            <td><strong>Fecha</strong></td>
            <td><strong>Descripción</strong></td>
            <td><strong>Acción</strong></td>
        </tr>
        <?php
        while ($res = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$res['id']."</td>";
            echo "<td>".$res['nombre']."</td>";
            echo "<td>".$res['fecha']."</td>";
            echo "<td>".$res['descripcion']."</td>";    
            echo "<td>
                <a href=\"edit.php?id=$res[id]\">Editar</a> | 
                <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('¿Estás seguro de que quieres eliminar este evento?')\">Eliminar</a>
            </td>";
        }
        ?>
    </table>
</body>

</html>
