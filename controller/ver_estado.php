<?php
if (isset($_GET['equipo']) && !empty($_GET['equipo'])) {
    $codigoEquipo = $_GET['equipo'];

    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $database = "hvcpu";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "SELECT r.id, r.modelo, r.falla, r.fecha, r.codigo_equipo 
            FROM reporte r
            INNER JOIN ports p ON r.codigo_equipo = p.codigo_equipo
            WHERE r.codigo_equipo = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $codigoEquipo);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            echo "<p>ID: " . $row['id'] . "</p>";
            echo "<p>Modelo: " . $row['modelo'] . "</p>";
            echo "<p>Falla: " . $row['falla'] . "</p>";
            echo "<p>Fecha: " . $row['fecha'] . "</p>";
            echo "<p>Código de Equipo: " . $row['codigo_equipo'] . "</p>";
            echo "<hr>";
        }
    } else {
        echo "No se encontraron resultados para el equipo con código: $codigoEquipo";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Parámetro 'equipo' no especificado en la URL.";
}
?>
