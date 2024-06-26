echo "172.17.0.3 phankhangco.local portal.phankhangco.local www.phankhangco.local" >> /etc/hosts
tail /etc/hosts
#$HOST_IP=$(ifconfig | grep "          inet addr:172" | egrep -m 1 -o '[0-9\.]+')
#echo $HOST_IP