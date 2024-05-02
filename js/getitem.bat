@echo off

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
pause

REM Abrir la página web con la información
start "" "www.google.com"
