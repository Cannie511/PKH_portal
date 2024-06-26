@echo off
SETLOCAL

:: Set folder
SET MYSQL_BIN_DIR=D:\xampp\mysql\bin
SET DB_FILE_DIR=E:\workspace\phankhang\pkh-backup\database

:: Set default parameter
SET DB_NAME=phankhang
SET DB_USER=user
SET DB_PASS=abc123456
SET DB_SQL_FILE=%DB_FILE_DIR%\pkh_db_prod.sql

:: Get from parameter
if NOT [%1] == [] SET DB_NAME=%1
if NOT [%2] == [] SET DB_USER=%2
if NOT [%3] == [] SET DB_PASS=%3
if NOT [%4] == [] SET DB_SQL_FILE=%4

echo Import file %DB_FILE_DIR% into %DB_NAME% (%DB_USER%/%DB_PASS%) from %DB_SQL_FILE%
pause

REM %MYSQL_BIN_DIR%\mysql -u %DB_USER% -p%DB_PASS% %DB_NAME% < %DB_SQL_FILE%
REM %MYSQL_BIN_DIR%\mysql -h 192.168.1.7 -u %DB_USER% -p%DB_PASS% %DB_NAME% < %DB_SQL_FILE%
%MYSQL_BIN_DIR%\mysql -h 192.168.99.100 -u %DB_USER% -p%DB_PASS% %DB_NAME% < %DB_SQL_FILE%

ENDLOCAL