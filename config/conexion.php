<?php

class Conexion {
    public $conexion;

    public function __construct() {
        $host = "localhost";
        $user = "root";
        $pass = "114412345@";
        $bd = "hvcpu";

        $this->conexion = new mysqli($host, $user, $pass, $bd);

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