<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar las credenciales
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Crear una instancia de la clase Database
    $db = new Database();

    // Comparar con credenciales en la base de datos
    $consulta = "SELECT * FROM usuarios WHERE usuario = '$username' AND contrasena = '$password'";

    // Ejecutar la consulta
    $resultado = $db->ejecutarConsultaSimple($consulta);

    // Verificar si hay filas
    if ($resultado->num_rows > 0) {
        // Autenticación exitosa

        // Obtener el rol del usuario
        $usuario = $resultado->fetch_assoc();
        $rolUsuario = $usuario['rol'];

        // Iniciar sesión y almacenar el rol
        session_start();
        $_SESSION['rolUsuario'] = $rolUsuario;

        // Redireccionar a la página principal
        header("Location: http://localhost:8000/index.php");
        exit();
    } else {
        // Autenticación fallida
        echo "Usuario o contraseña incorrectos";
    }
} else {
    // Redireccionar si se intenta acceder directamente a este archivo
    header("Location: http://localhost:8000/index.php");
    exit();
}
?>
<?php
// Después de verificar las credenciales y antes de redirigir
$_SESSION['rolUsuario'] = $elRolDelUsuario; // Reemplaza con la variable que almacena el rol del usuario
// Redirigir a la página principal
header('Location: index.php');
?>