---
title: 'Updating in the browser'
taxonomy:
category:
- docs
slug: updating-in-the-browser
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

When updating Mautic, there are several tasks which can take a long time to complete depending on the size of your Mautic instance.

>>>> If you have a lot of contacts and/or use shared hosting, you might run into problems when updating with the notification 'bell' icon in Mautic. 

When updating within the browser, problems usually manifest as the update hanging part way through, or crashing with an error. They often arise as a result of resource limitation, particularly on shared hosting environments. 

For this reason, it's always recommended that you [update at the command line][command-line-update] wherever possible.

Before you commence updating, **please ensure that you have a tested backup of your Mautic instance**. This means that you have downloaded the files and database of your Mautic instance, and you have re-created it in a test environment somewhere and tested that everything is working as expected. This is your only recourse if there are any problems with the update. Never update without having a working, up-to-date backup.

## Checking for updates

When Mautic makes a new release, a notification appears in your Mautic instance.

The notification links to an announcement post which explains what the release includes. 

>>>>>> It's a good idea to read the announcement link for information about the release. There may be important information or steps that you may need to take before updating.

Once you have thoroughly read the release notes, and have tested your backup Mautic instance, you can click the notification to complete the update.

The update takes time to complete, and each step updates in the browser as it proceeds. Be patient and allow it to finish. On completion, a message confirms that the update has completed successfully.

## The update wasn't successful

If this has happened to you, head over to the [Update Failed][update-failed] page for a step-by-step walk-through of how to complete the update. Maybe consider using the command line next time.

[command-line-update]: </setup/how-to-update-mautic/updating-at-command-line>
[update-failed]: </troubleshooting/update-failed>



