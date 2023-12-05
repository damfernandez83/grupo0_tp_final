<?php
class Database {
    // Aca tienen que poner los valores correspondientes a sus credenciales
    // obviamente va a variar depedneindo de cada uno y como no es a un servidor en comun
    // lo dejo asi para que se entienda
    private $host = "tu_host";
    private $usuario = "tu_usuario";
    private $contrasena = "tu_contrasena";
    private $nombreBaseDatos = "tu_base_de_datos";
    private $conexion;

    // Aca creamos el metodo para conectar a la base de datos
    public function conectar() {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->contrasena, $this->nombreBaseDatos);

        // Verificamos la conexión
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    // Metodo donde ejecutamos las consultas
    public function ejecutarConsulta($consulta) {
        $this->conectar();
        
        // Aca se ejecuta
        $resultado = $this->conexion->query($consulta);

        // Manejar errores por si la consulta falla
        if (!$resultado) {
            die("Error en la consulta: " . $this->conexion->error);
        }

        // Y aca cerrar la conexión
        $this->cerrarConexion();

        return $resultado;
    }

    // Método para cerrar la conexión
    private function cerrarConexion() {
        $this->conexion->close();
    }
}

// Ejemplo de uso:
// $db = new Database();
// $consulta = "INSERT INTO presupuestos (nombre, email, telefono, mensaje) VALUES ('Ejemplo', 'ejemplo@example.com', '123456789', 'Consulta de presupuesto')";
// $resultado = $db->ejecutarConsulta($consulta);
?>
