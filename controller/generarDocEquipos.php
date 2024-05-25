<?php

// Variables de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "114412345@";
$database = "hvcpu";

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener los datos de la tabla equipos
$sql = "SELECT Id, CodigoEquipo, FechaIngreso, NombreEquipo, ResponsableEquipo, MarcaManufactura, TecladoMarcaModeloSerial, ReguladorVoltajeSerial, MonitorMarcaModeloSerial, MouseMarcaModeloSerial, CPUModeloSerial, DiscoDuroModeloSerial, MacEthernetSerial, MacWIFISerial, VelocidadHash, DescripcionProducto, HistorialMantenimientos FROM equipos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Crear un archivo Excel
    $filename = "equipos.xls";

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");

    // Comienza la tabla en HTML
    echo "<table style='border-collapse: collapse; width: 100%;'>";
    echo "<thead>";
    echo "<tr style='background-color: #f2f2f2;'>";
    echo "<th style='border: 1px solid #dddddd; padding: 8px;'>ID</th>";
    echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Código de Equipo</th>";
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
    echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Características de Dirección Mac Eth0</th>";
    echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Características de la Dirección Mac WiFi</th>";
    echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Cálculo de Hash</th>";
    echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Descripción General</th>";
    echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Historial de Mantenimientos</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Mostrar datos de la tabla equipos en la tabla HTML
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
    echo "<tfoot>";
    echo "<tr>";
    echo "<td colspan='17' style='border: 1px solid #dddddd; padding: 8px; text-align: right;'><strong>Total General</strong></td>";
    echo "<td style='border: 1px solid #dddddd; padding: 8px;'>$totalGeneral</td>"; // Aquí se necesita definir $totalGeneral
    echo "</tr>";
    echo "</tfoot>";
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
