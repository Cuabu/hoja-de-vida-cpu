@echo off
REM 
start /B pythonw server.py

REM 
timeout /t 3 > nul

REM 
start /B pythonw agente.py

REM 
echo Scripts iniciados en segundo plano.
