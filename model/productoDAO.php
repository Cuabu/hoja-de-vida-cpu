<?php
include_once('../config/conexion.php');

class ProductoDAO {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function agregarProducto($codigoEquipo, $nombreSala, $nombreEquipo, $numeroEquipo, $campus, $marcaManufactura, $tecladoMarcaModeloSerial, $reguladorVoltajeSerial, $monitorMarcaModeloSerial, $mouseMarcaModeloSerial, $cpuModeloSerial, $discoDuroModeloSerial, $macEthernetSerial, $macWIFISerial, $observaciones, $responsableEquipo, $fechaIngreso, $velocidadHash, $descripcionProducto, $historialMantenimientos, $detallesReparacion) {
        $conn = $this->conexion->conectar();
        $sql = "INSERT INTO equipos (CodigoEquipo, NombreSala, NombreEquipo, NumeroEquipo, Campus, MarcaManufactura, TecladoMarcaModeloSerial, ReguladorVoltajeSerial, MonitorMarcaModeloSerial, MouseMarcaModeloSerial, CPUModeloSerial, DiscoDuroModeloSerial, MacEthernetSerial, MacWIFISerial, Observaciones, ResponsableEquipo, FechaIngreso, VelocidadHash, DescripcionProducto, HistorialMantenimientos, DetallesReparacion) VALUES ('$codigoEquipo', '$nombreSala', '$nombreEquipo', '$numeroEquipo', '$campus', '$marcaManufactura', '$tecladoMarcaModeloSerial', '$reguladorVoltajeSerial', '$monitorMarcaModeloSerial', '$mouseMarcaModeloSerial', '$cpuModeloSerial', '$discoDuroModeloSerial', '$macEthernetSerial', '$macWIFISerial', '$observaciones', '$responsableEquipo', '$fechaIngreso', '$velocidadHash', '$descripcionProducto', '$historialMantenimientos', '$detallesReparacion')";
        return mysqli_query($conn, $sql);
    }
    
    public function modificarProducto($id, $codigoEquipo, $nombreSala, $nombreEquipo, $numeroEquipo, $campus, $marcaManufactura, $tecladoMarcaModeloSerial, $reguladorVoltajeSerial, $monitorMarcaModeloSerial, $mouseMarcaModeloSerial, $cpuModeloSerial, $discoDuroModeloSerial, $macEthernetSerial, $macWIFISerial, $observaciones, $responsableEquipo, $fechaIngreso, $velocidadHash, $descripcionProducto, $historialMantenimientos, $detallesReparacion) {
        $conn = $this->conexion->conectar();
        $sql = "UPDATE equipos SET CodigoEquipo='$codigoEquipo', NombreSala='$nombreSala', NombreEquipo='$nombreEquipo', NumeroEquipo='$numeroEquipo', Campus='$campus', MarcaManufactura='$marcaManufactura', TecladoMarcaModeloSerial='$tecladoMarcaModeloSerial', ReguladorVoltajeSerial='$reguladorVoltajeSerial', MonitorMarcaModeloSerial='$monitorMarcaModeloSerial', MouseMarcaModeloSerial='$mouseMarcaModeloSerial', CPUModeloSerial='$cpuModeloSerial', DiscoDuroModeloSerial='$discoDuroModeloSerial', MacEthernetSerial='$macEthernetSerial', MacWIFISerial='$macWIFISerial', Observaciones='$observaciones', ResponsableEquipo='$responsableEquipo', FechaIngreso='$fechaIngreso', VelocidadHash='$velocidadHash', DescripcionProducto='$descripcionProducto', HistorialMantenimientos='$historialMantenimientos', DetallesReparacion='$detallesReparacion' WHERE Id=$id";
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

    public function eliminarProducto($Id) {
        $conn = $this->conexion->conectar();
        $sql = "DELETE FROM equipos WHERE Id=$Id";
        return mysqli_query($conn, $sql);
    }
}
?>
