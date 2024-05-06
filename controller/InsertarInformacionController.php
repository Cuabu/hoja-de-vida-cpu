<?php
// Verificar si se ha enviado el formulario y si el campo InformacionCompleta no está vacío
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Id"]) && !empty($_POST["InformacionCompleta"])) {
    // Configuración de la conexión a la base de datos
    $servername = "localhost"; // Cambia esto por tu servidor de base de datos
    $username = "root"; // Cambia esto por tu nombre de usuario de MySQL
    $password = "114412345@"; // Cambia esto por tu contraseña de MySQL
    $database = "hvcpu"; // Cambia esto por el nombre de tu base de datos

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener los datos del formulario
    $Id = $_POST['Id'];
    $InformacionCompleta = $_POST['InformacionCompleta'];

    // Preparar la consulta SQL
    $sql = "UPDATE equipos SET InformacionCompleta = ? WHERE Id = ?";

    // Preparar la declaración
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros
    $stmt->bind_param("si", $InformacionCompleta, $Id); // Tipo de dato "s" para string y "i" para integer

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Datos actualizados correctamente.";
        header("Location: ../administrador.php");
        exit();
    } else {
        echo "Error al actualizar datos: " . $conn->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
} else {
    echo "Error: No se proporcionó la InformacionCompleta o está vacía.";
}
?>
