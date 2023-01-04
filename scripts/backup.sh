#!/bin/bash

echo -e "----\nbackup.sh called at $(date '+%Y-%m-%d %H:%M:%S')" >> script.log

./backup-files.sh
./backup-db.sh