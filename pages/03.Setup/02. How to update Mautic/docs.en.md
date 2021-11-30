---
title: 'How to update Mautic'
taxonomy:
category:
- docs
slug: how-to-update-mautic
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

There are two ways to update Mautic:

1. [Using the Command Line][command-line-update] - recommended
2. Through the [user interface][user-interface-update]

If your instance is in production, has a large number of contacts and/or is  on shared hosting, it's **strongly** recommended that you update at the command line.

>>>> Updating in the user interface requires a significant amount of resources, and can be error-prone if the server restricts resource allocation. This can lead to failed updates and corrupted data.

## Stability levels
By default, Mautic receives notifications both in the user interface and at the command line for stable releases only.

If you wish to help with testing early access releases in a development environment, please edit your configuration and set the stability level to Alpha, Beta, or Release Candidate. This allows you to receive notifications for early access releases. **Always** read the release notes before updating to an early access release.

>>>> Never enable early access releases for production instances

## What to do if you need help updating Mautic

If you need help, there are several places you can go to ask for assistance. Remember that most people who use the Community Forums, Slack, and GitHub are volunteers.

If you think your configuration is causing the problem, ask on the [Mautic Community Forums][support-forums]. Search before you post, as it's likely someone might have already answered your question in the past.

You can also chat with someone in the live [Community Chat][mautic-slack] however you must post all support requests on the forums. Post there first, then drop the link to the post in Slack if you are discussing it with someone.

In all cases, it's important that you describe the problem, and all steps you have followed to resolve the problem, in detail. At a minimum, include the following:

* Steps to reproduce your problem - a step-by-step walk-through of what you have done so far
* The PHP version of your server
* The version of Mautic you are on, and the version you are aiming to update to
* The error messages you are seeing - if you don't see the error message directly, search for it in the var/logs folder within your Mautic directory and in the server logs. Server logs are in different places depending on your setup. Ubuntu servers generally have logs in /var/log/apache2/error.log. Sometimes your hosting provider might offer a graphical interface to view logs in your Control Panel.

If you don't provide the information requested as a minimum, the person who might try to help you has to ask you for it, so please save them the trouble and provide the information upfront. Also, importantly, please be polite. Mautic is an Open Source project, and people are giving their free time to help you.

If you are sure that you have discovered a bug and you want to report it to developers, you can do so on [GitHub][mautic-github]. GitHub **shouldn't** be where you request support or ask for help with configuration errors. Always post on the forums first if you aren't sure, if a bug report is appropriate this can link to the forum thread.

[command-line-update]: </setup/how-to-update-mautic/updating-at-command-line>
[user-interface-update]: </setup/how-to-update-mautic/updating-in-the-browser>
[support-forums]: <https://forum.mautic.org/support>
[mautic-slack]: <https://mautic.org/slack>
[mautic-github]: <https://github.com/mautic/mautic/issues/new>
