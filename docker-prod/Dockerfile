FROM ubuntu:16.04

RUN apt update && apt install -y vim iputils-ping net-tools

# Install PHP
RUN apt-get install -y php7.0 php7.0-mysql php7.0-gd php7.0-xml php-mbstring php7.0-intl php7.0-xsl php7.0-mbstring php7.0-curl php7.0-zip

# Install composer
RUN apt update && apt-get install -y curl php-cli php-mbstring git unzip \
    && cd ~ && curl -sS https://getcomposer.org/installer -o composer-setup.php \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# Downgrade version 1
RUN composer self-update --1

WORKDIR /app/web

EXPOSE 80
EXPOSE 8080