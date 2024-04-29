<?php
include_once('../config/conexion.php');

class DispositivoDAO {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function agregarDispositivo($EquipoId, $MarcaSerial, $Observaciones) {
        $conn = $this->conexion->conectar();
        $sql = "INSERT INTO vbeam (EquipoId, MarcaSerial, Observaciones) VALUES ('$EquipoId', '$MarcaSerial', '$Observaciones')";
        return mysqli_query($conn, $sql);
    }

    
}
?>
