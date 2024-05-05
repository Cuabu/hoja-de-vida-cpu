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

// Verificar si se ha enviado el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y limpiar los datos del formulario
    $nombreUsuario = validarDatos($_POST['nombreUsuario']);
    $passwdUsuario = validarDatos($_POST['passwdUsuario']);

    // Verificar si los datos no están vacíos
    if (!empty($nombreUsuario) && !empty($passwdUsuario)) {
        // Crear una instancia de la conexión a la base de datos
        $conexion = new Conexion();
        $conn = $conexion->conectar();

        // Preparar la consulta SQL utilizando una consulta preparada para evitar inyección SQL
        $sql = "SELECT Id FROM usuario WHERE NombreUsuario = ? AND PasswdUsuario = ?";
        $stmt = mysqli_prepare($conn, $sql);

        // Vincular los parámetros de la consulta preparada
        mysqli_stmt_bind_param($stmt, "ss", $nombreUsuario, $passwdUsuario);

        // Ejecutar la consulta preparada
        mysqli_stmt_execute($stmt);

        // Obtener el resultado de la consulta
        mysqli_stmt_store_result($stmt);
        $rowCount = mysqli_stmt_num_rows($stmt);

        // Si se encuentra un usuario con las credenciales proporcionadas, redirigir a otra página
        if ($rowCount == 1) {
            // Guardar el nombre de usuario en la sesión para mantener la sesión activa
            $_SESSION['nombreUsuario'] = $nombreUsuario;
            // Redirigir a otra página
            header("Location: ../administrador.php");
            exit();
        } else {
            // Si no se encuentra un usuario con las credenciales proporcionadas, mostrar un mensaje de error
            echo "<script>alert('Usuario no encontrado');</script>";
        }

 
    } else {
        // Los campos están vacíos
        echo "<script>alert('Por favor, complete todos los campos');</script>";
    }
}
?>
