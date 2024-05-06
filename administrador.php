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
            text-align: center; /* Centrar contenido dentro del header */
        }
        header img {
            display: inline-block; /* Alinear la imagen como bloque en línea */
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
        <div class="col-md-4 mb-3"> <!-- Divide la fila en 4 columnas -->
            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#agregarModal">
                Registrar Equipo
            </button>
        </div>
        <div class="col-md-4 mb-3"> <!-- Divide la fila en 4 columnas -->
            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modificarDispositivo">
                Modificar Equipo
            </button>
        </div>
        <div class="col-md-4 mb-3"> <!-- Divide la fila en 4 columnas -->
            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#generarExcel">
                Descargar Documento Excel Equipos
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3"> <!-- Divide la fila en 4 columnas -->
            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#consultarEquipoSala">
                Ver Salas
            </button>
        </div>
            <div class="col-md-4 mb-3"> <!-- Divide la fila en 4 columnas -->
                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#consultarEquipoSala">
                    Consultar Equipo por Sala
                </button>
        </div>
        <div class="col-md-4 mb-3"> <!-- Divide la fila en 4 columnas -->
            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#consultarEquipoNombre">
                Consultar Equipo por Nombre
            </button>
        </div>
    </div>
</div>

<!-- Modal para consultar sala descargando el excel -->
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
        window.location.href = "../hoja de vida cpu/controller/consultarEquipoSalas.php?NombreSala=" + nombreSala;
    }
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
                <form action="./controller/generarDocEquipos.php" method="GET">
                    
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
        window.location.href = "../hoja de vida cpu/controller/consultarEquipoNombre.php?NombreEquipo=" + nombreEquipo;
    }
</script>


 <!-- Modal para modificar producto -->
 <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar Equipo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para agregar producto -->
                <form action="./controller/agregarProductoController.php" method="POST">

                    <div class="form-group">
                        <label for="CodigoEquipo">Código de Equipo:</label>
                        <input type="text" class="form-control" id="CodigoEquipo" name="CodigoEquipo" placeholder="Código de Equipo">
                    </div>

                    <div class="form-group">
                        <label for="NombreSala">Nombre de la Sala</label>
                        <input type="text" class="form-control" id="NombreSala" name="NombreSala" placeholder="Nombre de la Sala">
                    </div>

                    <div class="form-group">
                        <label for="NombreEquipo">Nombre del Equipo:</label>
                        <input type="text" class="form-control" id="NombreEquipo" name="NombreEquipo" placeholder="Nombre de la Computadora">
                    </div>

                    <div class="form-group">
                        <label for="NumeroEquipo">Numero del Equipo:</label>
                        <input type="text" class="form-control" id="NumeroEquipo" name="NumeroEquipo" placeholder="Numero de la Computadora">
                    </div>

                    <div class="form-group">
                        <label for="Campus">Campus del Equipo:</label>
                        <input type="text" class="form-control" id="Campus" name="Campus" placeholder="Campus de la Computadora">
                    </div>

                    <div class="form-group">
                        <label for="MarcaManufactura">Marca de la Manufactura:</label>
                        <input type="text" class="form-control" id="MarcaManufactura" name="MarcaManufactura" placeholder="Manufactura de Producto">
                    </div>

                    <div class="form-group">
                        <label for="TecladoMarcaModeloSerial">Marca o Serial de Teclado:</label>
                        <input type="text" class="form-control" id="TecladoMarcaModeloSerial" name="TecladoMarcaModeloSerial" placeholder="Manufactura de Teclado">
                    </div>

                    <div class="form-group">
                        <label for="ReguladorVoltajeSerial">Marca o Serial del Regulador:</label>
                        <input type="text" class="form-control" id="ReguladorVoltajeSerial" name="ReguladorVoltajeSerial" placeholder="Numero de Serie del Regulador">
                    </div>

                    <div class="form-group">
                        <label for="MonitorMarcaModeloSerial">Marca o Serial del Monitor:</label>
                        <input type="text" class="form-control" id="MonitorMarcaModeloSerial" name="MonitorMarcaModeloSerial" placeholder="Numero de Serie del Monitor">
                    </div>

                    <div class="form-group">
                        <label for="MouseMarcaModeloSerial">Marca o Serial del Mouse:</label>
                        <input type="text" class="form-control" id="MouseMarcaModeloSerial" name="MouseMarcaModeloSerial" placeholder="Numero de Serie del Mouse">
                    </div>

                    <div class="form-group">
                        <label for="CPUModeloSerial">Marca o Serial de Unidad Procesamiento:</label>
                        <input type="text" class="form-control" id="CPUModeloSerial" name="CPUModeloSerial" placeholder="Numero de Serie Procesador">
                    </div>

                    <div class="form-group">
                        <label for="DiscoDuroModeloSerial">Marca o Serial de Unidad SSD:</label>
                        <input type="text" class="form-control" id="DiscoDuroModeloSerial" name="DiscoDuroModeloSerial" placeholder="Numero de Serie Disco SSD">
                    </div>

                    <div class="form-group">
                        <label for="MacEthernetSerial">Caracteristicas de Direccion Mac Eth0:</label>
                        <input type="text" class="form-control" id="MacEthernetSerial" name="MacEthernetSerial" placeholder="Direccion Mac ETH0">
                    </div>

                    <div class="form-group">
                        <label for="MacWIFISerial">Caracteristicas de la Direccion Mac WiFi:</label>
                        <input type="text" class="form-control" id="MacWIFISerial" name="MacWIFISerial" placeholder="Direccion Mac Wifi">
                    </div>

                    <div class="form-group">
                        <label for="Observaciones">Observaciones de Equipo:</label>
                        <input type="text" class="form-control" id="Observaciones" name="Observaciones" placeholder="Nombre de la Sala">
                    </div>

                    <div class="form-group">
                        <label for="ResponsableEquipo">Responsable de Equipo:</label>
                        <input type="text" class="form-control" id="ResponsableEquipo" name="ResponsableEquipo" placeholder="Responsable de Equipo">
                    </div>

                    <div class="form-group">
                        <label for="FechaIngreso">Fecha de Ingreso:</label>
                        <input type="date" class="form-control" id="FechaIngreso" name="FechaIngreso" value="<?php echo date('Y-m-d'); ?>">
                    </div>

                    <div class="form-group">
                        <label for="VelocidadHash">Calculo de Hash:</label>
                        <input type="text" class="form-control" id="VelocidadHash" name="VelocidadHash" placeholder="Testeado en Linux con HASHCAT">
                    </div>

                    <div class="form-group">
                        <label for="DescripcionProducto">Descripción General:</label>
                        <textarea class="form-control" id="DescripcionProducto" name="DescripcionProducto" placeholder="Descripción Generalizada" rows="5"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="HistorialMantenimientos">Historial de Mantenimientos:</label>
                        <textarea class="form-control" id="HistorialMantenimientos" name="HistorialMantenimientos" placeholder="Historial de Mantenimientos" rows="4"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="DetallesReparacion">Detalles de Reparación:</label>
                        <textarea class="form-control" id="DetallesReparacion" name="DetallesReparacion" placeholder="Detalles de Reparación" rows="4"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Registrar Equipo</button>

                </form>
            </div>
        </div>
    </div>
