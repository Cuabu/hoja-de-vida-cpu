<?php

if (isset($_GET['NombreEquipo']) && !empty($_GET['NombreEquipo'])) {
    $nombreEquipo = $_GET['NombreEquipo'];

    $servername = "localhost";
    $username = "root";
    $password = "114412345@";
    $database = "hvcpu";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "SELECT Id, CodigoEquipo, FechaIngreso, NombreEquipo, ResponsableEquipo, MarcaManufactura, TecladoMarcaModeloSerial, ReguladorVoltajeSerial, MonitorMarcaModeloSerial, MouseMarcaModeloSerial, CPUModeloSerial, DiscoDuroModeloSerial, MacEthernetSerial, MacWIFISerial, VelocidadHash, DescripcionProducto, HistorialMantenimientos FROM equipos WHERE NombreEquipo = '$nombreEquipo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $filename = "NombreEquipos.xls";

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");

        echo "<table style='border-collapse: collapse; width: 100%;'>";
        echo "<thead>";
        echo "<tr style='background-color: #f2f2f2;'>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>ID</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Codigo de Equipo</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Fecha de Ingreso</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Nombre del Equipo</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Responsable de Equipo</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Marca de Manufactura</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Marca o Serial de Teclado</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Marca o Serial del Regulador</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Marca o Serial del Monitor</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Marca o Serial del Mouse</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Marca o Serial de Unidad Procesamiento</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Marca o Serial de Unidad SSD</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Características de Direccion Mac Eth0</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Características de la Direccion Mac WiFi</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Calculo de Hash</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Descripción General</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Historial de Mantenimientos</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['Id']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['CodigoEquipo']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['FechaIngreso']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['NombreEquipo']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['ResponsableEquipo']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['MarcaManufactura']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['TecladoMarcaModeloSerial']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['ReguladorVoltajeSerial']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['MonitorMarcaModeloSerial']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['MouseMarcaModeloSerial']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['CPUModeloSerial']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['DiscoDuroModeloSerial']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['MacEthernetSerial']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['MacWIFISerial']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['VelocidadHash']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['DescripcionProducto']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['HistorialMantenimientos']}</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No se encontraron resultados para el equipo con nombre: $nombreEquipo";
    }

    $conn->close();
} else {
    echo "Nombre del equipo no especificado.";
}
?>
