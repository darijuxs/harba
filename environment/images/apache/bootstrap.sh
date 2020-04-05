#!/usr/bin/env bash

apt-get update -y

####################################################
#Install extra library
apt-get install curl nano apt-utils net-tools less dialog -y
####################################################
#
apt-get install php libapache2-mod-php php7.2-curl php7.2-mysql php7.2-zip php7.2-xdebug php7.2-xml php7.2-bcmath php7.2-intl php7.2-gd php7.2-mbstring -y

##Configuring xdebug
echo "xdebug.remote_enable=1" >> "/etc/php/7.2/apache2/conf.d/20-xdebug.ini";
echo "xdebug.remote_host=172.19.0.1" >> "/etc/php/7.2/apache2/conf.d/20-xdebug.ini";
echo "xdebug.remote_autostart=1" >> "/etc/php/7.2/apache2/conf.d/20-xdebug.ini";

#Disable Xdebug for cli to install ls_dm using composer without error.
#phpdismod -s cli xdebug
#
#####################################################
#Install APACHE
apt-get install apache2 -y
a2enmod rewrite
a2enmod proxy_http

a2dissite 000-default.conf
cp -R /build/vhosts/* /etc/apache2/sites-available

usermod -u 1000 www-data

#####################################################
###Install GIT client
apt-get install git -y
####################################################

apt-get autoremove
apt-get clean
