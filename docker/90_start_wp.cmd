docker ps -a
docker start mysql
docker start phpdev_container
docker start phpmyadmin
docker exec phpdev_container bash -c "echo '172.17.0.3 phankhangco.local www.phankhangco.local portal.phankhangco.local' >> /etc/hosts"
docker exec phpdev_container bash -c "cat /etc/hosts"
docker exec -it phpdev_container bash
rem docker exec -i -w /opt/pkh_src/pkh_web phpdev_container bash -c "./cmd_web_start.sh"