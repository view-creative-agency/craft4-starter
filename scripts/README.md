# About these scripts

These scripts automate some common tasks.

## Steps to use these sctipts

- on each machine the scripts will be run from:
  - copy the `.env.sh.example` file as `.env.sh`
  - update the values in `.env.sh`

> `.env.sh` should never be in GIT, which is why this is done manually per machine

## Notes

- Do not use pull/push scripts on a live server (it won't be able to)
  - The flow we enforce is getting your local machine in the right state, and pushing from that (both GIT and content)
- Local machines should not use backup scripts (you'd need to run them from inside a `ddev ssh`)

## Pull/Push scripts

These scripts are used to manage the `/web/content` files which are generated through actions in the CMS, and are not in GIT.

For any of these pull/push scripts to work, the machine you're running the scripts on will need to be authorised on the respective remote server (staging/live).

They will not work if your local machines' public key is not in the `authorized_keys` of the remote server.

## Backup scripts

The backup scripts are for the live server only, and run via CRON job.

When run they will:

- copy new or changed files from `/web/content`.
- copy new or changed files from `/web/dist`.
- run a database backup via Craft itself.

These files are written to the `PROJECT/backups` folder.

### Limitations of the backups

- Databases are stored daily, and retained for 7 days.
- Files in the `PROJECT/web/*` directory are never deleted, so if a client accidentally deleted source images via the CMS, they will remain here.
- Files in the `PROJECT/web/*` directory DO reflect changes; so if a client changes an image which retains the same filename, the backup copy will also be updated.
- We do not back up the `imager` directory, as they can be regenerated from the source images.

### Expected use

`./backup.sh` can be executed manually, or via CRON

The CRON file might look like this:

```bash
RUN_BY_CRON=true # Variable used in the scripts

3 1 * * * /websites/REPO/scripts/backup.sh >/dev/null 2>&1
  # at 01:03am daily, run the script
```
