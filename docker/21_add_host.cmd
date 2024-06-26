@echo OFF
setlocal

HOST_IP=$(docker inspect phpdev_container | grep "                    \"IPAddress\"" | egrep -o '[0-9\.]+')
echo $HOST_IP

REM docker exec phpdev_container bash -c "echo \"$HOST_IP phankhangco.local www.phankhangco.local portal.phankhangco.local\" >> /etc/hosts"
REM docker exec phpdev_container bash -c "cat /etc/hosts"

endlocal