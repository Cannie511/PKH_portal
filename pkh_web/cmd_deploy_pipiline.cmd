@echo off
setlocal

SET DEST_DIR=..\..\pkh_deploy

echo Copy to %DEST_DIR%
pause

:: build frontend
cd client
call gulp --production

:: build backend
cd ..
call gulp --production

php artisan optimize --force

:: delete old file
rd %DEST_DIR%\app /S /Q
rd %DEST_DIR%\bootstrap /S /Q
rd %DEST_DIR%\config /S /Q
rd %DEST_DIR%\customer /S /Q
rd %DEST_DIR%\portal /S /Q
rd %DEST_DIR%\public /S /Q
rd %DEST_DIR%\resources /S /Q
REM rd %DEST_DIR%\vendor /S /Q

:: copy all file
echo Copying app...
xcopy app %DEST_DIR%\app /E /C /I /R /Y /Q
xcopy bootstrap %DEST_DIR%\bootstrap /E /C /I /R /Y /Q
xcopy config %DEST_DIR%\config /E /C /I /R /Y /Q
REM xcopy public %DEST_DIR%\public /E /C /I /R /Y /Q
xcopy resources %DEST_DIR%\resources /E /C /I /R /Y /Q
REM xcopy vendor %DEST_DIR%\vendor /E /C /I /R /Y /Q

echo Copying public...
mkdir %DEST_DIR%\public
xcopy public\frontend %DEST_DIR%\public\frontend /E /C /I /R /Y /Q
xcopy public\img\product %DEST_DIR%\public\img\product /E /C /I /R /Y /Q

:: copy structure of storage
echo Creating storage...
mkdir %DEST_DIR%\storage\app
mkdir %DEST_DIR%\storage\framework\cache
mkdir %DEST_DIR%\storage\framework\sessions
mkdir %DEST_DIR%\storage\framework\views
mkdir %DEST_DIR%\storage\logs

:: copy other file
echo Copying vendor...
mkdir %DEST_DIR%\vendor
copy vendor\autoload.php %DEST_DIR%\vendor\autoload.php  /B /Y
copy vendor\compiled.php %DEST_DIR%\vendor\compiled.php  /B /Y
copy vendor\services.json %DEST_DIR%\vendor\services.json  /B /Y

REM copy .env.production %DEST_DIR%\.env  /B /Y

:: For public
mkdir %DEST_DIR%\public
xcopy public\email_signature %DEST_DIR%\public\email_signature /E /C /I /R /Y /Q
xcopy public\frontend %DEST_DIR%\public\frontend /E /C /I /R /Y /Q
xcopy public\img %DEST_DIR%\public\img /E /C /I /R /Y /Q

:: For portal
mkdir %DEST_DIR%\portal
xcopy public\amcharts %DEST_DIR%\portal\amcharts /E /C /I /R /Y /Q
xcopy public\backend %DEST_DIR%\portal\backend /E /C /I /R /Y /Q
xcopy public\css %DEST_DIR%\portal\css /E /C /I /R /Y /Q
xcopy public\fonts %DEST_DIR%\portal\fonts /E /C /I /R /Y /Q
xcopy public\img %DEST_DIR%\portal\img /E /C /I /R /Y /Q
xcopy public\js %DEST_DIR%\portal\js /E /C /I /R /Y /Q

del %DEST_DIR%\portal\css\app*.* /F /S /Q
del %DEST_DIR%\portal\css\vendor*.* /F /S /Q
del %DEST_DIR%\portal\js\app*.* /F /S /Q
del %DEST_DIR%\portal\js\partials*.* /F /S /Q
del %DEST_DIR%\portal\js\vendor*.* /F /S /Q
del %DEST_DIR%\portal\css\final-customer.*.* /F /S /Q
del %DEST_DIR%\portal\js\final-customer.* /F /S /Q
del %DEST_DIR%\portal\img\product\*.* /F /S /Q
rd %DEST_DIR%\portal\img\product /S /Q

:: copy env-config
echo copy env-config
xcopy %DEST_DIR%\env-config %DEST_DIR% /E /C /I /R /Y /Q

del %DEST_DIR%\public\crash*.txt /F /S /Q

:: For customer
REM mkdir %DEST_DIR%\customer

REM echo Copying customer...
REM mkdir %DEST_DIR%\customer
REM mkdir %DEST_DIR%\customer\css
REM xcopy public\css %DEST_DIR%\customer\css /E /C /I /R /Y /Q
REM xcopy public\backend %DEST_DIR%\customer\backend /E /C /I /R /Y /Q
REM xcopy public\fonts %DEST_DIR%\customer\fonts /E /C /I /R /Y /Q
REM rem xcopy public\img %DEST_DIR%\customer\img /E /C /I /R /Y /Q
REM xcopy public\js %DEST_DIR%\customer\js /E /C /I /R /Y /Q
REM copy public\favicon.icon %DEST_DIR%\customer\favicon.icon  /B /Y
REM del %DEST_DIR%\customer\css\app*.* /F /S /Q
REM del %DEST_DIR%\customer\css\vendor*.* /F /S /Q
REM del %DEST_DIR%\customer\js\app*.* /F /S /Q
REM del %DEST_DIR%\customer\js\partials*.* /F /S /Q
REM del %DEST_DIR%\customer\js\vendor*.* /F /S /Q
REM del %DEST_DIR%\customer\css\final.*.* /F /S /Q
REM del %DEST_DIR%\customer\js\final.* /F /S /Q

REM del %DEST_DIR%\frontend\img\.htaccess /F /S /Q

echo Finish.

endlocal