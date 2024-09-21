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
    ini_set('upload_max_filesize', '3KB');

    $errores = $_FILES['file']['error'];
    foreach ($errores as $error) {
        if ($error !== UPLOAD_ERR_OK) {
            echo "Error al subir el archivo: " . intval($error);
            exit;
        }
    }

    $confirmationMessages = array();

    foreach ($_FILES['file']['name'] as $clave => $nombre_archivo) {

        $nombre_tmp = $_FILES['file']['tmp_name'][$clave];
        $fileExt = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));

        if ($fileExt !== 'sql') {
            echo "Solo se permiten archivos .sql.";
            exit;
        }

        $uploadDir = '../uploads/';
        $uploadFile = $uploadDir . basename($nombre_archivo);

        if (!move_uploaded_file($nombre_tmp, $uploadFile)) {
            echo "Error al subir el archivo.";
            exit;
        }

        $host = 'localhost';
        $username = 'root';
        $password = ''; 
        $dbName = 'hvcpu';

        $conn = new mysqli($host, $username, $password, $dbName);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        $ruta_archivo = $uploadFile;
        $sql = "INSERT INTO archivos_sql (nombre_archivo, ruta_archivo) VALUES ('$nombre_archivo', '$ruta_archivo')";

        if ($conn->query($sql) === TRUE) {
            $confirmationMessages[] = "El archivo $nombre_archivo se ha subido y registrado correctamente en la base de datos.";
        } else {
            $confirmationMessages[] = "Error al registrar el archivo $nombre_archivo en la base de datos: " . $conn->error;
        }

        $conn->close();
    }

    echo "<script>";
    foreach ($confirmationMessages as $message) {
        echo "alert('$message');";
    }
    echo "window.location.href = '../administrador.php';";
    echo "</script>";
    ?>
</body>

</html>