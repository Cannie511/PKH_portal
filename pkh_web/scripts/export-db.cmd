@echo off
SETLOCAL

:: Set folder
SET MYSQL_BIN_DIR=D:\xampp\mysql\bin
SET EXPORT_DB_DIR=D:\home\phankhang\workspace\db

:: Set default parameter
SET DB_NAME=phankhang2
SET DB_USER=user
SET DB_PASS=abc123456

:: Get from parameter
if NOT [%1] == [] SET DB_NAME=%1
if NOT [%2] == [] SET DB_USER=%2
if NOT [%3] == [] SET DB_PASS=%3

set mydate=%date:/=%
set mytime=%time::=%
set mytimestamp=%mydate: =_%_%mytime:.=_%
set mytimestamp=%mytimestamp: =%

echo %mytimestamp%
SET FILENAME=%DB_NAME%_%mytimestamp%.sql

echo Export file %DB_FILE_DIR% into %DB_NAME% (%DB_USER%/%DB_PASS%) to %EXPORT_DB_DIR%\%FILENAME%
pause

%MYSQL_BIN_DIR%\mysqldump -h 192.168.0.101 -u %DB_USER% -p%DB_PASS% %DB_NAME% --no-data --skip-opt > %EXPORT_DB_DIR%\%FILENAME%
echo Finish.

ENDLOCAL