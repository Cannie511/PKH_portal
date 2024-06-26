@echo off
setlocal

SET SRC_DIR=packages
SET DEST_DIR=vendor

xcopy %SRC_DIR%\laravelangular %DEST_DIR%\laravelangular /E /C /I /R /Y /Q

echo Finish.

endlocal