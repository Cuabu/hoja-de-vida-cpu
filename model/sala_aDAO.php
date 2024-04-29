<?php
include_once('../config/conexion.php');

class salaDAO {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

public function obtenerSala() {
        $conn = $this->conexion->conectar();
        $sql = "SELECT * FROM sala_a";
        $query = mysqli_query($conn, $sql);
        $sala_a = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $sala_a[] = $row;
        }
        return $sala_a;
    }
}
