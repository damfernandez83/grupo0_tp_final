<?php
// Include the database connection file
require_once("dbConnection.php");

// Fetch data in descending order (latest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM eventos ORDER BY id DESC");
?>

<html>
<head>	
	<title>Eventos Dashboard</title>
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
