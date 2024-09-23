<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Computadores</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    header {
        text-align: center;
    }

    header img {
        display: inline-block;
        padding-top: 10px;
        margin-top: 10px;
    }

    .button-container {
        border: 1.5px solid black;
        padding: 20px;
        margin-bottom: 10px;
        background-color: #d68681;
        margin: 0 auto;
        overflow: hidden;
        margin-left: 20px;
        margin-right: 20px;
    }

    .button-container button {
        margin-bottom: 7px;
    }

    .acciones-column {
        width: 250px;
    }

    .acciones-column .btn {
        margin-bottom: 5px;
    }
    </style>
</head>

<body>
    <header>
        <img src="../img/custom-logo.png" title="Unilibre - Planificación" alt="Unilibre - Planificación">
    </header>
    <br>

    <div class="button-container">
        <div class="container">
            <button onclick="goBack()" class="custom-button">Atrás</button>
        </div>
    </div>

    <script>
    function goBack() {
        window.history.back();
    }
    </script>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $host = 'localhost';
        $username = 'root';
        $password = ''; 
        $dbName = 'hvcpu';

        $conn = new mysqli($host, $username, $password, $dbName);

        
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        $modelo = $_POST['modelo'];
        $falla = $_POST['falla'];
        $codigo_equipo = $_POST['codigo_equipo'];

        if (empty($modelo) || empty($falla) || empty($codigo_equipo)) {
            echo "<script>alert('Todos los campos son obligatorios.');</script>";
            echo "<script>window.location.href = '../administrador.php';</script>";
            exit;
        }

        $sql = "INSERT INTO reporte (modelo, falla, fecha, codigo_equipo) VALUES ('$modelo', '$falla', NOW(), '$codigo_equipo')";

        if ($conn->query($sql) === TRUE) {
            $message = "Se ha registrado correctamente el reporte para el equipo con código $codigo_equipo.";
        } else {
            $message = "Error al registrar el reporte en la base de datos: " . $conn->error;
        }

        $conn->close();

        echo "<script>alert('$message');</script>";
        echo "<script>window.location.href = '../administrador.php';</script>";
    } else {
        echo "<script>window.location.href = '../administrador.php';</script>";
    }
    ?>
</body>

</html>