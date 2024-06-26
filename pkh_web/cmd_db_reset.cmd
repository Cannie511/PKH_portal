@echo off

echo -----------------------------------------------------
echo IMPORTANT!
echo.
echo  DB will be reset. Please check connected DB
echo -----------------------------------------------------
type .\.env | findstr "DB_"
pause

php artisan migrate:rollback
php artisan migrate --step
REM php artisan migrate --pretend --no-ansi > .\database\migrations\migrate.sql
php artisan db:seed

REM php artisan db:seed --class=TestUserSeeder