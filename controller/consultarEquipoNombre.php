<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Computadores</title>
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
    // Verificar si se ha enviado el formulario y el nombre de la sala está presente
    if (isset($_GET['NombreEquipo']) && !empty($_GET['NombreEquipo'])) {
        // Obtener el nombre de la sala desde el parámetro GET
        $nombreEquipo = $_GET['NombreEquipo'];

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
        $sql = "SELECT NombreEquipo, Campus, HistorialMantenimientos FROM equipos WHERE NombreEquipo = '$nombreEquipo' ORDER BY Id DESC";

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
            // Botón para regresar y descargar Excel
            echo "<div class='container'><a href='javascript:history.back()' class='btn btn-secondary mt-3 mr-2'>Volver</a><a href='../controller/generarDocNombre.php?NombreEquipo=$nombreEquipo' class='btn btn-primary mt-3'>Descargar Excel</a></div>";

        } else {
            echo "<div class='container mt-4'><p>No se encontraron resultados para la sala: $nombreEquipo</p></div>";
        }

        // Cerrar la conexión
        $conn->close();
    } else {
        echo "<div class='container mt-4'><p>No se especificó el nombre de el equipo.</p></div>";
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script>
    function consultarOtroScript() {
        // Obtener el nombre del equipo desde el formulario
        var nombreEquipo = "<?php echo $nombreEquipo; ?>";
        
        // Redirigir al script deseado
        window.location.href = "../controller/generarDocEquipos.php?NombreEquipo=" + nombreEquipo;
    }
</script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
