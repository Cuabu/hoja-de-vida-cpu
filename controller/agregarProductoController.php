<?php
include_once('../model/productoDAO.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $codigoEquipo = $_POST["CodigoEquipo"];
    $nombreSala = $_POST["NombreSala"];
    $nombreEquipo = $_POST["NombreEquipo"];
    $numeroEquipo = $_POST["NumeroEquipo"];
    $campus = $_POST["Campus"];
    $MemoriaRam = $_POST['MemoriaRam'];
    $marcaManufactura = $_POST["MarcaManufactura"];
    $tecladoMarcaModeloSerial = $_POST["TecladoMarcaModeloSerial"];
    $reguladorVoltajeSerial = $_POST["ReguladorVoltajeSerial"];
    $monitorMarcaModeloSerial = $_POST["MonitorMarcaModeloSerial"];
    $mouseMarcaModeloSerial = $_POST["MouseMarcaModeloSerial"];
    $cpuModeloSerial = $_POST["CPUModeloSerial"];
    $discoDuroModeloSerial = $_POST["DiscoDuroModeloSerial"];
    $macEthernetSerial = $_POST["MacEthernetSerial"];
    $macWIFISerial = $_POST["MacWIFISerial"];
    $observaciones = $_POST["Observaciones"];
    $responsableEquipo = $_POST["ResponsableEquipo"];
    $fechaIngreso = $_POST["FechaIngreso"];
    $velocidadHash = $_POST["VelocidadHash"];
    $descripcionProducto = $_POST["DescripcionProducto"];
    $historialMantenimientos = $_POST["HistorialMantenimientos"];
    $detallesReparacion = $_POST["DetallesReparacion"];

    $productoDAO = new ProductoDAO();

    if ($productoDAO->agregarProducto(
        $codigoEquipo,
        $nombreSala,
        $nombreEquipo,
        $numeroEquipo,
        $campus,
        $MemoriaRam,
        $marcaManufactura,
        $tecladoMarcaModeloSerial,
        $reguladorVoltajeSerial,
        $monitorMarcaModeloSerial,
        $mouseMarcaModeloSerial,
        $cpuModeloSerial,
        $discoDuroModeloSerial,
        $macEthernetSerial,
        $macWIFISerial,
        $observaciones,
        $responsableEquipo,
        $fechaIngreso,
        $velocidadHash,
        $descripcionProducto,
        $historialMantenimientos,
        $detallesReparacion
    )) {
        header("Location: ../administrador.php");
        exit();
    } else {
        echo "Error al agregar el producto.";
    }
}

?>
