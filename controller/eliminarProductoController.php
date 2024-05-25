<?php
include_once('../model/productoDAO.php'); 

$id = $_GET['id']; 
$productoDAO = new ProductoDAO(); //Crear instancia

if ($productoDAO->eliminarProducto($id)) { //Llamar al metodo 
    
    header("Location: ../administrador.php");
    exit(); 
} else {
    echo "Error al eliminar el producto.";
}
?>
