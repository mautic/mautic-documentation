---
title: 'Updating at command line'
taxonomy:
    category:
        - docs
slug: updating-at-command-line
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

---
Before you commence updating Mautic, **please ensure that you have a tested backup of your Mautic instance**. This means that you have downloaded the files and database of your Mautic instance, and you have re-created it in a test environment somewhere and tested that everything is working as expected. This is your only recourse if there are any problems with the update. Never update without having a working, up-to-date backup.

## Checking for updates

 Log in via the command line, and change directory to the Mautic directory using the command

    cd /your/mautic/directory

The first step is to find out if there are any updates available using the following command:

    php bin/console mautic:update:find

The output from this command tells you if there are any updates to apply. The notification links to an announcement post which explains what the release includes.

>>>>>> It's a good idea to review the announcement link for information about the release. There may be important information or steps that you may need to take before updating.

If there are updates available, run the following command to apply them:

    php bin/console mautic:update:apply
