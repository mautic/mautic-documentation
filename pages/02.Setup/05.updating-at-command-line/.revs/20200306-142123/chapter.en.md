---
title: 'Updating at command line'
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

# Updating at Command Line

---
When Mautic is updated, there are several tasks which can take a long time to complete depending on the size of your Mautic instance.  

If you have a lot of leads, you might run into problems when updating using the notification 'bell' icon in Mautic.  These problems usually manifest as the update hanging part way through, or crashing with an error and are often as a result of resource limitation, particularly on shared hosting environments. If this has happened to you, head over to the [Update Failed][update-failed] pagen for a step-by-step walkthrough of how to complete the update.

It is therefore recommended as best practice that you carry out any updates at the command line - and after testing the update thoroughly in a development environment first.

Before you commence these steps, **please ensure that you have a tested backup of your Mautic instance**.  This means that you have downloaded the files and database of your Mautic instance, and you have re-created it in a test environment somewhere and tested that everything is working as expected.

## Checking for updates 

 Log in via command line, and change directory to the location where Mautic is installed using the command

    cd /your/mautic/directory

The first step is to find out if there are any updates available using the following command:

    php app/console mautic:update:find

The output from this command will tell you if there are any updates to apply.  If there are, run the following command to apply them:

    php app/console mautic:update:apply

## I need help updating Mautic

If you are stuck and need help, there are several places you can go to ask for assistance.  Remember that most people who use the Community Forums, Slack and Github are volunteers.

If you think your configuration is causing the problem, ask on the [Mautic Community Forums][support-forums]. Search before you post, as it is likely someone might have already answered your question in the past.

You can also chat with someone in the live [Community Chat][mautic-slack].

In all cases, it is important that you describe the problem, and all steps you have followed to resolve the problem, in detail.  At a minimum, include the following:

* Steps to reproduce your problem - a step-by-step walk-through of what you have done so far
* The PHP version of your server
* The version of Mautic you are on, and the version you are aiming to update to
* The error messages you are seeing - if you don't see the error message directly, search for it in the app/logs folder and in the server log.  The server log can be found in different places depending on your setup. Ubuntu servers will generally have logs in /var/log/apache2/error.log.  Sometimes your hosting provider might offer a GUI to view logs in your Control Panel.

If you don't provide the information above as a minimum, the person who might try to help you will have to ask you for it, so please save them the trouble and provide the information upfront.  Also, importantly, please be polite.  Mautic is an Open Source project, and people are giving their free time to help you.

If you are sure that you have discovered a bug and you want to report it to developers, you can do so on [Github][mautic-github]

[update-failed]: </troubleshooting/update-failed>
[support-forums]: <https://forum.mautic.org/support>
[mautic-slack]: <https://mautic.org/slack>
[mautic-github]: <https://github.com/mautic/mautic/issues/new>