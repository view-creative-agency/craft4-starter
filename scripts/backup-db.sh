#!/bin/bash

# This script is used on the LIVE SERVER and backs up the database into the LOCAL backup folder.
# To execute this script, cd into this directory in Terminal and:
# ./backup-db.sh

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

# find and delete database backups older than 7 days
find ../backups/database/* -mtime +7 -exec rm {} \;

# use Craft itself to make a database backup and compress it as a zip
timestamp=$(date '+%Y%m%d-%H%M%S')
php ../craft db/backup ../backups/database/"${timestamp}".sql --zip

echo -e "Database backup written to ../backups/database/${timestamp}.sql.zip" >> script.log

# Normal exit
exit 0
