#/bin/sh
echo "* Installing"
cd /app/web && php composer.phar install

echo "* Copying environment files"
cp -f /app/.env /app/web/.env

echo "* Start web"
cd /app/web && /app/web/cmd_web_start.sh