        <?php
        include('./config/conexion.php');

        $conexion = new Conexion();
        $conn = $conexion->conectar();
        $sql = "SELECT * FROM auto_equipos";
        $query = mysqli_query($conn, $sql);
        ?>

        <!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Lista de Computadoras</title>
            <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
            <link href="./stilos/administrador.css" rel="stylesheet">
        </head>

        <header>

            <img src="./img/custom-logo.png" title="Unilibre - Planificación" alt="Unilibre - Planificación">

        </header>

        <header>

            <body>

                <div class="container mt-4">
                    <div class="button-container">
                        <select class="custom-select" id="modalSelect">
                            <option value="#subirRegistros">Registrar</option>
                            <option value="#generarExcel">Descargar documento en formato Excel</option>
                            <option value="#consultarEquipoSala">Consultar equipo por sala</option>
                            <option value="#consultarEquipoNombre">Consultar equipo por nombre</option>
                            <option value="#consultarEstadoEquipo">Consultar estado de equipos</option>
                            <option value="#generarReporteHardware">Generar reporte de hardware en Excel</option>
                        </select>
                    </div>
                </div>

                <!-- Modal para subir registros -->
                <div class="modal fade" id="subirRegistros" tabindex="-1" role="dialog"
                    aria-labelledby="subirRegistrosLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="subirRegistrosLabel">Subir Registros</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="./controller/uploadArchivo.php" method="POST"
                                    enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="fileUpload">Seleccionar archivo(s)</label>
                                        <input type="file" class="form-control-file" id="fileUpload" name="file[]"
                                            multiple>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Subir</button>
                                    <a href="./app/Exports/CPUINFO.py" download="CPUINFO.py"
                                        class="btn btn-success ml-2">Registro Automático</a>
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
                <div class="modal fade" id="subirRegistros" tabindex="-1" role="dialog"
                    aria-labelledby="subirRegistrosLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="subirRegistrosLabel">Subir Registros</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="./controller/uploadArchivo.php" method="POST"
                                    enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="fileUpload">Seleccionar archivo(s)</label>
                                        <input type="file" class="form-control-file" id="fileUpload" name="file[]"
                                            multiple>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Subir</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <a href="./app/Exports/CPUINFO.py" download="CPUINFO.py"
                                    class="btn btn-success">Registro Automático</a>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal para consultar sala y descargando el excel -->
                <div class="modal fade" id="consultarEquipoSala" tabindex="-1" role="dialog"
                    aria-labelledby="consultarEquipoSalaLabel" aria-hidden="true">
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
                                    <button type="button" class="btn btn-primary" onclick="descargarExcelSala()">Ir a
                                        Sala</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                function descargarExcelSala() {
                    var nombreSala = document.getElementById("salaSelect").value;
                    window.location.href = "./controller/consultarEquipoSalas.php?NombreSala=" + nombreSala;
                }

                document.getElementById('modalSelect').addEventListener('change', function() {
                    var modalId = this.value;
                    if (modalId) {
                        $(modalId).modal('show');
                    }
                });
                </script>

                <!-- Modal para descargar Excel equipo -->
                <div class="modal fade" id="generarExcel" tabindex="-1" role="dialog"
                    aria-labelledby="generarExcelLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="generarExcelLabel">Descargar Excel Equipo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="./controller/generarDocEquipos.php" method="GET">
                                    <button type="submit" class="btn btn-primary">Descargar Excel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal para consultar equipo por nombre -->
                <div class="modal fade" id="consultarEquipoNombre" tabindex="-1" role="dialog"
                    aria-labelledby="consultarEquipoNombreLabel" aria-hidden="true">
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
                                    <button type="button" class="btn btn-primary"
                                        onclick="descargarExcelEquipo()">Consultar Equipo</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                function descargarExcelEquipo() {
                    var nombreEquipo = document.getElementById("equipoInput").value;
                    window.location.href = "./controller/consultarEquipoNombre.php?NombreEquipo=" + nombreEquipo;
                }
                </script>

                <!-- Modal para consultar el estado del equipo -->
                <div class="modal fade" id="consultarEstadoEquipo" tabindex="-1" role="dialog"
                    aria-labelledby="consultarEstadoEquipoLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="consultarEstadoEquipoLabel">Consultar Estados de Equipos
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="estadoForm">
                                    <div class="form-group">
                                        <label for="estadoInput">El botón va a redireccionar a la página de
                                            consulta:</label>
                                        <input type="text" class="form-control" id="estadoInput" name="equipo">
                                    </div>
                                    <button type="button" class="btn btn-danger" id="consultarButton">CONSULTAR
                                        ESTADOS</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                document.getElementById('consultarButton').addEventListener('click', function() {
                    const equipo = document.getElementById('estadoInput').value;
                    if (equipo.trim() !== "") {
                        // Redireccionar a localhost:dato_insertado
                        const url = `http://localhost:${encodeURIComponent(equipo)}`;
                        window.location.href = url;
                    } else {
                        alert("Por favor, ingresa el nombre del equipo.");
                    }
                });
                </script>

                <div class="container mt-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sala</th>
                                <th>Nombre</th>
                                <th>Campus</th>
                                <th>Equipo</th>
                                <th>Código</th>
                                <th class="opciones-column">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($query)): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['nombre_sala']) ?></td>
                                <td><?= htmlspecialchars($row['nombre_equipo']) ?></td>
                                <td><?= htmlspecialchars($row['campus']) ?></td>
                                <td><?= htmlspecialchars($row['numero_equipo']) ?></td>
                                <td><?= htmlspecialchars($row['codigo_equipo']) ?></td>
                                <td class="acciones-column">

                                    <form action="./controller/InsertarInformacionController.php" method="post"
                                        class="btn-group">
                                        <input type="hidden" name="codigo_equipo"
                                            value="<?= htmlspecialchars($row['codigo_equipo']) ?>">
                                        <input type="text" name="descripcion" placeholder="Descripción" required
                                            class="form-control">
                                        <button type="submit" class="btn btn-primary btn-sm">Enviar</button>
                                    </form>

                                    <!-- Botón modal para Reportar Daño -->
                                    <button type="button" class="btn btn-success btn-sm mt-1" data-toggle="modal"
                                        data-target="#modalReportarDanio"
                                        data-codigo="<?= htmlspecialchars($row['codigo_equipo']) ?>">Reportar
                                        Daño</button>

                                    <!-- Modal para consultar el estado del equipo -->
                                    <div class="modal fade" id="modalVerEstado" tabindex="-1" role="dialog"
                                        aria-labelledby="modalVerEstadoLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalVerEstadoLabel">Estado del Equipo
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" id="modalBody">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                    // Script para capturar el código de equipo del botón modal y hacer la consulta
                                    $(document).ready(function() {
                                        $('.ver-estado-btn').click(function() {
                                            var codigoEquipo = $(this).data('codigo');

                                            $.ajax({
                                                url: 'consultar_estado.php',
                                                type: 'GET',
                                                data: {
                                                    equipo: codigoEquipo
                                                },
                                                success: function(response) {
                                                    $('#modalBody').html(response);
                                                },
                                                error: function(xhr, status, error) {
                                                    console.error(error);
                                                    alert(
                                                        'Error al cargar el estado del equipo.');
                                                }
                                            });
                                        });
                                    });
                                    </script>

                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Modal para Reportar Daño -->
                <div class="modal fade" id="modalReportarDanio" tabindex="-1" role="dialog"
                    aria-labelledby="modalReportarDanioLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalReportarDanioLabel">Reportar Daño</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="./controller/reporte_danio.php" method="post">
                                    <div class="form-group">
                                        <label for="codigoDanio">Código de Equipo:</label>
                                        <input type="text" class="form-control" id="codigoDanio" name="codigo_equipo"
                                            readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcionDanio">Descripción del Daño:</label>
                                        <textarea class="form-control" id="descripcionDanio" name="falla" rows="3"
                                            required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcionDanio">Descripcion del Modelo:</label>
                                        <textarea class="form-control" id="descripcionDanio" name="modelo" rows="3"
                                            required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Reportar Daño</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal para Ver Estado -->
                <div class="modal fade" id="modalVerEstado" tabindex="-1" role="dialog"
                    aria-labelledby="modalVerEstadoLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalVerEstadoLabel">Ver Estado</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="./controller/ver_estado.php" method="post">
                                    <div class="form-group">
                                        <label for="codigoEstado">Código de Equipo:</label>
                                        <input type="text" class="form-control" id="codigoEstado" name="codigo_equipo"
                                            readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="puertoEstado">Puerto:</label>
                                        <input type="text" class="form-control" id="puertoEstado" name="puerto"
                                            required>
                                    </div>
                                    <button type="submit" class="btn btn-info">Ver Estado</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal para descargar Excel equipo -->
                <div class="modal fade" id="generarReporteHardware" tabindex="-1" role="dialog"
                    aria-labelledby="generarReporteHardware" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="generarReporteHardware">Descargar Estado Del Hardware </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="./controller/cambios_hardware.php" method="GET">
                                    <button type="submit" class="btn btn-primary">Descargar Reporte</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                $(document).ready(function() {

                    // Modal para Reportar Daño
                    $('#modalReportarDanio').on('show.bs.modal', function(event) {
                        var button = $(event.relatedTarget);
                        var codigoEquipo = button.data('codigo');

                        var modal = $(this);
                        modal.find('.modal-body #codigoDanio').val(codigoEquipo);
                    });

                    // Modal para Ver Estado
                    $('#modalVerEstado').on('show.bs.modal', function(event) {
                        var button = $(event.relatedTarget);
                        var codigoEquipo = button.data('codigo');

                        var modal = $(this);
                        modal.find('.modal-body #codigoEstado').val(codigoEquipo);
                    });
                });
                </script>

                <script src="./js/alert.js"></script>
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

        </html>