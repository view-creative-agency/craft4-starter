#!/bin/bash

# This script ensures the permissions and owners are correct on the staging site
#
# To execute this script, cd into this directory in Terminal and:
# ./fix-permissions-staging.sh

USER=replaceme

cd ..
sudo chown -R ${USER}:www-data .
find . -type d -exec chmod ug+rwx {} \;
find . -type f -exec chmod ug+rw {} \;
find . -type d -exec chmod g+s {} \;