<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Equipo</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        header {
            text-align: center;
        }
        header img {
            display: inline-block;
            padding-top: 10px;
            margin-top: 20px;
        }
        .container {
            margin-top: 20px;
            text-align: center;
        }
        .btn-back {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<header>
    <a href="../administrador.php"><img src="../img/custom-logo.png" title="Unilibre - Planificación" alt="Unilibre - Planificación"></a>
</header>

<div class="container">
    <?php
    // Verificar si se ha pasado un ID a través de la URL
    if (isset($_GET['id'])) {
        // Obtener el ID del elemento desde la URL
        $id = $_GET['id'];

        // Realizar la consulta para obtener la información completa del elemento específico
        // Aquí deberías usar una consulta preparada para evitar inyecciones SQL
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

        // Consultar la base de datos para obtener la información completa del elemento con el ID proporcionado
        $sql = "SELECT InformacionCompleta FROM equipos WHERE Id = $id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar la información completa del elemento
            $row = $result->fetch_assoc();
            echo "<h2>Información Completa:</h2>";
            echo "<p>" . $row["InformacionCompleta"] . "</p>";
        } else {
            echo "No se encontró información para el ID proporcionado.";
        }

        // Cerrar la conexión
        $conn->close();
    } else {
        // Si no se proporcionó un ID a través de la URL, mostrar un mensaje de error
        echo "No se proporcionó un ID válido.";
    }
    ?>
    <a href="javascript:history.back()" class="btn btn-primary btn-back">Volver Atrás</a>
</div>

</body>
</html>
