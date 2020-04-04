#!/usr/bin/env bash

set -x
#CONFIG_DIRECTORY=/var/www/html/app
#MAIN_DIRECTORY=/var/www/html
#MODULES_DIRECTORY=/var/www/html/node_modules
#
#cp $CONFIG_DIRECTORY/config_default.js $CONFIG_DIRECTORY/config.js
#chown www-data:1000 $CONFIG_DIRECTORY/config.js
#chmod ug=rw,o=r $CONFIG_DIRECTORY/config.js
#
#cd $MAIN_DIRECTORY; npm install
#
#chown -R www-data:1000 $MODULES_DIRECTORY
#find $MODULES_DIRECTORY -type d -exec chmod -R ug=rwx,o=rx {} +
#find $MODULES_DIRECTORY -type f -exec chmod -R ug=rw,o=r {} +

node main.js > /var/log/node.log 2>&1

sleep 30d
