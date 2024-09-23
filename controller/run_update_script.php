<?php
// Ruta al archivo .bat
$batFile = "C:\xampp\htdocs\config\update.bat";

// Ejecutar el archivo .bat en segundo plano
$handle = popen("start /B " . escapeshellarg($batFile), 'r');

// Cerrar el manejo del proceso
pclose($handle);

// Mensaje de éxito
echo "El proyecto se está actualizando desde el repositorio.";