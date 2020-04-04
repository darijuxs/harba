#!/usr/bin/env bash

set -x

#Updating repositories
apt-get update -y

#Install additional packages
apt-get install curl nano apt-utils net-tools less dialog -y

###Install GIT client
apt-get install git -y

# Using Debian, as root
curl -sL https://deb.nodesource.com/setup_10.x | bash -
apt-get install -y nodejs

#Clean
apt-get autoremove
apt-get clean
