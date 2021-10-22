---
title: 'Mautic update failed - how to recover'
taxonomy:
    category:
        - docs
slug: update-failed
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

---------------------

Sometimes when updating Mautic, the process might stall or fail part way through. This can cause a problem, because it can cause Mautic to be in-between two versions and often this can make the system unusable.

>>>>>> Generally speaking, updates fail in this way because the hosting environment is inadequately resourced. Consider moving to a Virtual Private Server (VPS) or Dedicated Server if you are using shared hosting. Read more in the [installing][installing-mautic] and [updating][updating-mautic] Mautic sections.

The following processes enables the completion of a failed upgrade.

Before you commence these steps, **please ensure that you have a tested backup of your Mautic instance** where possible.

## Checking for schema updates
Mautic has a built-in tool which enables you to verify the database and identify if there are any schema updates required. Visit `example.com/s/update/schema` to see if there are any updates required.

If this isn't possible, or your Mautic instance is down completely, follow the next tips.

If you don't have SSH access, skip down to ['I don't have SSH access'](#ssh-access-is-not-available).

## SSH access is available

Having SSH access to your server makes things much easier. Log in via command line, and change directory to the Mautic directory using the command

    cd /your/mautic/directory

### 1.  Try to clear the cache

When an upgrade attempt fails in the final step, it may be only the outdated cache that's causing a problem. Use the following command to clear it manually:

    php bin/console cache:clear

If this command throws a PHP error, you can try to remove the cache folder using the following command - be careful, this removes all files and folders in the path specified, so ensure you type it correctly, and in the correct directory.

    rm -rf var/cache

If clearing the cache hasn't resolved your problems, continue with the next step.

### 2. Trigger an update manually

The first step is to determine if there are any updates available using the following command:

    php bin/console mautic:update:find

The output from this command informs you if there are any updates to apply. If there are, run the following command to apply them:

    php bin/console mautic:update:apply

If there are no updates found, proceed to the next step.

### 3. Check for outstanding database migrations

Run the following command to identify any outstanding database migrations:

    php bin/console doctrine:migration:status

If there are any reported, firstly **ensure that you have a tested backup of your database before proceeding, as this command causes changes to the database**, then run:

    php bin/console doctrine:migration:migrate

### 4. Try to update the files manually

This step requires some manual intervention - there is no command for this part.

To update the files manually, you have to:
1. Back up (download) all Mautic files from your server to your local computer, using File Transfer Protocol (FTP) or the [scp command][scp-command] which is much faster.
2. Delete all Mautic files and folders on your server. Use FTP or the [rm command][rm-command] (use the latter with extreme caution).
3. Download the latest Mautic package from [https://www.mautic.org/download][mautic-download].
4. Upload the zip package to the server, to the Mautic folder, using FTP or the [scp command][scp-command] which is much faster.
5. Unzip the package with unzip 3.3.3.zip -change the filename to match the one you have uploaded. You can then remove the zip file using the command         rm 3.3.3.zip.
6. Upload app/config/local.php from your backup on your local machine to the fresh Mautic folder on the server - Mautic should now run.
7. Upload your custom data if you have some. Custom files may be found in the following folders: media/files; plugins; themes; translations.

## SSH access is not available

There is a PHP script which can do almost all steps from the section preceding. You can find this script [in this Gist][commands-gist].

The description about how to use the script is provided below the script itself. There are some details you need to do differently, so please read these instructions carefully. For example, you must use FTP to upload and download the files. You must unzip the files on your local computer and upload those files, which takes a lot longer.

## There is a PHP error when a command is executed
Firstly, read the error message which usually gives good indications to the problem. Next, search for the error in your preferred search engine. You can also search the [Mautic Forums][support-forums] to see if others have reported and resolved the same problem.

### Allowed memory size exhausted
This error is reported as:

    PHP Fatal error:  Allowed memory size of 67108864 bytes exhausted (tried to allocate 10924085 bytes) in ...

This means that the memory limit that Apache has available is too low. Edit the memory_limit in the php.ini configuration file. Read more about [working with resource limits][resource-limits].

### A required PHP extension is missing

    Fatal: Class 'ZipArchive' not found

This means that PHP can't work with Zip packages - changes are needed to your server configuration to allow unzipping of files at the command line. Ask your hosting provider, or search for a tutorial to help with this.

### Further help is needed

If you need help, there are several places you can go to ask for assistance. Remember that most people who use the Community Forums, Chat, and GitHub are volunteers.

If you think your configuration is causing the problem, ask on the [Mautic Community Forums][support-forums]. Search before you post, as it's likely someone might have already answered your question in the past.

You can also chat with someone in the live [Community Chat][mautic-slack] however all support requests must be posted on the forums. Post there first, then drop the link to the post in Slack if you are discussing it with someone.

In all cases, it is important that you describe the problem, and all steps you have followed to resolve the problem, in detail. At a minimum, include the following:

* Steps to reproduce your problem - a step-by-step tutorial of how the problem arose, or how to reproduce it
* The PHP version of your server
* The error messages you are seeing - if you don't see the error message directly, search for it in the `var/logs` folder and in the server log. The server logs are located in different places depending on your setup. Ubuntu servers generally store their logs in `/var/log/apache2/error.log`.  Sometimes your hosting provider might offer a GUI to view logs in your Control Panel.

If you don't provide this information as a minimum, the person who might try to help you has to ask you for it, so please save them the trouble and provide the information upfront. Also, importantly, please be polite. Mautic is an Open Source project, and people are giving their free time to help you.

You can also chat with someone in the live [Community Chat][mautic-slack] however all support requests must go on the forums. Post there first, then drop the link to the post in Slack if you are discussing it with someone.

[update-failed]: </troubleshooting/update-failed>
[rm-command]: <http://manpages.ubuntu.com/manpages/precise/en/man1/rm.1.html>
[mautic-download]: <https://www.mautic.org/download>
[scp-command]: <http://manpages.ubuntu.com/manpages/precise/en/man1/scp.1.html>
[commands-gist]: <https://gist.github.com/escopecz/9a1a0b10861941a457f4>
[support-forums]: <https://forum.mautic.org/support>
[mautic-slack]: <https://mautic.org/slack>
[mautic-github]: <https://github.com/mautic/mautic/issues/new>
[installing-mautic]: </setup/how-to-install-mautic>
[updating-mautic]: </setup/how-to-update-mautic>
[resource-limits]: </troubleshooting/working-with-php-ini-resource-limits>