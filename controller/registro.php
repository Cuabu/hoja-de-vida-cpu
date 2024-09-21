<?php
include('../config/conexion.php');

function validarDatos($dato) {
    $dato = trim($dato);
    $dato = htmlspecialchars($dato);
    return $dato;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreUsuario = validarDatos($_POST['nombreUsuario']);
    $passwdUsuario = validarDatos($_POST['passwdUsuario']);
    $emailUsuario = validarDatos($_POST['emailUsuario']);


    if (!empty($nombreUsuario) && !empty($passwdUsuario)) {
        $conexion = new Conexion();
        $conn = $conexion->conectar();

        $sql = "INSERT INTO usuario (NombreUsuario, PasswdUsuario, emailUsuario) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "sss", $nombreUsuario, $passwdUsuario, $emailUsuario);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Registro exitoso');</script>";
            header("Location: ../index.php");
        } else {
            echo "<script>alert('No se pudo registrar');</script>";
            header("Location: ../index.php");
            exit();
        }

    } else {
        echo "<script>alert('Por favor, complete todos los campos');</script>";
    }
}
?>
