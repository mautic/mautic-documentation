---
title: 'Features by major release'
media_order: ''
body_classes: ''
order_by: ''
order_manual: ''
slug: features-by-major-release
taxonomy:
    category:
        - docs
---

----------------------------
In this section we'll highlight the new features for each major release of Mautic.  They are in version order beginning with the latest.

##Version 3.0
Mautic 3.0 introduces significant features and a number of enhancements. They are outlined as follows:

###Hosting Requirements
- Mautic 3.0 added support for PHP versions 7.2 and 7.3. The minimum PHP version is raised from version 5.6.19 to version 7.2.0.
- The minimum MySQL version is increased from version 5.5.3 to 5.7.14.

###Cron Jobs Update
There are significant changes in the file structure in Mautic 3. To comply with the change, you will need to update your cron jobs path.

Example:

`app/console mautic:segments:update`

should now be:

`bin/console mautic:segments:update`

> Note: For Mautic version 2.0, you must continue using the `app/console` path for running any cron job.

###Removed Plugins
Mautic 3.0 removed support for the Rackspace and OpenStack plugins for remote assets.
While uploading an asset on the New Asset page, if you select Remote Storage location and click Browse Remote Files, you will see only Amazon S3 as the available plugin. The Rackspace and OpenStack plugins are no longer available.

![](remote-asset.png)

##Version 2.0
Mautic 2.0 brought a significant number of enhancements to Mautic.  The full release notes are at https://github.com/mautic/mautic/releases/tag/2.0.0.

###Hosting Requirements
- The PHP minimum version is now 5.6.19 (PHP 7 is supported!)
- The MySQL minimum version is now 5.5.3
- PostgreSQL support has been dropped

###Cron Jobs Update
See [Cron Jobs](./../setup/cron_jobs.html)

###Froala editor

This release switches CKEditor in favor of Froala editor which has a more polished look and functionality.

###New email and page builders!

Email and page builders have been overhauled to be cleaner and better. This means that custom themes have changed as well.
[Watch this video for more.](https://mautic.wistia.com/medias/vtdlpc365u)

###Dynamic web content

You can now push contact aware content to your web pages through Mautic campaigns.  See [Dynamic Web Content](./../dwc/index.html)

###Bi-directional Salesforce Integration
This much anticipated feature is now in Mautic!  For an overview [watch this video](https://mautic.wistia.com/medias/4631xkjcw8).

###Lifecycle stages

You can now track your contacts through various stages and lifecycles.
[Watch this video for more.](https://mautic.wistia.com/medias/ourd9qpfhy)

###Updated Dashboard

Drag and Drop with new widgets for end-to-end attribution and more.
[Watch this video for an overview.](https://mautic.wistia.com/medias/qzoqsqko12)

###UTM Tags
A simple code you can attach to a custom URL to track content and more.  The UTM tags that are currently supported are:
- utm_campaign
- utm_content
- utm_medium
- utm_source
- utm_term

For more information on this [watch this video.](https://mautic.wistia.com/medias/vmqohgece0)
