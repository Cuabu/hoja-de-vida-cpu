<?php

class Conexion {
    public $conexion;

    public function __construct() {
        $host = "localhost";
        $user = "root";
        $pass = "114412345@";
        $bd = "hvcpu";

        // Crear conexión
        $this->conexion = new mysqli($host, $user, $pass, $bd);

        // Verificar la conexión
        if ($this->conexion->connect_error) {
            die("Error al conectar a la base de datos: " . $this->conexion->connect_error);
        }
    }

    public function conectar() {
        return $this->conexion;
    }

    public function desconectar() {
        $this->conexion->close();
    }
}
?>
