@echo off

rem Inicializar el contador
set "contador=1"

:loop
rem Crear el nombre de la próxima carpeta "pc" con el contador actual
set "next_pc=pc%contador%"

rem Verificar si la carpeta ya existe, si no, crearla
if not exist %next_pc% (
    mkdir %next_pc%
    goto :next
)

rem Incrementar el contador y volver a intentar
set /a "contador+=1"
goto :loop

:next
rem Cambiar al directorio recién creado
cd %next_pc%

rem Generar archivo con información del sistema
echo Informacion del Sistema > info_pc.txt
echo ========================= >> info_pc.txt

echo. >> info_pc.txt
echo === Informacion del Sistema === >> info_pc.txt
systeminfo | findstr /C:"Nombre del sistema" /C:"Fabricante del sistema" /C:"Modelo del sistema" /C:"Tipo de sistema" >> info_pc.txt

echo. >> info_pc.txt
echo === Informacion de la CPU === >> info_pc.txt
wmic cpu get Name, Manufacturer >> info_pc.txt

echo. >> info_pc.txt
echo === Informacion de la Memoria RAM === >> info_pc.txt
wmic memorychip get Capacity, Manufacturer, Speed >> info_pc.txt

echo. >> info_pc.txt
echo === Informacion de la Tarjeta Gráfica === >> info_pc.txt
wmic path win32_videocontroller get Caption, AdapterRAM, DriverVersion >> info_pc.txt

echo. >> info_pc.txt
echo === Informacion del Disco Duro === >> info_pc.txt
wmic diskdrive get Model, Manufacturer, Size >> info_pc.txt

echo. >> info_pc.txt
echo === Informacion de la Red === >> info_pc.txt
ipconfig /all >> info_pc.txt

echo. >> info_pc.txt
echo === Informacion del Teclado === >> info_pc.txt
wmic path win32_keyboard get Description, Manufacturer >> info_pc.txt

echo. >> info_pc.txt
echo === Informacion del Mouse === >> info_pc.txt
wmic path win32_pointingdevice get Description, Manufacturer >> info_pc.txt

echo.
echo Se ha guardado la informacion en el archivo 'info_pc.txt'.
exit
