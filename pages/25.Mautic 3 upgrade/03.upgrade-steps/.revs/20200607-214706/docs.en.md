---
title: 'Upgrade steps'
---

If you want to know more about all the upgrade steps of the Mautic 3 upgrade process, this is the place to be.

The upgrade process consists of multiple steps to make it as robust as possible. If the process fails at a certain step, you can find all details about the specific error code on the [Mautic 3 upgrade errors](../mautic-3-upgrade-errors) page.

! If you use the web interface to do the upgrade, and you're stuck, you can always go to a specific step by adding the step code to the URL, e.g. `upgrade_v3.php#buildCache`. **Please note that we don't support manually switching between steps, only do so when support asks you to do so!**

### Start upgrade
Code: startUpgrade

Starts the upgrade and starts logging things as well. In case something goes wrong, you can send us your log file so that we can assist further.

### Database backup
Code: backupDatabase

If `mysqldump` is available, we create a database backup. Especially on shared hosts this function might not be available.

### Apply Mautic 2 database migrations
Code: applyV2Migrations

### Download Mautic 3 upgrade package
Code: fetchUpdates

### Extract Mautic 3 files
Code: extractUpdate

### Move Mautic 2 files into backup folder, move Mautic 3 files into root folder
Code: moveMautic2and3Files

This is where a lot of magic happens. A complete backup is taken of your Mautic 2 installation, after which we move Mautic 3 files into place. 

### Update config/local.php with new configuration parameters
Code: updateLocalConfig

A few configuration parameters have changed in Mautic 3; the upgrade script automatically updates them for you if necessary. To get an overview of all changes configuration parameters, see our [update doc](https://github.com/mautic/mautic/blob/3.x/UPGRADE-3.0.md#configuration).

### Apply Mautic 3 database migrations
Code: applyMigrations

The database structure has slightly changed in Mautic 3. As part of the standard update process in Mautic, we check for database migrations and execute those.

### Restore user data (plugins/themes/media)
Code: restoreUserData

If you had any custom plugins/themes/media installed in Mautic 2, this step will restore those in Mautic 3 by copying them over to the "new" Mautic 3 folder.

### Cleanup
Code: cleanupFiles

In this step, we clean up some of the installation files.

### Build Mautic 3 cache
Code: buildCache

Mautic always prepares cache the first time you start it, so that it runs faster on subsequent requests. In this step, we prepare the cache, so that you'll be able to get started easily and quickly.

### Finish
Code: finished

Cleans up some last files (including the upgrade script itself), and allows the user to open Mautic 3.