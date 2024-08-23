REM docker run --rm --name phpdev_container -d -p 8000:8000 -w "/opt/pkh_src" phpdev /bin/bash
REM docker run --name phpdev_container -d -it -p 8000:8000 -w "/opt/pkh_src" phpdev /bin/bash
REM docker run --rm --name phpdev_container -d -p 8000:8000 --mount type=bind,src="/pkh_src",dst="/opt/pkh_src" -w "/opt/pkh_src" phpdev /bin/bash
REM docker run --rm --name phpdev_container -d -p 8000:8000 --mount type=bind,src="D:/home/phankhang/workspace/pkh_src/pkh_web",dst="/opt/pkh_web" -w "/opt/pkh_web" phpdev /bin/bash

docker run --name phpdev_container -d -it -p 82:80 --link mysql:db --mount type=bind,src="G:\TaskPKH\pkh_project\",dst="/opt/pkh_project" -w "/opt/pkh_project" phpdev /bin/bash


REM docker run --name phpdev_container -d -it -p 80:80 --link mysql:db --mount type=bind,src="/Users/cuongnp/home/workspace/bitbucket/phankhang/pkh_src",dst="/opt/pkh_src" -w "/opt/pkh_src" phpdev /bin/bash

REM Linux
REM docker run --name phpdev_container -d -it -p 80:80 --mount type=bind,src="$(pwd)"/../../pkh_src,dst="/opt/pkh_src" -w "/opt/pkh_src" --link mysql:db phpdev /bin/bash