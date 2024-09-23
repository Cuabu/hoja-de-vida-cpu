<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Redirección a otra página</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        text-align: center;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 400px;
    }

    h1 {
        font-size: 24px;
        color: #333;
    }

    p {
        font-size: 18px;
        color: #666;
    }
    </style>
    <script>
    // Redireccionar a la página destino al cargar el documento
    window.onload = function() {
        window.location.href = "./administrador.php";
    };
    </script>
</head>

<body>
    <div class="container">
        <h1>Redireccionando...</h1>
        <p>Por favor, espera un momento...</p>
    </div>
</body>

</html>