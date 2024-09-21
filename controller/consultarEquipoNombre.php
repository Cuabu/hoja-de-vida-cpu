<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Computadores</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../stilos/consultas.css" rel="stylesheet">
</head>
<body>
    <header>
        <img src="../img/custom-logo.png" title="Unilibre - Planificación" alt="Unilibre - Planificación">
        <!-- Contenido adicional del encabezado si es necesario -->
    </header>

    <div class='container mt-3'>
        <a href='javascript:history.back()' class='btn btn-secondary mr-2'>Volver</a>
        <a href='../controller/generarDocNombre.php?NombreEquipo=<?php echo $nombreEquipo; ?>' class='btn btn-primary'>Descargar Excel</a>
    </div>

    <?php
    // Verificar si se ha enviado el formulario y el nombre del equipo está presente
    if (isset($_GET['NombreEquipo']) && !empty($_GET['NombreEquipo'])) {
        // Obtener el nombre del equipo desde el parámetro GET
        $nombreEquipo = $_GET['NombreEquipo'];

        // Conectar a la base de datos (reemplaza los valores según tu configuración)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "hvcpu";

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Consulta SQL para obtener los datos del equipo por nombre
        $sql = "SELECT nombre_equipo, campus, codigo_equipo, numero_equipo FROM auto_equipos WHERE nombre_equipo = '$nombreEquipo' ORDER BY codigo_equipo DESC";

        // Ejecutar la consulta
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class='mt-3'>";
            echo "<table class='table table-bordered'>";
            echo "<thead><tr><th>Nombre del Equipo</th><th>Campus</th><th>Código de Equipo</th><th>Número de Equipo</th><th>Acciones</th></tr></thead><tbody>";
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["nombre_equipo"]."</td>";
                echo "<td>".$row["campus"]."</td>";
                echo "<td>".$row["codigo_equipo"]."</td>";
                echo "<td>".$row["numero_equipo"]."</td>";
                echo "<td class='acciones-column'>";
                echo "<form action='./controller/InsertarInformacionController.php' method='post' class='btn-group'>";
                echo "<input type='hidden' name='codigo_equipo' value='".htmlspecialchars($row['codigo_equipo'])."'>";
                echo "<input type='text' name='descripcion' placeholder='Descripción' required class='form-control'>";
                echo "<button type='submit' class='btn btn-primary btn-sm'>Enviar</button>";
                echo "</form>";
                echo "<button type='button' class='btn btn-success btn-sm mt-1' data-toggle='modal' data-target='#modalReportarDanio' data-codigo='".htmlspecialchars($row['codigo_equipo'])."'>Reportar Daño</button>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</tbody></table>";
            echo "</div>";
        } else {
            echo "<div class='container mt-4'><p>No se encontraron resultados para el equipo: $nombreEquipo</p></div>";
        }

        // Cerrar la conexión
        $conn->close();
    } else {
        echo "<div class='container mt-4'><p>No se especificó el nombre del equipo.</p></div>";
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

    <footer class="footer_pagina">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Información de Contacto</h5>
                    <p>Dirección: Carrera 109 No. 22 -00 - Valle del Lili Cali Valle del Cauca</p>
                    <p>Teléfono: 5240007 ext 2232 Campus Valle del Lilí Oficina Bienestar Unviersitario</p>
                    <p>Email: soportecorreo.cali@unilibre.edu.co</p>
                </div>
                <div class="col-md-6">
                    <h5>Enlaces Útiles</h5>
                    <ul class="list-unstyled">
                        <li><a href="https://gitlab.com/jobs762943/unilibre.git">Acerca de Nosotros</a></li>
                        <li><a href="#">Servicios</a></li>
                        <li><a href="#">Política de Privacidad</a></li>
                        <li><a href="#">Términos y Condiciones</a></li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center">© 2024 Salas De Computo Universidada Libre Seccional Cali.</p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
