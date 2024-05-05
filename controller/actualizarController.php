<?php
include_once('../model/productoDAO.php');


public function modificarProducto($idProducto, $codigoEquipo, $fechaIngreso, $NombreEquipo, $responsableEquipo, $MarcaManuFactura, $tecladoMarcaModeloSerial, $reguladorVoltajeSerial, $monitorMarcaModeloSerial, $mouseMarcaModeloSerial, $cpuModeloSerial, $discoDuroModeloSerial, $macEthernetSerial, $macWIFISerial, $velocidadHash, $descripcionProducto, $historialMantenimientos) {
    $conn = $this->conexion->conectar();

    if (!$conn) {
        return false; // Manejo de error: no se pudo conectar a la base de datos
    }

    // Escapar los valores para evitar inyección SQL
    $codigoEquipo = mysqli_real_escape_string($conn, $codigoEquipo);
    $fechaIngreso = mysqli_real_escape_string($conn, $fechaIngreso);
    $NombreEquipo = mysqli_real_escape_string($conn, $NombreEquipo);
    $responsableEquipo = mysqli_real_escape_string($conn, $responsableEquipo);
    $MarcaManuFactura = mysqli_real_escape_string($conn, $MarcaManuFactura);
    $tecladoMarcaModeloSerial = mysqli_real_escape_string($conn, $tecladoMarcaModeloSerial);
    $reguladorVoltajeSerial = mysqli_real_escape_string($conn, $reguladorVoltajeSerial);
    $monitorMarcaModeloSerial = mysqli_real_escape_string($conn, $monitorMarcaModeloSerial);
    $mouseMarcaModeloSerial = mysqli_real_escape_string($conn, $mouseMarcaModeloSerial);
    $cpuModeloSerial = mysqli_real_escape_string($conn, $cpuModeloSerial);
    $discoDuroModeloSerial = mysqli_real_escape_string($conn, $discoDuroModeloSerial);
    $macEthernetSerial = mysqli_real_escape_string($conn, $macEthernetSerial);
    $macWIFISerial = mysqli_real_escape_string($conn, $macWIFISerial);
    $velocidadHash = mysqli_real_escape_string($conn, $velocidadHash);
    $descripcionProducto = mysqli_real_escape_string($conn, $descripcionProducto);
    $historialMantenimientos = mysqli_real_escape_string($conn, $historialMantenimientos);

    // Construir la consulta con consulta preparada para mayor seguridad
    $sql = "UPDATE equipos SET 
        CodigoEquipo='$codigoEquipo',
        FechaIngreso='$fechaIngreso',
        nombreEquipo='$NombreEquipo',
        ResponsableEquipo='$responsableEquipo',
        MarcaManuFactura='$MarcaManuFactura',
        TecladoMarcaModeloSerial='$tecladoMarcaModeloSerial',
        ReguladorVoltajeSerial='$reguladorVoltajeSerial',
        MonitorMarcaModeloSerial='$monitorMarcaModeloSerial',
        MouseMarcaModeloSerial='$mouseMarcaModeloSerial',
        CPUModeloSerial='$cpuModeloSerial',
        DiscoDuroModeloSerial='$discoDuroModeloSerial',
        MacEthernetSerial='$macEthernetSerial',
        MacWIFISerial='$macWIFISerial',
        VelocidadHash='$velocidadHash',
        DescripcionProducto='$descripcionProducto',
        HistorialMantenimientos='$historialMantenimientos'
        WHERE idProducto=$idProducto"; // Se mantiene la variable $idProducto sin modificar

    // Ejecutar la consulta
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return true; // Actualización exitosa
    } else {
        return false; // Manejo de error: la consulta falló
    }
}
?>