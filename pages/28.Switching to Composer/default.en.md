---
title: 'Switch to Composer'
slug: switch-to-composer
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

Up until Mautic 4, users could download Mautic as a ZIP file and install it on any PHP server. However, many users were running into installation and update errors, many of which caused considerable frustration and in some cases, significant business disruption. Next to that, Mautic recently introduced the [Marketplace][marketplace] which isn't compatible with this installation method.

For the reasons mentioned above, Mautic will require all users to use Composer-based installations starting from Mautic 5. Read more in [this blog post][upgrade-changes].

### How do I switch to a Composer-based installation?

Before we start, it's good to understand that there's two aspects to Mautic:
- The database. Here, all your contact data etc. is stored.
- The codebase. This is where Mautic interacts with the database.

When switching to a Composer-based installation, the **database** will not be touched. You will only be replacing the **codebase**.

In this tutorial, we'll assume that Mautic is currently installed in `/var/www/html`.

Here's the steps you will need to follow to switch to a Composer-based installation:

1. Go to `/var/www`
1. Run `composer create-project mautic/recommended-project:4.x-dev html-new --no-interaction`
1. Copy the following files and folders from `/var/www/html` to `/var/www/html-new`:
    - Configuration files - in most cases this can be found at `app/config/local.php` and should be moved to `docroot/app/config/local.php`
    - The entire `plugins` directory which should be moved to `docroot/plugins`
    - Uploads - in most cases this can be found at `app/media/files` and `app/media/images` which should be moved to `docroot/app/media/files` and `docroot/app/media/images` respectively
    - Custom dashboards from `app/media/dashboards` which should be moved to `docroot/app/media/dashboards`
    - Any custom themes from `themes` which should be moved to `/docroot/themes`
1. Rename `/var/www/html` to `/var/www/html-old` and `/var/www/html-new` to `/var/www/html`
1. When you're done, you will have to update your webserver configuration to point to `/var/www/html/docroot` instead of `/var/www/html`
1. You have now switched to a Composer-based installation! Test if Mautic works as expected.

## Frequently Asked Questions (FAQs)

Q: Can I keep my existing data?

A: Yes you can! Switchting to the Composer-based installation only affects app files. Nothing will happen to your data.

Q: What is the minimum Mautic version I need to switch to the Composer-based installation?

A: You need at least Mautic 4.0.0 for switching to the Composer-based installation.
