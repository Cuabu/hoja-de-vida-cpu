<?php

if (isset($_GET['NombreSala']) && !empty($_GET['NombreSala'])) {

    $nombreSala = $_GET['NombreSala'];

    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $database = "hvcpu";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "SELECT codigo_equipo, nombre_sala, nombre_equipo, numero_equipo, campus, memoria_ram, cpu_modelo_serial, disco_duro_modelo_serial, mac_ethernet_serial, mac_wifi_serial, bios_info, adapter_info, os_info, cpu_speed_info, memory_info_extended, disk_info_extended FROM auto_equipos WHERE nombre_sala = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombreSala);
    
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $filename = "EquiposEnSala_$nombreSala.xls";

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");

        echo "<table style='border-collapse: collapse; width: 100%;'>";
        echo "<thead>";
        echo "<tr style='background-color: #f2f2f2;'>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Codigo de Equipo</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Nombre de la Sala</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Nombre del Equipo</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Numero de Equipo</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Campus</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Memoria RAM</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>CPU Modelo Serial</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Disco Duro Modelo Serial</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>MAC Ethernet Serial</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>MAC WiFi Serial</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>BIOS Info</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Adapter Info</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>OS Info</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>CPU Speed Info</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Memory Info Extended</th>";
        echo "<th style='border: 1px solid #dddddd; padding: 8px;'>Disk Info Extended</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['codigo_equipo']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['nombre_sala']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['nombre_equipo']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['numero_equipo']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['campus']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['memoria_ram']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['cpu_modelo_serial']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['disco_duro_modelo_serial']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['mac_ethernet_serial']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['mac_wifi_serial']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['bios_info']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['adapter_info']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['os_info']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['cpu_speed_info']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['memory_info_extended']}</td>";
            echo "<td style='border: 1px solid #dddddd; padding: 8px;'>{$row['disk_info_extended']}</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No se encontraron resultados para la sala: $nombreSala";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Nombre de la sala no especificado.";
}
?>
