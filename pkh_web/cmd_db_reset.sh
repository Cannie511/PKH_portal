#!/bin/bash

echo "-----------------------------------------------------"
echo "IMPORTANT!"
echo ""
echo " DB will be reset. Please check connected DB"
echo "-----------------------------------------------------"
cat ./.env | grep "DB_"
read -t 10 -p "Press [Enter] key to start backup..."

php artisan migrate:rollback

php artisan migrate --step
# php artisan migrate --pretend --no-ansi > .\database\migrations\migrate.sql

# php artisan db:seed
# php artisan db:seed --class=TestUserSeeder