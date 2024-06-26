docker run --name phpdev_container -d -it \
    -p 82:80 \
    --mount type=bind,src="G:\TaskPKH\pkh_project",dst="/opt/pkh_project" \
    -w "/opt/pkh_project/pkh_web" \
    --link mysql:db \
    --hostname "pkhweb" \
    phpdev /bin/bash

./21_add_host.sh