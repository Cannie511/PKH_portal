HOST_IP=$(docker inspect phpdev_container | grep "                    \"IPAddress\"" | egrep -o '[0-9\.]+')
echo $HOST_IP

docker exec phpdev_container bash -c "echo \"$HOST_IP phankhangco.local www.phankhangco.local portal.phankhangco.local\" >> /etc/hosts"
docker exec phpdev_container bash -c "cat /etc/hosts"


