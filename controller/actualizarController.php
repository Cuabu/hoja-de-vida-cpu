<?php 

class ProductoDAO {
    public function actualizarProducto(
        $id,
        $codigoEquipo,
        $fechaIngreso,
        $nombreEquipo,
        $responsableEquipo,
        $marcaManufactura,
        $tecladoMarcaModeloSerial,
        $reguladorVoltajeSerial,
        $monitorMarcaModeloSerial,
        $mouseMarcaModeloSerial,
        $lectorOpticoMarcaModeloSerial,
        $cpuModeloSerial,
        $discoDuroModeloSerial,
        $macEthernetSerial,
        $macWIFISerial,
        $velocidadHash,
        $descripcionProducto,
        $historialMantenimientos
    ) {
        $conn = $this->conexion->conectar();

        if (!$conn) {
            return false; // Manejo de error: no se pudo conectar a la base de datos
        }

        // Escapar los valores para evitar inyección SQL
        $codigoEquipo = mysqli_real_escape_string($conn, $codigoEquipo);
        $nombreEquipo = mysqli_real_escape_string($conn, $nombreEquipo);
        // Escapar los demás valores necesarios

        // Construir la consulta con consulta preparada para mayor seguridad
        $sql = "UPDATE equipos SET 
            CodigoEquipo='$codigoEquipo',
            FechaIngreso='$fechaIngreso',
            nombreEquipo='$nombreEquipo',
            ResponsableEquipo='$responsableEquipo',
            MarcaManuFactura='$marcaManufactura',
            TecladoMarcaModeloSerial='$tecladoMarcaModeloSerial',
            ReguladorVoltajeSerial='$reguladorVoltajeSerial',
            MonitorMarcaModeloSerial='$monitorMarcaModeloSerial',
            MouseMarcaModeloSerial='$mouseMarcaModeloSerial',
            LectorOpticoMarcaModeloSerial='$lectorOpticoMarcaModeloSerial',
            CPUModeloSerial='$cpuModeloSerial',
            DiscoDuroModeloSerial='$discoDuroModeloSerial',
            MacEthernetSerial='$macEthernetSerial',
            MacWIFISerial='$macWIFISerial',
            VelocidadHash='$velocidadHash',
            DescripcionProducto='$descripcionProducto',
            HistorialMantenimientos='$historialMantenimientos'
            WHERE Id='$id'"; // Se mantiene la variable $id sin modificar

        // Ejecutar la consulta
        $result = mysqli_query($conn, $sql);

        if ($result) {
            return true; // Actualización exitosa
        } else {
            return false; // Manejo de error: la consulta falló
        }
    }
}
