# dockersample

# To run in podman
1. git clone https://github.com/developertyrone/dockersample

2. cd sqlsrv

3. buildah bud -v /var/cache/dnf:/var/cache/dnf:O --layers -t sqlsrv .

4. podman run --name db -p 1433:1433 -dt sqlsrv

5. cd phpmysql

6. buildah bud -v /var/cache/dnf:/var/cache/dnf:O --layers -t php .

7. podman run --name appserver -p 8080:8080 -dt -e DB_HOST=<your_podmanhost_ip> -e DB_NAME=heroes -e DB_TABLE=HeroValue -e DB_USER=SA -e DB_PASS=Password1! php

podman run --name appserver -p 8080:8080 -dt -e DB_HOST=192.168.1.140 -e DB_NAME=heroes -e DB_TABLE=HeroValue -e DB_USER=SA -e DB_PASS=Password1! php

8. http://<your_podman_host_ip>:8080/index.php

# To run in openshift
1. oc new-project myproj
2. oc new-app https://github.com/developertyrone/dockersample --context-dir=php/ --name=php
3. oc logs -f bc/php
4. oc get pod
5. oc expose svc php


oc new-app https://github.com/developertyrone/dockersample --context-dir=sqlsrv --name=db


# Remark
1. please remove the testing block in dockerfile for production release
