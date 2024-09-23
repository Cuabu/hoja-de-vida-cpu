@echo off
REM Cambia a la carpeta del proyecto en XAMPP
cd C:\xampp\htdocs

REM Verifica si el repositorio ya está clonado
IF EXIST "hoja-de-vida-cpu" (
    echo El repositorio ya está clonado. Actualizando...
    cd hoja-de-vida-cpu
    git pull
) ELSE (
    echo Clonando el repositorio...
    git clone https://github.com/Cuabu/hoja-de-vida-cpu.git
)

REM Mensaje de confirmación
echo El repositorio ha sido actualizado con éxito.
pause
