#!/bin/bash

# This script pulls LIVE files from /content and /imager and copies them to this machine.
# It uses rsync and so only pulls down new or changed files (skips ones you already have)
#
# To execute this script, cd into this directory in Terminal and:
# ./pull-from-staging.sh

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

echo -e "\n\nChoosing (y) will retrieve new and changed files from ${BLUE}${REPO}${NC} on the ${RED}LIVE site${NC} and put them onto your machine.\nContinue? (y/n): \c"

read -r carryOn;

if [ "$carryOn" != "y" ]; then
	echo "You did not press Y. Exiting. Nothing has been changed by this script."
	exit 0;
fi

echo -e "\nRetrieving new and changed files from /web/content"
rsync --archive --compress --partial --update --verbose --human-readable --exclude=".DS_Store" "$LIVE_SERVER_SSH":/websites/"$REPO"/web/content/ ../web/content/
echo -e "\nRetrieving new and changed files from /web/imager"
rsync --archive --compress --partial --update --verbose --human-readable --exclude=".DS_Store" "$LIVE_SERVER_SSH":/websites/"$REPO"/web/imager/ ../web/imager/

echo -e "${GREEN}Complete"

# Normal exit
exit 0
