---
title: 'Mautic 3 upgrade errors'
twitterenable: true
twittercardoptions: summary
articleenabled: false
orgaenabled: false
orga:
    ratingValue: 2.5
orgaratingenabled: false
personenabled: false
facebookenable: true
---

Did you get an error while running the Mautic 3 upgrade? Please look for the error code you got on this page for further instructions.

If you need any further help, please post into the dedicated [Mautic 3 Installation/Upgrade forum][m3-forum]. Please ensure that you provide all the details requested in the post template, which enables the community volunteers to provide effective support.

## Error codes

### ERR_DATABASE_BACKUP_FAILED
During this stage, the script makes an attempt to back up your database. The script makes use of the command `mysqldump` to execute the backup process. 

If an error occurs in this stage there was a problem running the command, or there was an interruption in the process for some reason. 

The error message gives you more details about where the problem lies. You can find further information in the `upgrade_log.txt` file - created in the root of your Mautic instance when an upgrade starts.

To move forward from this stage, you need to fix the problem reported, and restart the upgrade script. 

If you need any further help, please post into the dedicated [Mautic 3 Installation/Upgrade forum][m3-forum]. Please ensure that you provide all the details requested in the post template, which enables the community volunteers to provide effective support.

### ERR_MAUTIC_2_MIGRATIONS_IDENTIFICATION_FAILED
During this stage, the script checks to ensure that there are no database migrations outstanding from previous Mautic upgrades.

If an error occurs in this stage, the upgrade script was unable to find or access the appropriate files, or there was an interruption in the process for some reason.

The error message gives you more details about where the problem lies. You can find further information in the `upgrade_log.txt` file - created in the root of your Mautic instance when an upgrade starts.

To move forward from this stage, refresh the page.

If you need any further help, please post into the dedicated [Mautic 3 Installation/Upgrade forum][m3-forum]. Please ensure that you provide all the details requested in the post template, which enables the community volunteers to provide effective support.

### ERR_MAUTIC_2_MIGRATIONS_FAILED

During this stage, the script runs the migrations identified in the previous stage, updating your Mautic 2 database to support Mautic 3.

If an error occurs in this stage, the upgrade script was unable to apply the migrations that it found, or there was an interruption in the process for some reason.

The error message gives you more details about where the problem lies. You can find further information in the `upgrade_log.txt` file - created in the root of your Mautic instance when an upgrade has started.

To move forward from this stage, review the error message and address any problems that it raises.

If you need any further help, please post into the dedicated [Mautic 3 Installation/Upgrade forum][m3-forum]. Please ensure that you provide all the details requested in the post template, which enables the community volunteers to provide effective support.

### ERR_DOWNLOAD_UPGRADE_PACKAGE_FAILED

During this stage, the script downloads the upgrade package from the server.

If an error occurs in this stage, the script was unable to contact the server to download the package needed to run the upgrade, or there was an interruption in the process for some reason.

The error message gives you more details about where the problem lies. You can find further information in the `upgrade_log.txt` file - created in the root of your Mautic instance when an upgrade has started.

To move forward from this stage, review the error message and address any problems that it raises.

If you need any further help, please post into the dedicated [Mautic 3 Installation/Upgrade forum][m3-forum]. Please ensure that you provide all the details requested in the post template, which enables the community volunteers to provide effective support.
### ERR_EXTRACT_UPGRADE_PACKAGE_FAILED
During this stage, the script extracts the Mautic 3 files from the downloaded archive.

If an error occurs in this stage, the script was unable to extract the files on your server, or there was an interruption in the process for some reason.

The error message gives you more details about where the problem lies. You can find further information in the `upgrade_log.txt` file - created in the root of your Mautic instance when an upgrade has started.

To move forward from this stage, review the error message and address any problems that it raises.

If you need any further help, please post into the dedicated [Mautic 3 Installation/Upgrade forum][m3-forum]. Please ensure that you provide all the details requested in the post template, which enables the community volunteers to provide effective support.

### ERR_MOVE_MAUTIC_2_AND_3_FILES
During this stage, the script moves the current Mautic 2 files into a temporary directory called "mautic-2-backup-files", and then moves the Mautic 3 files from "mautic-3-temp-files" to the root directory.

If an error occurs in this stage, there were problems with moving the files and/or folders, or there was an interruption in the process for some reason.

