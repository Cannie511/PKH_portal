# @echo off
# php -v
#php artisan view:clear
#php artisan cache:clear

# php artisan serve --port 80 --host phankhangco.local

mkdir -p ./storage/app/public
mkdir -p ./storage/fonts
mkdir -p ./storage/framework/sessions
mkdir -p ./storage/framework/cache
mkdir -p ./storage/framework/views
mkdir -p ./storage/logs

php artisan migrate --step --force
php artisan serve --port 80 --host 0.0.0.0