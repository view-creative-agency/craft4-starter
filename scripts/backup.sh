#!/bin/bash

THIS_DIR="$(dirname "${BASH_SOURCE[0]}")" # Get the directory of the currently executing script
CRON_LOG_PATH=/websites/_logs/cron.log

# "cd" into this directory, because CRON runs from /home/staging and needs to move here
cd ${THIS_DIR} || exit

# Now do what we actually want to do...

if [ $RUN_BY_CRON == true ]
then
	echo -e "----\n${THIS_DIR}/backup.sh called at $(date '+%Y-%m-%d %H:%M:%S') via CRON" >> ${CRON_LOG_PATH}
fi

echo -e "----\n${THIS_DIR}/backup.sh called at $(date '+%Y-%m-%d %H:%M:%S')" >> ${THIS_DIR}/script.log
./backup-files.sh
./backup-db.sh