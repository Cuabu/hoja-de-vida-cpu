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

// Inicializar un array para almacenar los mensajes de confirmación
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
        // Agregar mensaje de confirmación al array
        $confirmationMessages[] = "El archivo $nombre_archivo se ha subido y registrado correctamente en la base de datos.";
    } else {
        // Agregar mensaje de error al array
        $confirmationMessages[] = "Error al registrar el archivo $nombre_archivo en la base de datos: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}

// Mostrar mensajes de confirmación en una ventana emergente usando JavaScript
echo "<script>";
foreach ($confirmationMessages as $message) {
    echo "alert('$message');";
}
// Redireccionar de vuelta a la página principal
echo "window.location.href = '../administrador.php';";
echo "</script>";
?>
