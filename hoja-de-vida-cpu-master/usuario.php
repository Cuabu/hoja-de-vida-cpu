<?php
include('./config/conexion.php');

$conexion = new Conexion();
$conn = $conexion->conectar();
$sql = "SELECT * FROM equipos";
$query = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lista de Computadores</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
header {
    text-align: center;
    /* Centrar contenido dentro del header */
}

header img {
    display: inline-block;
    /* Alinear la imagen como bloque en línea */


    padding-top: 10px;
    margin-top: 20px;
}
</style>

</style>

<header>
    <img src="../hoja de vida cpu/img/custom-logo.png" title="Unilibre - Planificación" alt="Unilibre - Planificación">
    <!-- Contenido adicional del encabezado si es necesario -->
</header>
<br>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <!-- Divide la fila en 4 columnas -->
                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#agregarModal">
                    Registrar Computador
                </button>
            </div>
            <div class="col-md-4 mb-3">
                <!-- Divide la fila en 4 columnas -->
                <button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                    data-target="#modificarDispositivo">
                    Modificar Equipo
                </button>
            </div>
            <div class="col-md-4 mb-3">
                <!-- Divide la fila en 4 columnas -->
                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#generarExcel">
                    Documento Excel Equipos
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <!-- Divide la fila en 4 columnas -->
                <button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                    data-target="#consultarEquipoSala">
                    Ver Salas
                </button>
            </div>
            <div class="col-md-4 mb-3">
                <!-- Divide la fila en 4 columnas -->
                <button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                    data-target="#consultarEquipoId">
                    Consultar Equipo por ID
                </button>
            </div>
        </div>
    </div>

    <!-- Modal para agregar dispositivo -->
    <div class="modal fade" id="agregarDispositivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalDispositivo">Agregar Dispositivos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para agregar dispositivo -->
                    <form action="./controller/agregarDispositivo.php" method="POST">
                        <div class="form-group">
                            <label for="EquipoId">Código de Equipo:</label>
                            <input type="text" class="form-control" id="EquipoId" name="EquipoId"
                                placeholder="Código de Equipo">
                        </div>

                        <div class="form-group">
                            <label for="MarcaSerial">Nombre del Equipo:</label>
                            <input type="text" class="form-control" id="MarcaSerial" name="MarcaSerial"
                                placeholder="Nombre de la Computadora">
                        </div>

                        <div class="form-group">
                            <label for="Observaciones">Responsable de Equipo:</label>
                            <input type="text" class="form-control" id="Observaciones" name="Observaciones"
                                placeholder="Responsable de Equipo">
                        </div>

                        <button type="submit" class="btn btn-primary">Agregar Dispositivo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para agregar producto -->
    <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- Formulario para agregar producto -->
                    <form action="./controller/agregarProductoController.php" method="POST">

                        <div class="form-group">
                            <label for="CodigoEquipo">Código de Equipo:</label>
                            <input type="text" class="form-control" id="CodigoEquipo" name="CodigoEquipo"
                                placeholder="Código de Equipo">
                        </div>

                        <div class="form-group">
                            <label for="FechaIngreso">Fecha de Ingreso:</label>
                            <input type="date" class="form-control" id="FechaIngreso" name="FechaIngreso"
                                value="<?php echo date('Y-m-d'); ?>">
                        </div>

                        <div class="form-group">
                            <label for="NombreEquipo">Nombre del Equipo:</label>
                            <input type="text" class="form-control" id="NombreEquipo" name="NombreEquipo"
                                placeholder="Nombre de la Computadora">
                        </div>


                        <div class="form-group">
                            <label for="ResponsableEquipo">Responsable de Equipo:</label>
                            <input type="text" class="form-control" id="ResponsableEquipo" name="ResponsableEquipo"
                                placeholder="Responsable de Equipo">
                        </div>

                        <div class="form-group">
                            <label for="MarcaManuFactura">Marca de la Manufactura:</label>
                            <input type="text" class="form-control" id="MarcaManuFactura" name="PaginaFolio"
                                placeholder="Manufactura de Producto">
                        </div>

                        <div class="form-group">
                            <label for="TecladoMarcaModeloSerial">Marca o Serial de Teclado:</label>
                            <input type="text" class="form-control" id="TecladoMarcaModeloSerial"
                                name="TecladoMarcaModeloSerial" placeholder="Manufactura de Teclado">
                        </div>

                        <div class="form-group">
                            <label for="ReguladorVoltajeSerial">Marca o Serial del Regulador:</label>
                            <input type="text" class="form-control" id="ReguladorVoltajeSerial"
                                name="ReguladorVoltajeSerial" placeholder="Numero de Serie del Regulador">
                        </div>

                        <div class="form-group">
                            <label for="MonitorMarcaModeloSerial ">Marca o Serial del Monitor:</label>
                            <input type="text" class="form-control" id="MonitorMarcaModeloSerial"
                                name="MonitorMarcaModeloSerial" placeholder="Numero de Serie del Monitor">
                        </div>

                        <div class="form-group">
                            <label for="MouseMarcaModeloSerial ">Marca o Serial del Mause:</label>
                            <input type="text" class="form-control" id="MouseMarcaModeloSerial"
                                name="MouseMarcaModeloSerial" placeholder="Numero de Serie del Mause">
                        </div>

                        <div class="form-group">
                            <label for="LectorOpticoMarcaModeloSerial  ">Marca o Serial de Unidad DVD:</label>
                            <input type="text" class="form-control" id="LectorOpticoMarcaModeloSerial"
                                name="LectorOpticoMarcaModeloSerial" placeholder="Numero de Serie de DVD">
                        </div>

                        <div class="form-group">
                            <label for="CPUModeloSerial    ">Marca o Serial de Unida Procesamiento :</label>
                            <input type="text" class="form-control" id="CPUModeloSerial" name="CPUModeloSerial"
                                placeholder="Numero de Serie Procesador">
                        </div>
                        <div class="form-group">
                            <label for="DiscoDuroModeloSerial">Marca o Serial de Unida SSD :</label>
                            <input type="text" class="form-control" id="DiscoDuroModeloSerial"
                                name="DiscoDuroModeloSerial" placeholder="Numero de Serie Disco SSD">
                        </div>
                        <div class="form-group">
                            <label for="MacEthernetSerial">Caracteristicas de Direccion Mac Eth0:</label>
                            <input type="text" class="form-control" id="MacEthernetSerial" name="MacEthernetSerial"
                                placeholder="Direccion Mac ETH0">
                        </div>
                        <div class="form-group">
                            <label for="MacWIFISerial ">Caracteristicas de la Direccion Mac WiFi:</label>
                            <input type="text" class="form-control" id="MacWIFISerial" name="MacWIFISerial"
                                placeholder="Direccion Mac Wifi">
                        </div>

                        <div class="form-group">
                            <label for="VelocidadHash ">Calculo de Hash:</label>
                            <input type="text" class="form-control" id="VelocidadHash" name="VelocidadHash"
                                placeholder="Testeado en Linux con HASHCAT">
                        </div>

                        <div class="form-group">
                            <label for="DescripcionProducto">Descripción General:</label>
                            <textarea class="form-control" id="DescripcionProducto" name="DescripcionProducto"
                                placeholder="Descripción Generalizada" rows="5"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="HistorialMantenimientos">Descripción General:</label>
                            <textarea class="form-control" id="HistorialMantenimientos" name="HistorialMantenimientos"
                                placeholder="Descripción Generalizada" rows="4"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Agregar Equipo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de equipos -->
    <div class="container mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre Equipo</th>
                    <th>Descripcion Producto</th>

                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($query)): ?>
                <tr>
                    <td><?= $row['Id'] ?></td>
                    <td><?= $row['NombreEquipo'] ?></td>
                    <td><?= $row['DescripcionProducto'] ?></td>

                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    </div>

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

</html>