<?php
require_once("dbConnection.php");

$result = mysqli_query($database->conectar(), "SELECT * FROM eventos");
$events = mysqli_fetch_all($result, MYSQLI_ASSOC);

header('Content-Type: application/json');
echo json_encode($events);
?>
