
<!DOCTYPE html>
<html lang="es">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Computadores</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../stilos/administrador.css" rel="stylesheet"> 
</head>

<header>

<img src="../img/custom-logo.png" title="Unilibre - Planificación" alt="Unilibre - Planificación">

</header>

<header>

<body>
<div class="container mt-4">
    <div class="button-container">
        <select class="custom-select" id="modalSelect">
            <option selected>Selecciona una opción</option>
            <option value="#subirRegistros">Subir Registros</option>
            <option value="#generarExcel">Descargar Documento Excel Equipos</option>
            <option value="#consultarEquipoSala">Consultar Equipo por Sala</option>
            <option value="#consultarEquipoNombre">Consultar Equipo por Nombre</option>
            <option value="#consultarEstadoEquipo">Consultar Estado de Equipos</option>
        </select>
    </div>
</div>

<!-- Modal para subir registros -->
<div class="modal fade" id="subirRegistros" tabindex="-1" role="dialog" aria-labelledby="subirRegistrosLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subirRegistrosLabel">Subir Registros</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controller/uploadArchivo.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="fileUpload">Seleccionar archivo(s)</label>
                        <input type="file" class="form-control-file" id="fileUpload" name="file[]" multiple>
                    </div>
                    <button type="submit" class="btn btn-primary">Subir</button>
                    <a href="../app/Exports/CPUINFO.py" download="CPUINFO.py" class="btn btn-success ml-2">Registro Automático</a>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- Otros modales (generarExcel, consultarEquipoSala, consultarEquipoNombre, consultarEstadoEquipo) -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#modalSelect').on('change', function() {
            var modalId = $(this).val();
            if (modalId) {
                $(modalId).modal('show');
            }
        });
    });
</script>
<!-- Modal para subir registros -->
<div class="modal fade" id="subirRegistros" tabindex="-1" role="dialog" aria-labelledby="subirRegistrosLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subirRegistrosLabel">Subir Registros</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controller/uploadArchivo.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="fileUpload">Seleccionar archivo(s)</label>
                        <input type="file" class="form-control-file" id="fileUpload" name="file[]" multiple>
                    </div>
                    <button type="submit" class="btn btn-primary">Subir</button>
                </form>
            </div>
            <div class="modal-footer">
                <a href="../app/Exports/CPUINFO.py" download="CPUINFO.py" class="btn btn-success">Registro Automático</a>
                <button type=."button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para consultar sala y descargando el excel -->
<div class="modal fade" id="consultarEquipoSala" tabindex="-1" role="dialog" aria-labelledby="consultarEquipoSalaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="consultarEquipoSalaLabel">Seleccionar Sala</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="salaForm">
                    <div class="form-group">
                        <label for="salaSelect">Consultar la Sala:</label>
                        <select class="form-control" id="salaSelect" name="sala">
                            <option value="sala a">Sala A</option>
                            <option value="sala b">Sala B</option>
                            <option value="sala c">Sala C</option>
                            <option value="sala d">Sala D</option>
                            <option value="sala e">Sala E</option>
                            <option value="sala f">Sala F</option>
                            <option value="sala g">Sala G</option>
                            <option value="sala h">Sala H</option>
                            <option value="laboratorio financiero">Laboratorio Financiero</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="descargarExcelSala()">Ir a Sala</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function descargarExcelSala() {
        var nombreSala = document.getElementById("salaSelect").value;
        window.location.href = "../controller/consultarEquipoSalas.php?NombreSala=" + nombreSala;
    }

    document.getElementById('modalSelect').addEventListener('change', function() {
        var modalId = this.value;
        if (modalId) {
            $(modalId).modal('show');
        }
    });
</script>

<!-- Modal para descargar Excel equipo -->
<div class="modal fade" id="generarExcel" tabindex="-1" role="dialog" aria-labelledby="generarExcelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="generarExcelLabel">Descargar Excel Equipo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controller/generarDocEquipos.php" method="GET">
                    <button type="submit" class="btn btn-primary">Descargar Excel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para consultar equipo por nombre -->
<div class="modal fade" id="consultarEquipoNombre" tabindex="-1" role="dialog" aria-labelledby="consultarEquipoNombreLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="consultarEquipoNombreLabel">Consultar de Equipo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="equipoForm">
                    <div class="form-group">
                        <label for="equipoInput">Nombre del Equipo:</label>
                        <input type="text" class="form-control" id="equipoInput" name="equipo">
                    </div>
                    <button type="button" class="btn btn-primary" onclick="descargarExcelEquipo()">Consultar Equipo</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function descargarExcelEquipo() {
        var nombreEquipo = document.getElementById("equipoInput").value;
        window.location.href = "../controller/consultarEquipoNombre.php?NombreEquipo=" + nombreEquipo;
    }
</script>

<!-- Modal para consultar el estado del equipo -->
<div class="modal fade" id="consultarEstadoEquipo" tabindex="-1" role="dialog" aria-labelledby="consultarEstadoEquipoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="consultarEstadoEquipoLabel">Consultar Estados de Equipos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form id="estadoForm">
                    <div class="form-group">
                        <label for="estadoInput">El botón va a redireccionar a la página de consulta:</label>
                        <input type="text" class="form-control" id="estadoInput" name="equipo">
                    </div>
                    <button type="button" class="btn btn-danger" id="consultarButton">CONSULTAR ESTADOS</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('consultarButton').addEventListener('click', function() {
        const equipo = document.getElementById('estadoInput').value;
        if (equipo.trim() !== "") {
            const url = `http://127.0.0.1:5000/consultar_estado?equipo=${encodeURIComponent(equipo)}`;
            window.location.href = url;
        } else {
            alert("Por favor, ingresa el nombre del equipo.");
        }
    });
</script>
<?php
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $database = "hvcpu"; 

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM historial";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        echo "<div class='container'>";
        echo "<table class='table table-bordered'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Código de Equipo</th>";
        echo "<th>Descripción</th>";
        echo "<th>Fecha</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["codigo_equipo"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["descripcion"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["fecha"]) . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p>No se encontraron registros en el historial de equipos.</p>";
    }

    $conn->close();
    ?>

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function redirigirSala() {
        var form = document.getElementById('salaForm');
        var selectedOption = form.elements['sala'].value;
        if (selectedOption) {
            window.location.href = selectedOption;
        }
    }
</script>
</body>
<footer class="footer_pagina">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5>Información de Contacto</h5>
                <p>Dirección: Carrera 109 No. 22 -00 - Valle del Lili Cali Valle del cauca</p>
                <p>Teléfono: 5240007 ext 2232 Campus Valle del Lilí Oficina Bienestar Unviersitario</p>
                <p>Email: soportecorreo.cali@unilibre.edu.co</p>
            </div>
            <div class="col-md-6">
                <h5>Enlaces Útiles</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Acerca de Nosotros</a></li>
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

</html>

