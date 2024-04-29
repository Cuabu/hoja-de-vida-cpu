<?php
include_once('../model/dispositivoDAO.php'); // Asegúrate de que la ruta y el nombre del archivo sean correctos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $EquipoId = $_POST["EquipoId"];
    $MarcaSerial = $_POST["MarcaSerial"];
    $Observaciones = $_POST["Observaciones"];

    // Agregar el dispositivo si el EquipoId existe
    $dispositivoDAO = new DispositivoDAO(); // Asegúrate de que el nombre de la clase coincida con la definición en el archivo DispositivoDAO.php
    if ($dispositivoDAO->agregarDispositivo($EquipoId, $MarcaSerial, $Observaciones)) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error al agregar el producto.";
    }
}
?>
