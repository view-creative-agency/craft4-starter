#!/bin/bash

# This script backs up files into the LOCAL backup folder.
# It uses rsync and so only pulls down new or changed files (skips ones you already have)
#
# To execute this script, cd into this directory in Terminal and:
# ./backup-files.sh

# prompt colours
RED='\033[0;31m'
BLUE='\033[0;34m'
GREEN='\033[0;32m'
NC='\033[0m' # No Color

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

# Folders we want to backup relative to the DIR path
FOLDERS=(
	"web/content"
	"web/dist"
)

for FOLDER in "${FOLDERS[@]}"
do
	rsync -FLazuh --progress "../${FOLDER}" "../backups/files"
	echo -e "Backed up files from ../${FOLDER} to ../backups/files" >> script.log
done

echo -e "File backups complete" >> script.log

# Normal exit
exit 0
