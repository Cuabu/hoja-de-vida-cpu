<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lista de Computadores</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        header {
            text-align: center; /* Centrar contenido dentro del header */
        }
        header img {
            display: inline-block; /* Alinear la imagen como bloque en línea */
            padding-top: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <img src="../img/custom-logo.png" title="Unilibre - Planificación" alt="Unilibre - Planificación">
        <!-- Contenido adicional del encabezado si es necesario -->
    </header>
    <br>
    <?php
    if (isset($_POST['CodigoEquipo']) && !empty($_POST['CodigoEquipo'])) {
        $codigoEquipo = $_POST['CodigoEquipo'];
        $servername = "localhost";
        $username = "root";
        $password = "114412345@";
        $dbname = "hvcpu";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM equipos WHERE CodigoEquipo = '$codigoEquipo' ORDER BY Id DESC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<div class='container'>";
            echo "<table id='tabla-equipo' class='table table-bordered'>";
            echo "<thead><tr><th>ID</th><th>Código de Equipo</th><th>Fecha de Ingreso</th><th>Nombre del Equipo</th><th>Responsable de Equipo</th><th>Marca de Manufactura</th><th>Marca o Serial de Teclado</th><th>Marca o Serial del Regulador</th><th>Marca o Serial del Monitor</th><th>Marca o Serial del Mouse</th><th>Marca o Serial de Unidad Procesamiento</th><th>Marca o Serial de Unidad SSD</th><th>Características de Dirección Mac Eth0</th><th>Características de la Dirección Mac WiFi</th><th>Cálculo de Hash</th><th>Descripción General</th><th>Historial de Mantenimientos</th><th>Historia de Manteniminetos</th></tr></thead><tbody>";

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
                echo "<td>".$row["CPUModeloSerial"]."</td>";
                echo "<td>".$row["DiscoDuroModeloSerial"]."</td>";
                echo "<td>".$row["MacEthernetSerial"]."</td>";
                echo "<td>".$row["MacWIFISerial"]."</td>";
                echo "<td>".$row["VelocidadHash"]."</td>";
                echo "<td>".$row["DescripcionProducto"]."</td>";
                echo "<td>".$row["HistorialMantenimientos"]."</td>";
                echo "</tr>";
                
            }
            echo "</tbody></table>";
            echo "</div>";
            echo "<div class='container'><a href='javascript:history.back()' class='btn btn-secondary mt-3 mr-2'>Volver</a><button class='btn btn-primary mt-3' onclick='descargarPDF()'>Descargar PDF</button></div>";
        } else {
            echo "<div class='container mt-4'><p>No se encontraron resultados para el equipo con ID: $codigoEquipo</p></div>";
        }
        $conn->close();
    } else {
        echo "<div class='container mt-4'><p>ID del equipo no especificado.</p></div>";
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script>
        function descargarPDF() {
            const doc = new jsPDF();
            doc.autoTable({html: '#tabla-equipo'});
            doc.save('detalle_equipo.pdf');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
