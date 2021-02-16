# dockersample

# To run in podman
1. git clone https://github.com/developertyrone/dockersample

2. cd sqlsrv

3. buildah bud -v /var/cache/dnf:/var/cache/dnf:O --layers -t sqlsrv .

4. podman run --name db -p 1433:1433 -dt sqlsrv

5. cd phpmysql

6. buildah bud -v /var/cache/dnf:/var/cache/dnf:O --layers -t php .

7. podman run --name appserver -p 80:80 -dt -e DB_HOST=<your_podmanhost_ip> -e DB_NAME=heroes -e DB_TABLE=HeroValue -e DB_USER=SA -e DB_PASS=Password1! php

podman run --name appserver -p 80:80 -dt -e DB_HOST=192.168.1.140 -e DB_NAME=heroes -e DB_TABLE=HeroValue -e DB_USER=SA -e DB_PASS=Password1! php

8. http://<your_podman_host_ip>/sqlconnect.php

# To run in openshift
$ oc new-project myproj
$ oc create -f my-service-account-pull-secret.yaml
$ oc secrets link builder my-service-account-pull-secret
$ oc new-app --name hello https://github.com/flozanorht/testphp-ubi.git
$ oc logs -f bc/hello
$ oc get pod
$ oc expose svc hello
$ curl hello-myproj.mycluster.example.com

