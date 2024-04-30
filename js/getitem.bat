@echo off
setlocal

rem Simulación de información del mouse y teclado en Batch
rem Obtener la posición del cursor (simulado)
set "cursor_x=100"
set "cursor_y=200"

rem Simular detección de tecla (por ejemplo, tecla 'A')
set "tecla=A"

rem Imprimir la información simulada
echo Posición del cursor: (%cursor_x%, %cursor_y%)
echo Tecla presionada: %tecla%

rem Finalizar script
exit /b
