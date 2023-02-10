#!/bin/bash

# Ensures the permissions and owners are correct on the staging or live servers
#
# To execute this script, cd into this directory in Terminal and:
# ./fix-permissions.sh

# Get the directory of the currently executing script
DIR="$(dirname "${BASH_SOURCE[0]}")"

# Include files
INCLUDE_FILES=(
	".env.sh"
)
for INCLUDE_FILE in "${INCLUDE_FILES[@]}"
do
	if [[ ! -f "${DIR}/${INCLUDE_FILE}" ]] ; then
		echo -e "${RED}Include file ${DIR}/${INCLUDE_FILE} is missing, aborting."
		exit 1
	fi
	source "${DIR}/${INCLUDE_FILE}"
done

cd ..
sudo chown -R ${BASH_USER}:www-data .
find . -type d -exec chmod ug+rwx {} \;
find . -type f -exec chmod ug+rw {} \;
find . -type d -exec chmod g+s {} \;