</div>

   <!-- Modal para modificar producto -->
<div class="modal fade" id="modificarDispositivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modificarDispositivo">Modificar Equipo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para modificar producto -->
                <form action="./controller/actualizarController.php" method="POST">

                    <div class="form-group">
                        <label for="Id">ID:</label>
                        <input type="text" class="form-control" id="Id" name="Id" placeholder="ID">
                    </div>

                    <div class="form-group">
                        <label for="CodigoEquipo">Código de Equipo:</label>
                        <input type="text" class="form-control" id="CodigoEquipo" name="CodigoEquipo" placeholder="Código de Equipo">
                    </div>

                    <div class="form-group">
                        <label for="NombreSala">Nombre de la Sala:</label>
                        <input type="text" class="form-control" id="NombreSala" name="NombreSala" placeholder="Nombre de la Sala">
                    </div>

                    <div class="form-group">
                        <label for="NombreEquipo">Nombre del Equipo:</label>
                        <input type="text" class="form-control" id="NombreEquipo" name="NombreEquipo" placeholder="Nombre de la Computadora">
                    </div>

                    <div class="form-group">
                        <label for="NumeroEquipo">Número de Equipo:</label>
                        <input type="text" class="form-control" id="NumeroEquipo" name="NumeroEquipo" placeholder="Número de Equipo">
                    </div>

                    <div class="form-group">
                        <label for="Campus">Campus:</label>
                        <input type="text" class="form-control" id="Campus" name="Campus" placeholder="Campus">
                    </div>

                    <div class="form-group">
                        <label for="MarcaManufactura">Marca de la Manufactura:</label>
                        <input type="text" class="form-control" id="MarcaManufactura" name="MarcaManufactura" placeholder="Manufactura de Producto">
                    </div>

                    <div class="form-group">
                        <label for="TecladoMarcaModeloSerial">Marca o Serial de Teclado:</label>
                        <input type="text" class="form-control" id="TecladoMarcaModeloSerial" name="TecladoMarcaModeloSerial" placeholder="Manufactura de Teclado">
                    </div>

                    <div class="form-group">
                        <label for="ReguladorVoltajeSerial">Marca o Serial del Regulador:</label>
                        <input type="text" class="form-control" id="ReguladorVoltajeSerial" name="ReguladorVoltajeSerial" placeholder="Numero de Serie del Regulador">
                    </div>

                    <div class="form-group">
                        <label for="MonitorMarcaModeloSerial">Marca o Serial del Monitor:</label>
                        <input type="text" class="form-control" id="MonitorMarcaModeloSerial" name="MonitorMarcaModeloSerial" placeholder="Numero de Serie del Monitor">
                    </div>

                    <div class="form-group">
                        <label for="MouseMarcaModeloSerial">Marca o Serial del Mouse:</label>
                        <input type="text" class="form-control" id="MouseMarcaModeloSerial" name="MouseMarcaModeloSerial" placeholder="Numero de Serie del Mouse">
                    </div>

                    <div class="form-group">
                        <label for="CPUModeloSerial">Marca o Serial de Unidad Procesamiento:</label>
                        <input type="text" class="form-control" id="CPUModeloSerial" name="CPUModeloSerial" placeholder="Numero de Serie Procesador">
                    </div>

                    <div class="form-group">
                        <label for="DiscoDuroModeloSerial">Marca o Serial de Unidad SSD:</label>
                        <input type="text" class="form-control" id="DiscoDuroModeloSerial" name="DiscoDuroModeloSerial" placeholder="Numero de Serie Disco SSD">
                    </div>

                    <div class="form-group">
                        <label for="MacEthernetSerial">Caracteristicas de Direccion Mac Eth0:</label>
                        <input type="text" class="form-control" id="MacEthernetSerial" name="MacEthernetSerial" placeholder="Direccion Mac ETH0">
                    </div>

                    <div class="form-group">
                        <label for="MacWIFISerial">Caracteristicas de la Direccion Mac WiFi:</label>
                        <input type="text" class="form-control" id="MacWIFISerial" name="MacWIFISerial" placeholder="Direccion Mac Wifi">
                    </div>

                    <div class="form-group">
                        <label for="Observaciones">Observaciones:</label>
                        <textarea class="form-control" id="Observaciones" name="Observaciones" placeholder="Observaciones" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="ResponsableEquipo">Responsable de Equipo:</label>
                        <input type="text" class="form-control" id="ResponsableEquipo" name="ResponsableEquipo" placeholder="Responsable de Equipo">
                    </div>

                    <div class="form-group">
                        <label for="FechaIngreso">Fecha de Ingreso:</label>
                        <input type="date" class="form-control" id="FechaIngreso" name="FechaIngreso" value="<?php echo date('Y-m-d'); ?>">
                    </div>

                    <div class="form-group">
                        <label for="VelocidadHash">Calculo de Hash:</label>
                        <input type="text" class="form-control" id="VelocidadHash" name="VelocidadHash" placeholder="Testeado en Linux con HASHCAT">
                    </div>

                    <div class="form-group">
                        <label for="DescripcionProducto">Descripción General:</label>
                        <textarea class="form-control" id="DescripcionProducto" name="DescripcionProducto" placeholder="Descripción Generalizada" rows="5"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="HistorialMantenimientos">Historial de Mantenimientos:</label>
                        <textarea class="form-control" id="HistorialMantenimientos" name="HistorialMantenimientos" placeholder="Historial de Mantenimientos" rows="4"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="DetallesReparacion">Detalles de Reparación:</label>
                        <textarea class="form-control" id="DetallesReparacion" name="DetallesReparacion" placeholder="Detalles de Reparación" rows="4"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Agregar Equipo</button>

                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .acciones-column {
        width: 150px; /* Ajusta el ancho según sea necesario */
    }
</style>

<div class="container mt-4">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre Sala</th>
                <th>Nombre Equipo</th>
                <th>Descripción Producto</th>
                <th class="acciones-column">Acciones</th> <!-- Agrega la clase a esta columna -->
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_array($query)): ?>
                <tr>
                    <td><?= $row['Id'] ?></td>
                    <td><?= $row['NombreSala'] ?></td>
                    <td><?= $row['NombreEquipo'] ?></td>
                    <td><?= $row['DescripcionProducto'] ?></td>
                    <td>
                        <!-- Enlace para eliminar producto -->
                        <a href="./controller/eliminarProductoController.php?id=<?= $row['Id'] ?>" class="btn btn-danger mr-2">Eliminar</a>
                     
                        <form action="./controller/InsertarInformacionController.php" method="post" class="d-inline">
                            <input type="hidden" name="Id" value="<?= $row['Id'] ?>">
                            <input type="text" name="InformacionCompleta" placeholder="Ingresa Toda Información...">
                            <button type="submit" class="btn btn-primary">Enviar Informacion</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
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
