@echo OFF

setlocal

if [%1]==[] goto END 
php artisan ng:component %1
php artisan ng:server %1

:END
echo [OK]

endlocal