@echo off

echo -----------------------------------------------------
echo IMPORTANT!
echo.
echo  DB will be reset. Please check connected DB
echo -----------------------------------------------------
type .\.env | findstr "DB_"
pause

php artisan migrate:rollback
php artisan migrate
php artisan db:seed --class=DbDeploySeeder