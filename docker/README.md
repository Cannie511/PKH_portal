
# Mysql Docker

- Mysql 5.7
```
docker run -dit --name mysql -p 3306:3306 -e MYSQL_ROOT_PASSWORD=abc123456 --platform=linux/x86_64 -d mysql:5.7
```

- PhpMyAdmin
```
docker run --name phpmyadmin --platform=linux/x86_64 -d --link mysql:db -p 8080:8080 -e MYSQL_ROOT_PASSWORD=abc123456 phpmyadmin/phpmyadmin
docker run --name phpmyadmin  --platform=linux/x86_64 -d --link mysql:db -p 8081:80 -e MYSQL_ROOT_PASSWORD=abc123456 phpmyadmin/phpmyadmin
```


```sql
CREATE DATABASE phankhang CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE DATABASE phankhang2 CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE USER 'user'@'%' IDENTIFIED BY 'abc123456';
CREATE USER 'user'@'localhost' IDENTIFIED BY 'abc123456';

GRANT ALL PRIVILEGES ON phankhang.* TO 'user'@'%';
GRANT ALL PRIVILEGES ON phankhang2.* TO 'user'@'%';

GRANT ALL PRIVILEGES ON phankhang.* TO 'user'@'localhost';
GRANT ALL PRIVILEGES ON phankhang2.* TO 'user'@'localhost';
```

- /etc/hosts

```
172.17.0.3  phankhangco.local
172.17.0.3  www.phankhangco.local
172.17.0.3  portal.phankhangco.local
```

- Upgrate php
  + https://stackoverflow.com/questions/61509312/how-can-i-install-php7-4-on-ubuntu-19-04
  + https://www.digitalocean.com/community/questions/how-to-upgrade-php-7-0-33-to-7-4-7-on-ubuntu-16-04-nginx
  + https://www.digitalocean.com/community/questions/how-to-upgrade-php-7-0-33-to-7-4-7-on-ubuntu-16-04-nginx

- Update PDF

```
composer require "dompdf/dompdf:0.8.4"
composer require "barryvdh/laravel-dompdf:0.8.4"
```