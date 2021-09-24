---
title: 'Upgrade steps'
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

If you want to know more about all the upgrade steps of the Mautic 3 upgrade process, this is the place to be.

The upgrade process consists of multiple steps to make it as robust as possible. If the process fails at a certain step, you can find all details about the specific error code on the [Mautic 3 upgrade errors][errors] page.

If you use the web interface to do the upgrade, and you're stuck, you can always go to a specific step by adding the step code to the URL, for example `upgrade_v3.php#buildCache`. **Please note that manually switching between steps is not supported, only do so when support asks you to do so**

### Pre-upgrade checks
Code: preUpgradeChecks

Here, Mautic does some checks prior to starting the upgrade, to make sure your system is compatible with the upgrade. The checks are:

* PHP version must be 7.2 or 7.3
* MySQL version needs to be >= 5.7.14 or MariaDB >= 10.1
* Is custom `api_rate_limiter_cache` set? TODO add docs
* Is Mautic's root directory writable?
* Are there items in the `spool/default` folder? This indicates that there are still emails in the queue
* Is the free disk space at least 2x the current Mautic 2 installation?
* Do you at least have Mautic 2.16.3 installed?
* Is PHP's `max_execution_time` either 0 - unlimited - or > 240? If not, Mautic tries to set it, if that doesn't work, Mautic shows an error
* Is `mysqldump` available for creating database backups?
* Is there a Mautic 3 upgrade package available for download?
* Is the `upgrade temporarily disabled` switch activated? Mautic's Product Team can enable a switch which shows a warning to users that there might be problems with the upgrade. This is only used if there is a major bug with an upgrade path.
* Are there any custom plugins installed? If yes, Mautic shows a warning that users should verify if those plugins are compatible with Mautic 3 or temporarily remove them
* Get the amount of available database migrations. If that fails, Mautic shows a warning
* Check if the platform is Windows. If so, Mautic shows a warning that cache creation is significantly slower on this platform and that the user should be extra patient.
* Is PHP's `memory_limit` equal to or higher than 256M? If not, Mautic tries to set it, if that doesn't work, Mautic shows an error

### 1. Start upgrade
Code: startUpgrade

Starts the upgrade and starts logging things as well. In case something goes wrong, you can send your log file on the community support forums so that they can assist further.

### 2. Database backup
Code: backupDatabase

If `mysqldump` is available, the upgrade script creates a database backup. Especially on shared hosts this function might not be available.

### 3. Apply Mautic 2 database migrations
Code: applyV2Migrations

During this stage the upgrade script is applying any database migration is that remain outstanding for your Mautic 2.16.x instance. This can sometimes happen if a previous update hasn't completed successfully. It's important that your database has all of the updates required before Mautic can proceed.

### 4. Download Mautic 3 upgrade package
Code: fetchUpdates

In this stage the upgrade script is downloading the Mautic 3 upgrade package from the server.

### 5. Extract Mautic 3 files
Code: extractUpdate

In this stage the upgrade script is extracting the files from the upgrade package and saving them into a folder which Mautic uses for your migration.

### 6. Move Mautic 2 files into backup folder, move Mautic 3 files into root folder
Code: moveMautic2and3Files

This is where a lot of magic happens. The upgrade script takes a complete backup of your Mautic 2 installation, after which it moves the Mautic 3 files into place. 

### 7. Update config/local.php with new configuration parameters
Code: updateLocalConfig

A few configuration parameters have changed in Mautic 3, the upgrade script automatically updates them for you if necessary. To get an overview of all changes configuration parameters, see the [update doc][upgrade].

### 8. Apply Mautic 3 database migrations
Code: applyMigrations

The database structure has slightly changed in Mautic 3. As part of the standard update process in Mautic, the upgrade script looks for database migrations and executes those.

### 9. Restore user data (plugins/themes/media)
Code: restoreUserData

If you had any custom plugins/themes/media installed in Mautic 2, this step restores those in Mautic 3 by copying them over to the "new" Mautic 3 folder.

### 10. Cleanup
Code: cleanupFiles

In this step, the upgrade script cleans up some of the installation files.

### 11. Build Mautic 3 cache
Code: buildCache

Mautic always prepares cache the first time you start it, so that it runs faster on subsequent requests. In this step, the upgrade script prepares the cache, so that you'll be able to get started easily and quickly.

### 12. Finish
Code: finished

Cleans up some last files, and allows the user to open Mautic 3.

A last step offered at the end of the upgrade is to **remove backup files**. Removing the backup files as soon as possible is strongly recommended. This step also removes the upgrade script itself.

[errors]: </mautic-3-upgrade/mautic-3-upgrade-errors>
[upgrade]: <https://github.com/mautic/mautic/blob/3.x/UPGRADE-3.0.md#configuration>