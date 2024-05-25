<?php
include('../config/conexion.php');

// Función para limpiar y validar los datos ingresados
function validarDatos($dato) {
    // Eliminar espacios en blanco al inicio y al final
    $dato = trim($dato);
    // Escapar caracteres especiales para evitar inyección SQL
    $dato = htmlspecialchars($dato);
    return $dato;
}

// Verificar si se ha enviado el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y limpiar los datos del formulario
    $nombreUsuario = validarDatos($_POST['nombreUsuario']);
    $passwdUsuario = validarDatos($_POST['passwdUsuario']);
    $emailUsuario = validarDatos($_POST['emailUsuario']);


    // Verificar si los datos no están vacíos
    if (!empty($nombreUsuario) && !empty($passwdUsuario)) {
        // Crear una instancia de la conexión a la base de datos
        $conexion = new Conexion();
        $conn = $conexion->conectar();

        // Preparar la consulta SQL utilizando una consulta preparada para evitar inyección SQL
        $sql = "INSERT INTO usuario (NombreUsuario, PasswdUsuario, emailUsuario) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        // Vincular los parámetros de la consulta preparada
        mysqli_stmt_bind_param($stmt, "sss", $nombreUsuario, $passwdUsuario, $emailUsuario);

        // Ejecutar la consulta preparada
        if (mysqli_stmt_execute($stmt)) {
            // Registro exitoso
            echo "<script>alert('Registro exitoso');</script>";
            header("Location: ../index.php");
        } else {
            // Error al registrar
            echo "<script>alert('No se pudo registrar');</script>";
            // Redirigir a una página específica
            header("Location: ../index.php");
            exit();
        }

    } else {
        // Los campos están vacíos
        echo "<script>alert('Por favor, complete todos los campos');</script>";
    }
}
?>
