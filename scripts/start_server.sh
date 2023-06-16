#!/bin/bash
#service httpd start
# cp -R /home/ubuntu/your/php/project/* /var/www/html/

sudo systemctl start apache2 
docker run -d --name mysql-container -p 3307:3306 -e MYSQL_ALLOW_EMPTY_PASSWORD=yes mysql:latest
