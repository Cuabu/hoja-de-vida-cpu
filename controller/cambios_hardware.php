<?php

// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "hvcpu";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los cambios de hardware y detalles del equipo
$sqlCambiosHardware = "
    SELECT ae.nombre_equipo, ae.nombre_sala, ae.campus, ae.memoria_ram, ae.cpu_modelo_serial,
           ae.disco_duro_modelo_serial, ch.componente, ch.cambio, ch.fecha
    FROM cambios_hardware ch
    JOIN auto_equipos ae ON ch.codigo_equipo = ae.codigo_equipo
";
$resultCambiosHardware = $conn->query($sqlCambiosHardware);

// Nombre del archivo para la descarga
$filenameCambiosHardware = "cambios_hardware.xls";
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filenameCambiosHardware\"");

// Definir encabezados de la tabla
$headersCambiosHardware = [
    "Nombre del Equipo",
    "Sala",
    "Campus",
    "Memoria RAM",
    "CPU Modelo y Serial",
    "Disco Duro Modelo y Serial",
    "Componente",
    "Cambio",
    "Fecha del Cambio"
];

// Función para generar la tabla en HTML
function generateTable($result, $headers)
{
    if ($result->num_rows > 0) {
        echo "<table style='border-collapse: collapse; width: 100%;'>";
        echo "<thead><tr style='background-color: #f2f2f2;'>";

        // Encabezados de la tabla
        foreach ($headers as $header) {
            echo "<th style='border: 1px solid #dddddd; padding: 8px;'>$header</th>";
        }

        echo "</tr></thead><tbody>";

        // Mostrar datos
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $data) {
                echo "<td style='border: 1px solid #dddddd; padding: 8px;'>$data</td>";
            }
            echo "</tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "No se encontraron resultados.";
    }
}

// Generar tabla de cambios de hardware
generateTable($resultCambiosHardware, $headersCambiosHardware);

// Cerrar conexión
$conn->close();