The error message gives you more details about where the problem lies. You can find further information in the `upgrade_log.txt` file - created in the root of your Mautic instance when an upgrade has started.

To move forward from this stage, review the error message and address any problems that it raises.

If you need any further help, please post into the dedicated [Mautic 3 Installation/Upgrade forum][m3-forum]. Please ensure that you provide all the details requested in the post template, which enables the community volunteers to provide effective support.


### ERR_UPDATE_LOCAL_CONFIG
During this stage the script updates the config/local.php file with new Mautic 3 values.  

If an error occurs in this stage, there were problems with making or saving changes to the file. 

The error message gives you more details about where the problem lies. You can find further information in the `upgrade_log.txt` file - created in the root of your Mautic instance when an upgrade has started.

To move forward from this stage, review the error message and address any problems that it raises.

If you need any further help, please post into the dedicated [Mautic 3 Installation/Upgrade forum][m3-forum]. Please ensure that you provide all the details requested in the post template, which enables the community volunteers to provide effective support.

### ERR_MAUTIC_3_MIGRATIONS_IDENTIFICATION_FAILED
During this stage, the script identifies the database migrations required to update from Mautic 2 to Mautic 3.

If an error occurs during this stage, the upgrade script was unable to find or access the appropriate files, or there was an interruption in the process for some reason.

The error message gives you more details about where the problem lies. You can find further information in the `upgrade_log.txt` file - created in the root of your Mautic instance when an upgrade has started.

To move forward from this stage, review the error message and address any problems that it raises.

If you need any further help, please post into the dedicated [Mautic 3 Installation/Upgrade forum][m3-forum]. Please ensure that you provide all the details requested in the post template, which enables the community volunteers to provide effective support.
### ERR_MAUTIC_3_MIGRATIONS_FAILED
During this stage, the script runs the database migrations that are required to move between Mautic 2 and Mautic 3.

If an error occurs during this stage, there was a problem with running the migrations, or there was an interruption in the process for some reason.

The error message gives you more details about where the problem lies. You can find further information in the `upgrade_log.txt` file - created in the root of your Mautic instance when an upgrade has started.

To move forward from this stage, review the error message and address any problems that it raises.

If you need any further help, please post into the dedicated [Mautic 3 Installation/Upgrade forum][m3-forum]. Please ensure that you provide all the details requested in the post template, which enables the community volunteers to provide effective support.
### ERR_RESTORE_USER_DATA_FAILED
During this stage, the script restores the user data (themes/plugins/media) from the Mautic 2 backup directory into the new Mautic 3 directory.

If an error occurs during this stage, there was a problem with copying the files and folders, or there was an interruption in the process for some reason.

The error message gives you more details about where the problem lies. You can find further information in the `upgrade_log.txt` file - created in the root of your Mautic instance when an upgrade has started.

To move forward from this stage, review the error message and address any problems that it raises.

If you need any further help, please post into the dedicated [Mautic 3 Installation/Upgrade forum][m3-forum]. Please ensure that you provide all the details requested in the post template, which enables the community volunteers to provide effective support.

### ERR_BUILD_M3_CACHE
During this stage, the script builds the Mautic 3 cache to speed up the first load of the new Mautic 3 instance.

If an error occurs during this stage, there was a problem with creating the cache, or there was an interruption in the process for some reason.

The error message gives you more details about where the problem lies. You can find further information in the `upgrade_log.txt` file - created in the root of your Mautic instance when an upgrade has started.

To move forward from this stage, review the error message and address any problems that it raises.

If you need any further help, please post into the dedicated [Mautic 3 Installation/Upgrade forum][m3-forum]. Please ensure that you provide all the details requested in the post template, which enables the community volunteers to provide effective support.
### ERR_CLEANUP_FILES
During this stage, the script cleans up the files and folders used during the migration which are no longer needed, completing the migration process.

If an error occurs during this stage, there was a problem with removing the files and folders, or there was an interruption in the process for some reason.

The error message gives you more details about where the problem lies. You can find further information in the `upgrade_log.txt` file - created in the root of your Mautic instance when an upgrade has started.

To move forward from this stage, review the error message and address any problems that it raises.

If you need any further help, please post into the dedicated [Mautic 3 Installation/Upgrade forum][m3-forum]. Please ensure that you provide all the details requested in the post template, which enables the community volunteers to provide effective support.

[m3-forum]: <https://forum.mautic.org/c/support/mautic-3-install-upgrade-support/98>
