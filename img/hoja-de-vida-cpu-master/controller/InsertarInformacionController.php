<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["codigo_equipo"]) && isset($_POST["descripcion"]) && !empty($_POST["descripcion"])) {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "hvcpu";

    $codigo_equipo = $_POST['codigo_equipo'];
    $descripcion = $_POST['descripcion'];

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "INSERT INTO historial (codigo_equipo, descripcion) VALUES (?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ss", $codigo_equipo, $descripcion);

    if ($stmt->execute()) {
        echo "Datos insertados correctamente en historial.";

        header("Location: ../administrador.php");
        exit();
    } else {
        echo "Error al insertar datos en historial: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Error: No se proporcionó la descripción o está vacía.";
}
