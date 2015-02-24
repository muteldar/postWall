#!/bin/bash

echo "Starting Provision"

apt-get update &> /dev/null
apt-get install php5-fpm -y &> /dev/null
apt-get install php5-mcrypt -y &> /dev/null
apt-get install nginx -y &> /dev/null
cp /vagrant/vagrantconfig/postWall /etc/nginx/sites-available/postWall &> /dev/null
ln -s /etc/nginx/sites-available/postWall /etc/nginx/sites-enabled/ &> /dev/null
rm -rf /etc/nginx/sites-enabled/default &> /dev/null
rm -rf /etc/nginx/sites-available/default &> /dev/null
cp -a /vagrant/ /var/www &> /dev/null
chown -R root /var/www &> /dev/null
echo 'extension=mcrypt.so' >> /etc/php5/fpm/php.ini
service php5-fpm restart &> /dev/null
service nginx restart &> /dev/null

echo "Provision Finished"
