<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Computadores</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    header {
        text-align: center; /* Centrar contenido dentro del header */
    }
    header img {
        display: inline-block; /* Alinear la imagen como bloque en línea */
    }
    
</style>


    <header>
        <br>
        <img src="../hoja de vida cpu/img/custom-logo.png" title="Unilibre - Planificación" alt="Unilibre - Planificación">
    </header>

    <br>

    <div class="container">
    <div class="row justify-content-center"> <!-- Centra horizontalmente los elementos de la fila -->
        <div class="col-md-4 mb-3 mx-auto"> <!-- Divide la fila en 4 columnas y centra horizontalmente -->
            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#registroModal">
                Registrarse
            </button>
        </div>
        <div class="col-md-4 mb-3 mx-auto"> <!-- Divide la fila en 4 columnas y centra horizontalmente -->
            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#iniciarSesionModal">
                Iniciar Sesión
            </button>
        </div>
    </div>
</div>


    <!-- Modales -->
    <!-- Modal de Registro -->
<div class="modal fade" id="registroModal" tabindex="-1" role="dialog" aria-labelledby="registroModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registroModalLabel">Registro de Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="./controller/registro.php" method="POST">

                    <div class="form-group">
                        <label for="nombreUsuario">Nombre de Usuario:</label>
                        <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" placeholder="Nombre de Usuario">
                    </div>

                    <div class="form-group">
                        <label for="passwdUsuario">Contraseña:</label>
                        <input type="password" class="form-control" id="passwdUsuario" name="passwdUsuario" placeholder="Contraseña">
                    </div>

                    <div class="form-group">
                        <label for="confirmarPasswd">Confirmar Contraseña:</label>
                        <input type="password" class="form-control" id="confirmarPasswd" name="confirmarPasswd" placeholder="Confirmar Contraseña">
                    </div>

                    <div class="form-group">
                        <label for="emailUsuario">Correo Electrónico:</label>
                        <input type="email" class="form-control" id="emailUsuario" name="emailUsuario" placeholder="Correo Electrónico">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" name="registroBtn">Registrarse</button>
                </div>
            </form>
        </div>
    </div>
</div>


   <!-- Modal de Iniciar Sesión -->
<div class="modal fade" id="iniciarSesionModal" tabindex="-1" role="dialog" aria-labelledby="iniciarSesionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="iniciarSesionModalLabel">Iniciar Sesión</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="./controller/login.php" method="POST">

                    <div class="form-group">
                        <label for="nombreUsuario">Nombre de Usuario:</label>
                        <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" placeholder="Nombre de Usuario">
                    </div>

                    <div class="form-group">
                        <label for="passwdUsuario">Contraseña:</label>
                        <input type="password" class="form-control" id="passwdUsuario" name="passwdUsuario" placeholder="Contraseña">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                </div>
            </form>
        </div>
    </div>
</div>

<body>
    <div class="container">
        <h1>Bienvenido a nuestro sistema de gestión de equipos</h1>
        <p>Esta página ha sido creada para controlar el registro de equipos de salas u oficinas en nuestro campus universitario. Regístrate para acceder a todas las características de gestión de datos.</p>
        
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
