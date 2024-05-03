<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Sala</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos adicionales */
        body {
            padding-top: 50px;
        }
        .container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<img src="../img/custom-logo.png" title="Unilibre - Planificación" alt="Unilibre - Planificación">

    <?php
    // Verificar si se ha enviado el formulario y el nombre de la sala está presente
    if (isset($_GET['NombreSala']) && !empty($_GET['NombreSala'])) {
        // Obtener el nombre de la sala desde el parámetro GET
        $nombreSala = $_GET['NombreSala'];

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

        // Consulta SQL para obtener los datos de la sala por nombre
        $sql = "SELECT NombreEquipo, Campus, HistorialMantenimientos FROM equipos WHERE NombreSala = '$nombreSala' ORDER BY Id DESC";

        // Ejecutar la consulta
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar los datos de la sala
            echo "<div class='container'>";
            echo "<table id='tabla-sala' class='table table-bordered'>";
            echo "<thead><tr><th>Nombre del Equipo</th><th>Campus</th><th>Historial de Mantenimientos</th></tr></thead><tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["NombreEquipo"]."</td>";
                echo "<td>".$row["Campus"]."</td>";
                echo "<td>".$row["HistorialMantenimientos"]."</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
            echo "</div>";
            // Botón para regresar
            echo "<div class='container'><a href='javascript:history.back()' class='btn btn-secondary mt-3 mr-2'>Volver</a><button class='btn btn-primary mt-3' onclick='descargarPDF()'>Descargar PDF</button></div>";
        } else {
            echo "<div class='container mt-4'><p>No se encontraron resultados para la sala: $nombreSala</p></div>";
        }

        // Cerrar la conexión
        $conn->close();
    } else {
        echo "<div class='container mt-4'><p>No se especificó el nombre de la sala.</p></div>";
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script>
        function descargarPDF() {
            const doc = new jsPDF();
            doc.autoTable({html: '#tabla-sala'});
            doc.save('detalle_sala.pdf');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
