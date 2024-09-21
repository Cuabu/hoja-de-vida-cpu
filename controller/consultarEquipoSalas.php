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
    </header>
    <br>
    <div class="container">
        <?php
        if (isset($_GET['NombreSala']) && !empty($_GET['NombreSala'])) {
            $nombreSala = $_GET['NombreSala'];

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "hvcpu";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            $sql = "SELECT ae.nombre_equipo, ae.campus, ae.codigo_equipo, ae.numero_equipo
                    FROM auto_equipos ae
                    WHERE ae.nombre_sala = '$nombreSala'
                    ORDER BY ae.numero_equipo ASC";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<div class='mt-3'>";
                echo "<a href='javascript:history.back()' class='btn btn-secondary mr-2'>Volver</a>";
                echo "<button class='btn btn-primary' onclick='consultarOtroScript()'>Descargar Excel</button>";
                echo "</div>";
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
            } else {
                echo "<p>No se encontraron resultados para la sala: $nombreSala</p>";
            }

            $conn->close();
        } else {
            echo "<p>No se especificó el nombre de la sala.</p>";
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function consultarOtroScript() {
            var nombreSala = "<?php echo isset($nombreSala) ? $nombreSala : ''; ?>";
            window.location.href = "../controller/generarDocSala.php?NombreSala=" + nombreSala;
        }
    </script>

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
