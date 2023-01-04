#!/bin/bash

# This script pushes files from your local machine to the LIVE server
# It uses rsync and so only pushes new or changed files (skips ones you already have)
#
# To execute this script, cd into this directory in Terminal and:
# ./push-content-to-mercury.sh

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

echo -e "${BLUE}You need to have your own SSH key authorized on the LIVE server for this to work"
echo -e "${NC}Please confirm that the following are what you expect:\n"

cat .env.sh

echo -e "\n\nChoosing (y) will TRANSMIT new and changed files from ${BLUE}${REPO}${NC} on your machine to the ${RED}LIVE site${NC}.\nContinue? (y/n): \c"

read -r carryOn;

if [ "$carryOn" != "y" ]; then
	echo "You did not press Y. Exiting. Nothing has been changed by this script."
	exit 0;
fi

echo -e "Uploading new and changed files in /web/content\n"
rsync --archive --compress --partial --update --verbose --human-readable --exclude=".DS_Store" ../web/content "$LIVE_SERVER_SSH":/websites/"$REPO"/web/content
echo -e "Uploading new and changed files in /web/dist\n"
rsync --archive --compress --partial --update --verbose --human-readable --exclude=".DS_Store" ../web/dist "$LIVE_SERVER_SSH":/websites/"$REPO"/web/dist

echo -e "\n${GREEN}Complete"

# Normal exit
exit 0
