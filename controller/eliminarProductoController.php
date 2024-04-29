<?php
include_once('../model/productoDAO.php'); 

$id = $_GET['id']; 
$productoDAO = new ProductoDAO(); //Crear instancia

if ($productoDAO->eliminarProducto($id)) { //Llamar al metodo 
    
    header("Location: ../index.php");
    exit(); 
} else {
    echo "Error al eliminar el producto.";
}
?>
