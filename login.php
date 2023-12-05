<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar las credenciales
    $username = $_POST["username"];
    $password = $_POST["password"];
    $rol = $_POST["rol"]; // Agregamos el campo de rol

    // Incluir la clase de base de datos
    include 'database.php';

    // Crear una instancia de la clase Database
    $db = new Database();

    // Comparar con credenciales y rol en la base de datos
    $consulta = "SELECT * FROM usuarios WHERE usuario = ? AND contrasena = ? AND rol = ?";

    // Preparar la consulta
    $stmt = $db->conectar()->prepare($consulta);

    // Vincular parámetros
    $stmt->bind_param("sss", $username, $password, $rol);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener resultados
    $resultado = $stmt->get_result();

    // Verificar si hay filas
    if ($resultado->num_rows > 0) {
        // Autenticación exitosa
        echo "Login exitoso";
    } else {
        // Autenticación fallida
        echo "Usuario o contraseña incorrectos";
    }

    // Cerrar la conexión
    $stmt->close();
    $db->cerrarConexion();
} else {
    // Redireccionar si se intenta acceder directamente a este archivo
    header("Location: index.html");
    exit();
}
?>
