#FROM registry.access.redhat.com/ubi8/ubi
FROM registry.access.redhat.com/ubi8/ubi:8.3


# Install Apache & PHP
RUN yum --enablerepo=ubi-8-codeready-builder -y update \
  && yum --disableplugin=subscription-manager -y module enable php:7.4 \
  && yum --disableplugin=subscription-manager -y install httpd php php-bcmath php-cli php-common php-gd php-intl php-ldap php-mbstring \
    php-mysqlnd php-pear php-soap php-xml php-xmlrpc php-zip php-pdo php-xml php-pear php-devel gcc-c++ gcc make

# MSSQL Driver Compatibility for UBI8
RUN yum config-manager --add-repo http://mirror.centos.org/centos/8/BaseOS/x86_64/os/ \
  && echo "gpgkey=http://mirror.centos.org/centos/RPM-GPG-KEY-CentOS-Official" >> /etc/yum.repos.d/mirror.centos.org_centos_8_BaseOS_x86_64_os_.repo \
  && yum --disableplugin=subscription-manager -y install e2fsprogs

# Install mssql driver
ENV ACCEPT_EULA=Y
ENV PATH=${PATH}:/opt/mssql/bin:/opt/mssql-tools/bin
RUN curl https://packages.microsoft.com/config/rhel/8/prod.repo > /etc/yum.repos.d/mssql-release.repo \
  && yum --disableplugin=subscription-manager -y install msodbcsql17 mssql-tools unixODBC-devel

# Clean all the package cache
RUN yum --disableplugin=subscription-manager clean all

# Install PHP MSSQL PDO
RUN pecl install sqlsrv \
  && pecl install pdo_sqlsrv \
  && chmod 755 /usr/lib64/php/modules/sqlsrv.so \
  && chmod 755 /usr/lib64/php/modules/pdo_sqlsrv.so \
  && echo extension=pdo_sqlsrv.so >> `php --ini | grep "Scan for additional .ini files" | sed -e "s|.*:\s*||"`/30-pdo_sqlsrv.ini \
  && echo extension=sqlsrv.so >> `php --ini | grep "Scan for additional .ini files" | sed -e "s|.*:\s*||"`/20-sqlsrv.ini 

# Update Apache Configuration
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -E -i -e '/<Directory "\/var\/www\/html">/,/<\/Directory>/s/AllowOverride None/AllowOverride All/' /etc/httpd/conf/httpd.conf \
  && sed -E -i -e 's/DirectoryIndex (.*)$/DirectoryIndex index.php \1/g' /etc/httpd/conf/httpd.conf \
  && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/httpd/conf/httpd.conf \
  && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/httpd/conf/httpd.conf

# enable url rewrite
# RUN sed -i -r "s,^#(LoadModule. rewrite_module modules/mod_rewrite.so),\1/g" /etc/httpd/conf/httpd.conf

# Permission update and Enable reading environment variable
# Putting EGPCS in php.ini if $_ENV is necessary
# To bind port 80 require CAP_NET_BIND_SERVICE
RUN sed -i 's/listen.acl_users = apache,nginx/listen.acl_users =/' /etc/php-fpm.d/www.conf \
  && mkdir /run/php-fpm \
  && chgrp -R 0 /var/log/httpd /var/run/httpd /run/php-fpm \
  && chmod -R g=u /var/log/httpd /var/run/httpd /run/php-fpm \
  && sed -i 's/;clear_env = no/clear_env = no/' /etc/php-fpm.d/www.conf \
  && sed -i 's/Listen 80/Listen 8080/' /etc/httpd/conf/httpd.conf

#----Testing purpose, please comment out for production release----#
RUN yum --disableplugin=subscription-manager -y install iputils bind-utils nmap-ncat \
  && yum --disableplugin=subscription-manager clean all
COPY index.php info.php sqlconnect.php sqlconnect2.php  /var/www/html/public/
#----Testing End----#


# Port expose
EXPOSE 8080

# Start Apache
USER 1001
CMD php-fpm & httpd -D FOREGROUND