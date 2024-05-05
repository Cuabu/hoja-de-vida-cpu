<?php
include_once('../model/productoDAO.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $codigoEquipo = $_POST["CodigoEquipo"];
    $fechaIngreso = $_POST["FechaIngreso"];
    $nombreEquipo = $_POST["NombreEquipo"];
    $responsableEquipo = $_POST["ResponsableEquipo"];
    $marcaManufactura = $_POST["MarcaManufactura"]; // Corregido aquí
    $tecladoMarcaModeloSerial = $_POST["TecladoMarcaModeloSerial"];
    $reguladorVoltajeSerial = $_POST["ReguladorVoltajeSerial"];
    $monitorMarcaModeloSerial = $_POST["MonitorMarcaModeloSerial"];
    $mouseMarcaModeloSerial = $_POST["MouseMarcaModeloSerial"];
    $cpuModeloSerial = $_POST["CPUModeloSerial"];
    $discoDuroModeloSerial = $_POST["DiscoDuroModeloSerial"];
    $macEthernetSerial = $_POST["MacEthernetSerial"];
    $macWIFISerial = $_POST["MacWIFISerial"];
    $velocidadHash = $_POST["VelocidadHash"];
    $descripcionProducto = $_POST["DescripcionProducto"];
    $historialMantenimientos = $_POST["HistorialMantenimientos"];

    $productoDAO = new ProductoDAO();

    if ($productoDAO->agregarProducto(
        $codigoEquipo,
        $fechaIngreso,
        $nombreEquipo,
        $responsableEquipo,
        $marcaManufactura,
        $tecladoMarcaModeloSerial,
        $reguladorVoltajeSerial,
        $monitorMarcaModeloSerial,
        $mouseMarcaModeloSerial,
        $cpuModeloSerial,
        $discoDuroModeloSerial,
        $macEthernetSerial,
        $macWIFISerial,
        $velocidadHash,
        $descripcionProducto,
        $historialMantenimientos
    )) {
        header("Location: ../administrador.php");
        exit();
    } else {
        echo "Error al agregar el producto.";
    }
}
?>
