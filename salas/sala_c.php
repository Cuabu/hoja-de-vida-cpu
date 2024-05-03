<?php
include('../config/conexion.php');

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
    body {
        background-image: url('./img/');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
</style>

<body>

<img src="../img/custom-logo.png" title="Unilibre - Planificación" alt="Unilibre - Planificación" class="logo">
<br>

<br>

<div class="container">
    <!-- Botón para agregar producto -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregarModal">
        Registrar Computador
    </button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modificarDispositivo">
        Modificar Equipo
    </button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#seleccionarSalaModal">
        Seleccionar Sala
    </button>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#generarExcel">
        Documento Excel Equipos
    </button>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#consultarEquipoSala">
Documento Excel Salas
</button>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#consultarEquipoId">
    Consultar Equipo por ID
</button>



<!-- Modal para consultar equipo por Sala -->
<div class="modal fade" id="consultarEquipoSala" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Consultar Equipo por Sala</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para consultar producto por ID -->
                <form action="./controller/consultaEquipoSalas.php" method="POST">
                    <div class="form-group">
                        <label for="CodigoEquipoSala">Nombre de Sala:</label>
                        <input type="text" class="form-control" id="CodigoEquipoSala" name="CodigoEquipoSala" placeholder="Código de Equipo">
                    </div>
                    <button type="submit" class="btn btn-primary">Consultar Equipo de Sala</button>
                </form>

                <!-- Resultados de la consulta -->
                <div id="resultadosConsulta">
                    <!-- Aquí se mostrarán los resultados de la consulta -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para consultar equipo por ID -->
<div class="modal fade" id="consultarEquipoId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Consultar Equipo por ID Serial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para consultar producto por ID -->
                <form action="./controller/consultaEquiposId.php" method="POST">
                    <div class="form-group">
                        <label for="CodigoEquipo">Código de Equipo:</label>
                        <input type="text" class="form-control" id="CodigoEquipo" name="CodigoEquipo" placeholder="Código de Equipo">
                    </div>
                    <button type="submit" class="btn btn-primary">Consultar Equipo</button>
                </form>

                <!-- Resultados de la consulta -->
                <div id="resultadosConsulta">
                    <!-- Aquí se mostrarán los resultados de la consulta -->
                </div>
            </div>
        </div>
    </div>
</div>



    <!-- Modal para descargar base de datos de equipos -->
    <div class="modal fade" id="generarExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="generarExcel">Descargar Registro de Computadores</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- Formulario para consultar producto -->
                    <form action="./controller/consultarEquipo.php" method="POST">

    <button type="submit" class="btn btn-primary">Descargar Registros Equipos</button>

                 </form>
                </div>
            </div>
        </div>
    </div>


    <form action="./controller/actualizarController.php" method="POST">

<div class="modal fade" id="modificarDispositivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalDispositivo">Modificar Equipo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="CodigoEquipo">Código de Equipo:</label>
                    <input type="text" class="form-control" id="CodigoEquipo" name="CodigoEquipo" placeholder="Código de Equipo">
                </div>

                <div class="form-group">
                    <label for="idProducto">ID Producto:</label>
                    <input type="text" class="form-control" id="idProducto" name="idProducto" placeholder="Id Producto">
                </div>

                <div class="form-group">
                    <label for="FechaIngreso">Fecha de Ingreso:</label>
                    <input type="date" class="form-control" id="FechaIngreso" name="FechaIngreso" value="<?php echo date('Y-m-d'); ?>">
                </div>

                <div class="form-group">
                    <label for="NombreEquipo">Nombre del Equipo:</label>
                    <input type="text" class="form-control" id="NombreEquipo" name="NombreEquipo" placeholder="Nombre de la Computadora">
                </div>

                <div class="form-group">
                    <label for="ResponsableEquipo">Responsable de Equipo:</label>
                    <input type="text" class="form-control" id="ResponsableEquipo" name="ResponsableEquipo" placeholder="Responsable de Equipo">
                </div>

                <div class="form-group">
                    <label for="MarcaManuFactura">Marca de la Manufactura:</label>
                    <input type="text" class="form-control" id="MarcaManuFactura" name="MarcaManufactura" placeholder="Manufactura de Producto">
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
                    <label for="LectorOpticoMarcaModeloSerial">Marca o Serial de Unidad DVD:</label>
                    <input type="text" class="form-control" id="LectorOpticoMarcaModeloSerial" name="LectorOpticoMarcaModeloSerial" placeholder="Numero de Serie de DVD">
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
                    <label for="MacEthernetSerial">Características de Direccion Mac Eth0:</label>
                    <input type="text" class="form-control" id="MacEthernetSerial" name="MacEthernetSerial" placeholder="Dirección Mac ETH0">
                </div>

                <div class="form-group">
                    <label for="MacWIFISerial">Características de la Dirección Mac WiFi:</label>
                    <input type="text" class="form-control" id="MacWIFISerial" name="MacWIFISerial" placeholder="Dirección Mac Wifi">
                </div>

                <div class="form-group">
                    <label for="VelocidadHash">Cálculo de Hash:</label>
                    <input type="text" class="form-control" id="VelocidadHash" name="VelocidadHash" placeholder="Testeado en Linux con HASHCAT">
                </div>

                <div class="form-group">
                    <label for="DescripcionProducto">Descripción General:</label>
                    <textarea class="form-control" id="DescripcionProducto" name="DescripcionProducto" placeholder="Descripción Generalizada" rows="5"></textarea>
                </div>

                <div class="form-group">
                    <label for="HistorialMantenimientos">Historial de Mantenimientos:</label>
                    <textarea class="form-control" id="HistorialMantenimientos" name="HistorialMantenimientos" placeholder="Descripción Generalizada" rows="4"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Modificar Equipo</button>

            </div>
        </div>
    </div>
</div>
</form>

    


    <!-- Modal para seleccionar sala -->
    <div class="modal fade" id="seleccionarSalaModal" tabindex="-1" role="dialog" aria-labelledby="seleccionarSalaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="seleccionarSalaModalLabel">Seleccionar Sala</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="salaForm">
                        <div class="form-group">
                            <label for="salaSelect">Seleccione la sala:</label>
                            <select class="form-control" id="salaSelect" name="sala">
                                <option value="sala_a.php">Sala A</option>
                                <option value="sala_b.php">Sala B</option>
                                <option value="sala_c.php">Sala C</option>
                                <option value="sala_d.php">Sala D</option>
                                <option value="sala_e.php">Sala E</option>
                                <option value="sala_f.php">Sala F</option>
                                <option value="sala_g.php">Sala G</option>
                                <option value="sala_h.php">Sala H</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="redirigirSala()">Ir a la sala</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

      <!-- Modal para agregar producto -->
<div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="text" class="form-control" id="CodigoEquipo" name="CodigoEquipo" placeholder="Código de Equipo">
                    </div>

                    <div class="form-group">
                        <label for="FechaIngreso">Fecha de Ingreso:</label>
                        <input type="date" class="form-control" id="FechaIngreso" name="FechaIngreso" value="<?php echo date('Y-m-d'); ?>">
                    </div>

                    <div class="form-group">
                        <label for="NombreEquipo">Nombre del Equipo:</label>
                        <input type="text" class="form-control" id="NombreEquipo" name="NombreEquipo" placeholder="Nombre de la Computadora">
                    </div>

                    <div class="form-group">
                        <label for="ResponsableEquipo">Responsable de Equipo:</label>
                        <input type="text" class="form-control" id="ResponsableEquipo" name="ResponsableEquipo" placeholder="Responsable de Equipo">
                    </div>

                    <div class="form-group">
                        <label for="MarcaManuFactura">Marca de la Manufactura:</label>
                        <input type="text" class="form-control" id="MarcaManuFactura" name="MarcaManufactura" placeholder="Manufactura de Producto">
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
                        <label for="MonitorMarcaModeloSerial ">Marca o Serial del Monitor:</label>
                        <input type="text" class="form-control" id="MonitorMarcaModeloSerial" name="MonitorMarcaModeloSerial" placeholder="Numero de Serie del Monitor">
                    </div>

                    <div class="form-group">
                        <label for="MouseMarcaModeloSerial ">Marca o Serial del Mouse:</label>
                        <input type="text" class="form-control" id="MouseMarcaModeloSerial" name="MouseMarcaModeloSerial" placeholder="Numero de Serie del Mouse">
                    </div>

                    <div class="form-group">
                        <label for="LectorOpticoMarcaModeloSerial  ">Marca o Serial de Unidad DVD:</label>
                        <input type="text" class="form-control" id="LectorOpticoMarcaModeloSerial" name="LectorOpticoMarcaModeloSerial" placeholder="Numero de Serie de DVD">
                    </div>

                    <div class="form-group">
                        <label for="CPUModeloSerial    ">Marca o Serial de Unidad Procesamiento :</label>
                        <input type="text" class="form-control" id="CPUModeloSerial" name="CPUModeloSerial" placeholder="Numero de Serie Procesador">
                    </div>

                    <div class="form-group">
                        <label for="DiscoDuroModeloSerial">Marca o Serial de Unidad SSD :</label>
                        <input type="text" class="form-control" id="DiscoDuroModeloSerial" name="DiscoDuroModeloSerial" placeholder="Numero de Serie Disco SSD">
                    </div>

                    <div class="form-group">
                        <label for="MacEthernetSerial">Caracteristicas de Direccion Mac Eth0:</label>
                        <input type="text" class="form-control" id="MacEthernetSerial" name="MacEthernetSerial" placeholder="Direccion Mac ETH0">
                    </div>

                    <div class="form-group">
                        <label for="MacWIFISerial ">Caracteristicas de la Direccion Mac WiFi:</label>
                        <input type="text" class="form-control" id="MacWIFISerial" name="MacWIFISerial" placeholder="Direccion Mac Wifi">
                    </div>

                    <div class="form-group">
                        <label for="VelocidadHash ">Calculo de Hash:</label>
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
                <th>Nombre Equipo</th>
                <th>Descripcion Producto</th>
                <th class="acciones-column">Acciones</th> <!-- Agrega la clase a esta columna -->
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_array($query)): ?>
                <tr>
                    <td><?= $row['Id'] ?></td>
                    <td><?= $row['NombreEquipo'] ?></td>
                    <td><?= $row['DescripcionProducto'] ?></td>
                    <td>
                        <!-- Enlace para eliminar producto -->
                        <a href="./controller/eliminarProductoController.php?id=<?= $row['Id'] ?>" class="btn btn-danger">Eliminar</a>
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
