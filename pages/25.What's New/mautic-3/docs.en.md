---
title: 'Mautic 3'
taxonomy:
    category:
        - docs
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

----------------------------

## Version 3.0

Mautic 3.0 introduces significant changes to the underlying application along with some changes to the minimum version requirements to run Mautic. They are outlined as follows:

### Hosting Requirements

- The minimum PHP version is raised from 5.6.19 to 7.2.0.
- The minimum MySQL version is increased from version 5.5.3 to 5.7.14.

### Cron Jobs Update

There are significant changes in the file structure in Mautic 3. To comply with the change, you will need to update your cron jobs path.

Example:

`app/console mautic:segments:update`

should now be:

`bin/console mautic:segments:update`

> Note: For Mautic version 2.0, you must continue using the `app/console` path for running any cron job.

### Removed Plugins

Mautic 3.0 removed support for the Rackspace and OpenStack plugins for remote assets.

If you currently use Rackspace or OpenStack, you will need to switch to Amazon S3, or create custom plugins to support alternative providers.

### New File Manager for WYSIWYG Editors

When you try to upload an image or replace an existing image using the email or page builder, you will see a new file manager which you can use to drag and drop images.

![The new file manager window](/Users/favourkelvin/Documents/mautic-documentation/pages/25.What's New/file-manager.png)