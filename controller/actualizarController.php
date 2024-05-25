<?php
include_once('../model/productoDAO.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe los datos del formulario
    $Id = $_POST['Id'];
    $codigoEquipo = $_POST['CodigoEquipo'];
    $NombreSala = $_POST['NombreSala'];
    $NombreEquipo = $_POST['NombreEquipo'];
    $NumeroEquipo = $_POST['NumeroEquipo'];
    $Campus = $_POST['Campus'];
    $MemoriaRam = $_POST['MemoriaRam'];
    $MarcaManufactura = $_POST['MarcaManufactura'];
    $tecladoMarcaModeloSerial = $_POST['TecladoMarcaModeloSerial'];
    $reguladorVoltajeSerial = $_POST['ReguladorVoltajeSerial'];
    $monitorMarcaModeloSerial = $_POST['MonitorMarcaModeloSerial'];
    $mouseMarcaModeloSerial = $_POST['MouseMarcaModeloSerial'];
    $cpuModeloSerial = $_POST['CPUModeloSerial'];
    $discoDuroModeloSerial = $_POST['DiscoDuroModeloSerial'];
    $macEthernetSerial = $_POST['MacEthernetSerial'];
    $macWIFISerial = $_POST['MacWIFISerial'];
    $Observaciones = $_POST['Observaciones'];
    $responsableEquipo = $_POST['ResponsableEquipo'];
    $fechaIngreso = $_POST['FechaIngreso'];
    $velocidadHash = $_POST['VelocidadHash'];
    $descripcionProducto = $_POST['DescripcionProducto'];
    $historialMantenimientos = $_POST['HistorialMantenimientos'];
    $DetallesReparacion = $_POST['DetallesReparacion'];

    // Instancia de la clase DAO
    $productoDAO = new ProductoDAO();

    // Llama al método para modificar el producto
    $resultado = $productoDAO->modificarProducto($Id, $codigoEquipo, $NombreSala, $NombreEquipo, $NumeroEquipo, $Campus, $MemoriaRam, $MarcaManufactura, $tecladoMarcaModeloSerial, $reguladorVoltajeSerial, $monitorMarcaModeloSerial, $mouseMarcaModeloSerial, $cpuModeloSerial, $discoDuroModeloSerial, $macEthernetSerial, $macWIFISerial, $Observaciones, $responsableEquipo, $fechaIngreso, $velocidadHash, $descripcionProducto, $historialMantenimientos, $DetallesReparacion);

    if ($resultado) {
        // Éxito: redirige o muestra mensaje de éxito
        echo "¡Producto modificado correctamente!";
        header("Location: ../administrador.php");
        exit();
    } else {
        // Error: redirige o muestra mensaje de error
        echo "Hubo un error al modificar el producto.";
    }
}
?>
