<?php
require_once("dbConnection.php");

$id = $_GET['id'];

try {
    $database->eliminarEvento($id);
    header("Location: tablaAdmin.php");
    exit;
} catch (Exception $e) {
    error_log('Error al eliminar el evento: ' . $e->getMessage());
    header('Content-Type: application/json', true, 500);
    echo json_encode(['success' => false, 'message' => 'Error al eliminar el evento: ' . $e->getMessage()]);
    exit;
}
?>
