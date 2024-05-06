<?php
// Función para obtener los datos del hardware
function obtenerDatosHardware() {
    // Obtener número de serie del disco duro
    $discoDuroModeloSerial = shell_exec('wmic diskdrive get SerialNumber 2>&1');
    $discoDuroModeloSerial = explode("\n", trim($discoDuroModeloSerial));
    $discoDuroModeloSerial = isset($discoDuroModeloSerial[1]) ? trim($discoDuroModeloSerial[1]) : '';

    // Obtener dirección MAC de la interfaz Ethernet
    $macEthernetSerial = shell_exec('wmic nic where NetEnabled=true get MACAddress 2>&1');
    $macEthernetSerial = explode("\n", trim($macEthernetSerial));
    $macEthernetSerial = isset($macEthernetSerial[1]) ? trim($macEthernetSerial[1]) : '';

    // Obtener número de serie del CPU
    $cpuModeloSerial = shell_exec('wmic cpu get ProcessorId 2>&1');
    $cpuModeloSerial = explode("\n", trim($cpuModeloSerial));
    $cpuModeloSerial = isset($cpuModeloSerial[1]) ? trim($cpuModeloSerial[1]) : '';

    // Otras variables de hardware...

    // Retornar un arreglo asociativo con los datos del hardware
    return array(
        'DiscoDuroModeloSerial' => $discoDuroModeloSerial,
        'MacEthernetSerial' => $macEthernetSerial,
        'CPUModeloSerial' => $cpuModeloSerial
        // Otras variables de hardware...
    );
}

// Ejemplo de uso de la función
$datosHardware = obtenerDatosHardware();
$discoDuroModeloSerial = $datosHardware['DiscoDuroModeloSerial'];
$macEthernetSerial = $datosHardware['MacEthernetSerial'];
$cpuModeloSerial = $datosHardware['CPUModeloSerial'];

// Insertar datos en la base de datos...
?>
