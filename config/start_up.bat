@echo off
REM Cambia a la carpeta del proyecto
cd C:\xampp\htdocs\

REM Elimina los archivos existentes
rmdir /s /q *

REM Clona el repositorio desde GitHub
git clone https://github.com/Cuabu/hoja-de-vida-cpu.git .

REM O si deseas actualizar en lugar de clonar, puedes usar:
REM git pull origin main

REM Mensaje de éxito
echo Repositorio actualizado correctamente.
exit
