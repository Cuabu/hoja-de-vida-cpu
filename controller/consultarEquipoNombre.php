<?php
// Verificar si se ha enviado el formulario y el ID del equipo está presente
if (isset($_POST['CodigoEquipo']) && !empty($_POST['CodigoEquipo'])) {
    // Obtener el ID del equipo desde el formulario
    $codigoEquipo = $_POST['CodigoEquipo'];

    // Conectar a la base de datos (reemplaza los valores según tu configuración)
    $servername = "localhost";
    $username = "root";
    $password = "114412345@";
    $dbname = "hvcpu";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Consulta SQL para obtener los datos del equipo por ID
    $sql = "SELECT * FROM equipos WHERE CodigoEquipo = '$codigoEquipo'";

    // Ejecutar la consulta
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mostrar los datos del equipo
        echo "<table>";
        echo "<tr><th>ID</th><th>Código de Equipo</th><th>Fecha de Ingreso</th><th>Nombre del Equipo</th><th>Responsable de Equipo</th><th>Marca de Manufactura</th><th>Marca o Serial de Teclado</th><th>Marca o Serial del Regulador</th><th>Marca o Serial del Monitor</th><th>Marca o Serial del Mouse</th><th>Marca o Serial de Unidad DVD</th><th>Marca o Serial de Unidad Procesamiento</th><th>Marca o Serial de Unidad SSD</th><th>Características de Dirección Mac Eth0</th><th>Características de la Dirección Mac WiFi</th><th>Cálculo de Hash</th><th>Descripción General</th><th>Historial de Mantenimientos</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["Id"]."</td>";
            echo "<td>".$row["CodigoEquipo"]."</td>";
            echo "<td>".$row["FechaIngreso"]."</td>";
            echo "<td>".$row["NombreEquipo"]."</td>";
            echo "<td>".$row["ResponsableEquipo"]."</td>";
            echo "<td>".$row["MarcaManufactura"]."</td>";
            echo "<td>".$row["TecladoMarcaModeloSerial"]."</td>";
            echo "<td>".$row["ReguladorVoltajeSerial"]."</td>";
            echo "<td>".$row["MonitorMarcaModeloSerial"]."</td>";
            echo "<td>".$row["MouseMarcaModeloSerial"]."</td>";
            echo "<td>".$row["LectorOpticoMarcaModeloSerial"]."</td>";
            echo "<td>".$row["CPUModeloSerial"]."</td>";
            echo "<td>".$row["DiscoDuroModeloSerial"]."</td>";
            echo "<td>".$row["MacEthernetSerial"]."</td>";
            echo "<td>".$row["MacWIFISerial"]."</td>";
            echo "<td>".$row["VelocidadHash"]."</td>";
            echo "<td>".$row["DescripcionProducto"]."</td>";
            echo "<td>".$row["HistorialMantenimientos"]."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron resultados para el equipo con ID: $codigoEquipo";
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo "ID del equipo no especificado.";
}
?>
