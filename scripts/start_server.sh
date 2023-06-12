#!/bin/bash
#service httpd start
# cp -R /home/ubuntu/your/php/project/* /var/www/html/

sudo systemctl start apache2 
docker run -d -p 3307:3307 --name mysql-container 103448072587.dkr.ecr.us-east-1.amazonaws.com/mysql:latest
