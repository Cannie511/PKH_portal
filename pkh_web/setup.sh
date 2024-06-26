
mkdir -p storage/app
mkdir -p storage/fonts
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs

php composer.phar install

cp ../.env ./.env