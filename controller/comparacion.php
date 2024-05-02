<?php
function compararArchivos($rutaArchivo1, $rutaArchivo2) {
    // Leer el contenido de los archivos
    $contenidoArchivo1 = file($rutaArchivo1);
    $contenidoArchivo2 = file($rutaArchivo2);

    // Comparar los contenidos
    if ($contenidoArchivo1 === $contenidoArchivo2) {
        echo "Los archivos coinciden en un 100%.";
    } else {
        echo "Diferencias encontradas:";
        $lineas1 = count($contenidoArchivo1);
        $lineas2 = count($contenidoArchivo2);
        $numLineas = max($lineas1, $lineas2);

        for ($i = 0; $i < $numLineas; $i++) {
            if ($i < $lineas1 && $i < $lineas2) {
                if ($contenidoArchivo1[$i] !== $contenidoArchivo2[$i]) {
                    echo "Archivo 1: " . $contenidoArchivo1[$i];
                    echo "Archivo 2: " . $contenidoArchivo2[$i];
                    echo "<br>";
                }
            } elseif ($i < $lineas1) {
                echo "Archivo 1: " . $contenidoArchivo1[$i];
                echo "<br>";
            } elseif ($i < $lineas2) {
                echo "Archivo 2: " . $contenidoArchivo2[$i];
                echo "<br>";
            }
        }
    }
}

// Rutas de los archivos a comparar
$rutaArchivo1 = 'archivo1.txt';
$rutaArchivo2 = 'archivo2.txt';

// Llamar a la función para comparar los archivos
compararArchivos($rutaArchivo1, $rutaArchivo2);
?>
