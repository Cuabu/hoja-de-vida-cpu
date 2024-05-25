<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Computadores</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        header {
            text-align: center; /* Centrar contenido dentro del header */
        }
        header img {
            display: inline-block; /* Alinear la imagen como bloque en línea */
            padding-top: 10px;
            margin-top: 10px;
        }
        /* Estilos para el contenedor */
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

        /* Estilos para los botones */
        .button-container button {
            margin-bottom: 7px; /* Margen inferior entre los botones */
        }

        .acciones-column {
            width: 250px; /* Ancho ajustable según necesidades */
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

    // Establecer el límite de tamaño máximo de archivo permitido
    ini_set('upload_max_filesize', '3KB');

    // Verificar si se ha enviado un archivo y si no hay errores
    $errores = $_FILES['file']['error'];
    foreach ($errores as $error) {
        if ($error !== UPLOAD_ERR_OK) {
            echo "Error al subir el archivo: " . intval($error);
            exit;
        }
    }

    $confirmationMessages = array();

    // Iterar sobre cada archivo para procesarlo
    foreach ($_FILES['file']['name'] as $clave => $nombre_archivo) {
        // Obtener información sobre el archivo actual
        $nombre_tmp = $_FILES['file']['tmp_name'][$clave];
        $fileExt = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));

        // Verificar la extensión del archivo
        if ($fileExt !== 'sql') {
            echo "Solo se permiten archivos .sql.";
            exit;
        }

        // Directorio de destino donde se almacenará el archivo
        $uploadDir = '../uploads/';
        // Ruta completa del archivo en el servidor
        $uploadFile = $uploadDir . basename($nombre_archivo);

        // Mover el archivo al directorio de destino
        if (!move_uploaded_file($nombre_tmp, $uploadFile)) {
            echo "Error al subir el archivo.";
            exit;
        }

        // Conexión a la base de datos
        $host = 'localhost';
        $username = 'root';
        $password = '114412345@'; // Cambiar por tu contraseña
        $dbName = 'hvcpu';

        $conn = new mysqli($host, $username, $password, $dbName);

        // Verificar si la conexión es exitosa
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Insertar información sobre el archivo en la base de datos
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
