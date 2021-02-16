# podman run -it registry.access.redhat.com/ubi8/ubi /bin/bash

# podman start -ai mybash

# podman rm -fa

# podman run -d --ip=10.88.0.44 registry.access.redhat.com/rhel7/rsyslog
efde5f0a8c723f70dd5cb5dc3d5039df3b962fae65575b08662e0d5b5f9fbe85
# podman inspect efde5f0a8c723 | grep 10.88.0.44
"IPAddress": "10.88.0.44",

# buildah bud -t phpmysql
# time  buildah bud -v /var/cache/dnf:/var/cache/dnf:O --layers -t phpmysql .

https://access.redhat.com/documentation/en-us/red_hat_enterprise_linux/8/html/building_running_and_managing_containers/working-with-containers-and-pods_building-running-and-managing-containers

https://hub.docker.com/r/reynier3mil/centos-php-fpm-msphpsql/dockerfile

https://github.com/containers/buildah/blob/master/docs/buildah-bud.md

# time  buildah bud -v /var/cache/dnf:/var/cache/dnf:O --layers -t php .
# time  buildah bud -v /var/cache/dnf:/var/cache/dnf:O --layers -t sqlsrv .
# podman run --name appserver -p 8080:8080 -d php
# podman run --name db -p 1433:1433 -d sqlsrv

# podman run --name appserver  -p 8080:8080 -dt -e DB_HOST=192.168.1.140 -e DB_NAME=heroes -e DB_TABLE=HeroValue -e DB_USER=SA -e DB_PASS=Password1! php
# podman run --name db -p 1433:1433 -dt sqlsrv

# podman pod create --name webservice -p 8080:80
# podman run -dt --name appserver --pod webservice php

# podman pod create --name db -p 3306:3306
# podman run -dt --name mssql --pod db mssql


https://sysadmin-journal.com/understand-podman-networking/
https://www.redhat.com/sysadmin/container-networking-podman
https://stackoverflow.com/questions/60558185/is-it-possible-to-run-two-containers-in-same-port-in-same-pod-by-podman
https://developers.redhat.com/blog/2019/01/15/podman-managing-containers-pods/