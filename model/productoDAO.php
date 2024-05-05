<?php
include_once('../config/conexion.php');

class ProductoDAO {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function agregarProducto($codigoEquipo, $fechaIngreso, $NombreEquipo, $responsableEquipo, $MarcaManuFactura, $tecladoMarcaModeloSerial, $reguladorVoltajeSerial, $monitorMarcaModeloSerial, $mouseMarcaModeloSerial, $cpuModeloSerial, $discoDuroModeloSerial, $macEthernetSerial, $macWIFISerial, $velocidadHash, $descripcionProducto, $historialMantenimientos) {
        $conn = $this->conexion->conectar();
        $sql = "INSERT INTO equipos (CodigoEquipo, FechaIngreso, nombreEquipo, ResponsableEquipo, MarcaManuFactura, TecladoMarcaModeloSerial, ReguladorVoltajeSerial, MonitorMarcaModeloSerial, MouseMarcaModeloSerial, CPUModeloSerial, DiscoDuroModeloSerial, MacEthernetSerial, MacWIFISerial, VelocidadHash, DescripcionProducto, HistorialMantenimientos) VALUES ('$codigoEquipo', '$fechaIngreso', '$NombreEquipo', '$responsableEquipo', '$MarcaManuFactura', '$tecladoMarcaModeloSerial', '$reguladorVoltajeSerial', '$monitorMarcaModeloSerial', '$mouseMarcaModeloSerial', '$cpuModeloSerial', '$discoDuroModeloSerial', '$macEthernetSerial', '$macWIFISerial', '$velocidadHash', '$descripcionProducto', '$historialMantenimientos')";
        return mysqli_query($conn, $sql);
    }
     

    public function modificarProducto($idProducto, $codigoEquipo, $fechaIngreso, $NombreEquipo, $responsableEquipo, $MarcaManuFactura, $tecladoMarcaModeloSerial, $reguladorVoltajeSerial, $monitorMarcaModeloSerial, $mouseMarcaModeloSerial, $cpuModeloSerial, $discoDuroModeloSerial, $macEthernetSerial, $macWIFISerial, $velocidadHash, $descripcionProducto, $historialMantenimientos) {
        $conn = $this->conexion->conectar();
        $sql = "UPDATE equipos SET CodigoEquipo='$codigoEquipo', FechaIngreso='$fechaIngreso', nombreEquipo='$NombreEquipo', ResponsableEquipo='$responsableEquipo', MarcaManuFactura='$MarcaManuFactura', TecladoMarcaModeloSerial='$tecladoMarcaModeloSerial', ReguladorVoltajeSerial='$reguladorVoltajeSerial', MonitorMarcaModeloSerial='$monitorMarcaModeloSerial', MouseMarcaModeloSerial='$mouseMarcaModeloSerial', CPUModeloSerial='$cpuModeloSerial', DiscoDuroModeloSerial='$discoDuroModeloSerial', MacEthernetSerial='$macEthernetSerial', MacWIFISerial='$macWIFISerial', VelocidadHash='$velocidadHash', DescripcionProducto='$descripcionProducto', HistorialMantenimientos='$historialMantenimientos' WHERE idProducto=$idProducto";
        return mysqli_query($conn, $sql);
    }
    

    public function obtenerProductos() {
        $conn = $this->conexion->conectar();
        $sql = "SELECT * FROM equipos";
        $query = mysqli_query($conn, $sql);
        $equipos = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $equipos[] = $row;
        }
        return $equipos;
    }

    public function eliminarProducto($id) {
        $conn = $this->conexion->conectar();
        $sql = "DELETE FROM equipos WHERE Id=$id";
        return mysqli_query($conn, $sql);
    }
}
?>
