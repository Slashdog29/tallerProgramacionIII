@echo off
REM control_cyber.bat
REM Agente por lotes para Windows que consulta el endpoint verificar_estado.php
REM Requisitos: PowerShell disponible en la máquina cliente

REM ---------------------------------------------------------------
REM CONFIGURAR: Cambia la variable SERVER_URL a la dirección de tu servidor
REM Ejemplo: set SERVER_URL=http://192.168.1.100/Cyber-Center/src
REM Si pones verificar_estado.php en otra ruta, actualiza la llamada.
REM ---------------------------------------------------------------
set SERVER_URL=http://TU_SERVIDOR/Cyber-Center/src

:bucle
REM Obtener respuesta JSON del servidor de forma silenciosa
for /f "usebackq delims=" %%A in (`powershell -NoProfile -Command "(Invoke-WebRequest -UseBasicParsing -Uri '%SERVER_URL%/verificar_estado.php' -TimeoutSec 10).Content"`) do set RESPONSE=%%A

REM Comprobar si la respuesta contiene la instrucción de bloqueo
echo %RESPONSE% | findstr /C:"\"accion\":\"bloquear\"" >nul
if %ERRORLEVEL%==0 (
    REM Si se pidió bloquear, expulsar al usuario local cerrando la sesión interactiva
    REM El comando shutdown /l cierra la sesión del usuario actual inmediatamente.
    shutdown /l
)

REM Esperar 30 segundos antes de la siguiente consulta
timeout /t 30 /nobreak >nul
goto :bucle

REM FIN control_cyber.bat
