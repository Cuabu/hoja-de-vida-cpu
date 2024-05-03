<?php
// Verificar si se ha enviado el formulario y el ID de la sala está presente
if (isset($_POST['CodigoEquipoSala']) && !empty($_POST['CodigoEquipoSala'])) {
    // Obtener el código de la sala desde el formulario
    $CodigoSala = $_POST['CodigoEquipoSala'];

    // Incluir el archivo de conexión
    include('./config/conexion.php');

    // Conectar a la base de datos
    $conexion = new Conexion();
    $conn = $conexion->conectar();

    // Consulta SQL para obtener los equipos de la sala seleccionada
    $sql = "SELECT * FROM equipos WHERE CodigoSala = '$CodigoSala'";

    // Ejecutar la consulta
    $query = mysqli_query($conn, $sql);

    // Verificar si se encontraron resultados
    if (mysqli_num_rows($query) > 0) {
        // Mostrar los datos de los equipos
        echo "<table>";
        echo "<tr><th>ID</th><th>Nombre Equipo</th><th>Descripcion Producto</th><th>Acciones</th></tr>";

        while ($row = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>".$row['Id']."</td>";
            echo "<td>".$row['NombreEquipo']."</td>";
            echo "<td>".$row['DescripcionProducto']."</td>";
            echo "<td>";
            // Enlace para eliminar equipo
            echo "<a href='./controller/eliminarProductoController.php?id=".$row['Id']."' class='btn btn-danger'>Eliminar</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron equipos para la sala con código: $CodigoSala";
    }

    // Cerrar la conexión
    mysqli_close($conn);
} else {
    echo "Código de sala no especificado.";
}
?>
