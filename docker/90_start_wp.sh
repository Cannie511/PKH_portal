docker ps -a

EXIST_MYSQL=$(docker ps | grep "mysql")
if [ -z "$EXIST_MYSQL" ]
then
    docker start mysql
fi

EXIST_PHPMYADMIN=$(docker ps | grep "phpmyadmin")
if [ -z "$EXIST_PHPMYADMIN" ]
then
    docker start phpmyadmin
fi

EXIST_CONTAINER=$(docker ps -a | grep "phpdev_container")
if [ -z "$EXIST_CONTAINER" ]
then
    ./20_start_docker.sh
fi

docker start phpdev_container
./21_add_host.sh
docker exec phpdev_container bash -c "cat /etc/hosts"
docker exec -it phpdev_container bash
# docker exec -i -w /opt/pkh_src/pkh_web phpdev_container bash -c "./cmd_web_start.sh"