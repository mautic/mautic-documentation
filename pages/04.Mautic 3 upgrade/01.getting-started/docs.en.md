---
title: 'Getting started'
---

Are you ready for Mautic 3? Time to get started.

### What if you don't want to upgrade to Mautic 3 yet, how do you turn off the upgrade notification?
That's absolutely fine. This is handy, for example, when you use custom plugins that aren't ready for Mautic 3 (yet). Go to `app/config/local.php` and add the following setting there:

```PHP
'block_mautic_3_upgrade'    => true,
```

Then, clear your cache. The Mautic 3 upgrade notification now disappears. If it doesn't disappear immediately, you can run `app/console mautic:update:find` on the command line so that it's hidden immediately.

### Check the minimum requirements

Mautic 3 has some higher minimum requirements than Mautic 2, and the upgrade has some built in checks to ensure the environment supports the update, in addition to ensuring you have the resources available in your hosting environment to complete the upgrade process. Check the current requirements for the latest version of Mautic at [mautic.org/download/requirements][requirements].  

The main things to be aware of are:

1. PHP must be at 7.3 but no higher to start the update. This is because you need to be able to run Mautic 2 - 7.3 and below - and Mautic 3 - 7.4 and below - in tandem.

PHP 7.3 allows you to do this. As soon as the update completes and you are running the latest released version of Mautic 3.x you can raise the PHP version to 7.4. 

Check what version of PHP is in use by accessing the system information for your Mautic instance - located under the settings cog wheel at the top right - or using the command `php -v` at the command line. Note that there may be a different version of PHP used at the command line.

2. MySQL needs to be >= 5.7.14 or if you use MariaDB, this must be >= 10.1. Check this in the system information for your Mautic instance, or using the command `mysql -V` at the command line.

3. At least 2x the space that your Mautic 2.x instance is using currently. Remember to include your database size should in this calculation, in addition to files and folders.

4. PHP's max_execution_time should be either 0 - unlimited - or > 240, otherwise the upgrade is likely to fail if using the user interface

5. PHP's memory_limit should be equal to or higher than 256M otherwise the upgrade is likely to fail if using the user interface

### Choose your update method - web interface or CLI
#### Command line interface - preferred

It's strongly recommended to upgrade at the command line, as the process is quite resource intensive and times out in hosting environments with limits on script execution time. If you have over 10,000 contacts you must update using the command line.

1. Take a backup of your Mautic instance, and test that it's working in all respects. 
2. Connect to your server at the command line and use the `cd` command to move into the directory where you have Mautic installed
3. Ensure that your server meets the minimum requirements listed previously
4. Update to the latest available version of Mautic 2.x using `app/console mautic:update:find` to find updates, and then `app/console mautic:update:apply`to apply the updates
5. Remove any custom themes and plugins from your Mautic instance - you can bring them back in after you have completed the migration. 
6. Run the command once again for updates using `app/console mautic:update:find` to find updates, and then `app/console mautic:update:apply`to apply the updates
7. Follow the steps - the script takes you through the migration process step by step

#### User interface - not recommended
1. Take a backup of your Mautic instance, and test that it's working in all respects. 
2. Open your Mautic instance and look for the notification of an update being available in the notification bell
3. Ensure that your server meets the minimum requirements listed previously
4. Update to the latest available version of Mautic 2.x
5. Once you are at the latest version of Mautic 2.x, look for the notification of the 3.x update being available, then you can run the upgrade script via the notification

### Updating cron jobs
As there are significant changes in Mautic 3's file structure, you need to upgrade your cron jobs.

Example:

`app/console mautic:segments:update`

should now be:

`bin/console mautic:segments:update`



[requirements]: <https://mautic.org/download/requirements>
