<?php
// Verificar si se ha enviado el formulario y el ID del equipo está presente
if (isset($_POST['CodigoEquipoSala']) && !empty($_POST['CodigoEquipoSala'])) {
    // Obtener el ID del equipo desde el formulario
    $CodigoEquipoSala = $_POST['CodigoEquipoSala'];

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

    // Consulta SQL para obtener los datos del equipo por ID
    $sql = "SELECT * FROM salas WHERE EquipoId = '$CodigoEquipoSala'";

    // Ejecutar la consulta
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mostrar los datos del equipo
        echo "<table>";
        echo "<tr><th>ID</th><th>Nombre de Sala</th><th>EquipoId</th><th>VBeamId</th><th>Observaciones</th><th>Capacidad</th><th>VelocidadHash</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["Id"]."</td>";
            echo "<td>".$row["NombreSala"]."</td>";
            echo "<td>".$row["EquipoId"]."</td>";
            echo "<td>".$row["VBeamId"]."</td>";
            echo "<td>".$row["Observaciones"]."</td>";
            echo "<td>".$row["Capacidad"]."</td>";
            echo "<td>".$row["VelocidadHash"]."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron resultados para el equipo con ID: $CodigoEquipoSala";
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo "ID del equipo no especificado.";
}
?>
