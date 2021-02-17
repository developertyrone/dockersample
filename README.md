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

8. curl http://<your_podman_host_ip>:8080/sqlconnect.php

# To run in openshift
0. oc create testproject

1. git clone https://github.com/developertyrone/dockersample

2. buildah bud -v /var/cache/dnf:/var/cache/dnf:O --layers -t sqlsrv .

3. oc create is mydb

4. podman tag localhost/sqlsrv <image-registry-external-route>/testproject/mydb

5. podman push <image-registry-external-route>/testproject/mydb

6. oc new-app mytest/mydb:latest --context-dir=php/ --name=db

7. oc new-app https://github.com/developertyrone/dockersample --context-dir=php/ --name=php -e DB_HOST=db -e DB_NAME=heroes -e DB_TABLE=HeroValue -e DB_USER=SA -e DB_PASS=Password1!

8. oc expose svc php

9. HOST=$(oc get route php -n testproject --template='{{ .spec.host }}')

10. curl http://$HOST/sqlconnect.php

# Remark
1. please remove the testing block in dockerfile for production release

# Another way to deploy Mssql in openshift
https://developers.redhat.com/blog/2020/10/27/using-microsoft-sql-server-on-red-hat-openshift/