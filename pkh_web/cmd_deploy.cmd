@echo off
setlocal

SET DEST_DIR=..\deploy\src

pause

:: build frontend
cd client
call gulp --production

:: build backend
cd ..
call gulp --production

php artisan optimize --force

rd %DEST_DIR% /S /Q
mkdir %DEST_DIR%

:: copy all file
echo Copying app...
xcopy app %DEST_DIR%\app /E /C /I /R /Y /Q

echo Copying bootstrap...
xcopy bootstrap %DEST_DIR%\bootstrap /E /C /I /R /Y /Q

echo Copying config...
xcopy config %DEST_DIR%\config /E /C /I /R /Y /Q

echo Copying public...
mkdir %DEST_DIR%\public
xcopy public\frontend %DEST_DIR%\public\frontend /E /C /I /R /Y /Q
xcopy public\img\product %DEST_DIR%\public\img\product /E /C /I /R /Y /Q
REM copy public\*.* %DEST_DIR%\public\  /B /Y
REM del %DEST_DIR%\public\upload*.* /F /S /Q
REM rd %DEST_DIR%\public\backend /S /Q
REM mkdir %DEST_DIR%\uploads
REM rd %DEST_DIR%\public\resources\lib /S /Q

:: copy lang and views folder only
mkdir %DEST_DIR%\resources /a
echo Copying resources...
xcopy resources %DEST_DIR%\resources /E /C /I /R /Y /Q

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

copy .env.production %DEST_DIR%\.env  /B /Y

:: For portal
mkdir %DEST_DIR%\portal

echo Copying portal...
mkdir %DEST_DIR%\portal
mkdir %DEST_DIR%\portal\css
xcopy public\css %DEST_DIR%\portal\css /E /C /I /R /Y /Q
xcopy public\backend %DEST_DIR%\portal\backend /E /C /I /R /Y /Q
xcopy public\fonts %DEST_DIR%\portal\fonts /E /C /I /R /Y /Q
xcopy public\img %DEST_DIR%\portal\img /E /C /I /R /Y /Q
xcopy public\amcharts %DEST_DIR%\portal\amcharts /E /C /I /R /Y /Q
rem xcopy public\img %DEST_DIR%\portal\img /E /C /I /R /Y /Q
xcopy public\js %DEST_DIR%\portal\js /E /C /I /R /Y /Q
copy public\favicon.icon %DEST_DIR%\portal\favicon.icon  /B /Y
del %DEST_DIR%\portal\css\app*.* /F /S /Q
del %DEST_DIR%\portal\css\vendor*.* /F /S /Q
del %DEST_DIR%\portal\js\app*.* /F /S /Q
del %DEST_DIR%\portal\js\partials*.* /F /S /Q
del %DEST_DIR%\portal\js\vendor*.* /F /S /Q
del %DEST_DIR%\portal\css\final-customer.*.* /F /S /Q
del %DEST_DIR%\portal\js\final-customer.* /F /S /Q

:: For customer
mkdir %DEST_DIR%\customer

echo Copying customer...
mkdir %DEST_DIR%\customer
mkdir %DEST_DIR%\customer\css
xcopy public\css %DEST_DIR%\customer\css /E /C /I /R /Y /Q
xcopy public\backend %DEST_DIR%\customer\backend /E /C /I /R /Y /Q
xcopy public\fonts %DEST_DIR%\customer\fonts /E /C /I /R /Y /Q
rem xcopy public\img %DEST_DIR%\customer\img /E /C /I /R /Y /Q
xcopy public\js %DEST_DIR%\customer\js /E /C /I /R /Y /Q
copy public\favicon.icon %DEST_DIR%\customer\favicon.icon  /B /Y
del %DEST_DIR%\customer\css\app*.* /F /S /Q
del %DEST_DIR%\customer\css\vendor*.* /F /S /Q
del %DEST_DIR%\customer\js\app*.* /F /S /Q
del %DEST_DIR%\customer\js\partials*.* /F /S /Q
del %DEST_DIR%\customer\js\vendor*.* /F /S /Q
del %DEST_DIR%\customer\css\final.*.* /F /S /Q
del %DEST_DIR%\customer\js\final.* /F /S /Q

del %DEST_DIR%\frontend\img\.htaccess /F /S /Q

echo Finish.

endlocal