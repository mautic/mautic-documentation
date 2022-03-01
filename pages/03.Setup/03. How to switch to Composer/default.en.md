---
title: 'How to switch to Composer'
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

For the reasons mentioned previously, from the release of Mautic 5, Composer becomes the default way to install and update Mautic. Read more in [this blog post][upgrade-changes].

### How to switch to a Composer-based installation?

Before starting, it's good to understand that there's two aspects to Mautic:
- The database. This is where Mautic stores your Contact data.
- The codebase. This is where Mautic interacts with the database.

When switching to a Composer-based installation, the **database** isn't touched, only the **codebase**.

In this tutorial, it's assumed that Mautic is currently installed in `/var/www/html`.

Here's the steps to follow to switch to a Composer-based installation:

1. Go to `/var/www`
1. Run `composer create-project mautic/recommended-project:^4 some-dir --no-interaction`
1. Copy the following files and folders from `/var/www/html` to `/var/www/html-new`:
    - Configuration files - in most cases, located at `app/config/local.php` - move to `docroot/app/config/local.php`
    - The entire `plugins` directory - move to `docroot/plugins`
    - Uploads - in most cases, located at `app/media/files` and `app/media/images` - move to `docroot/app/media/files` and `docroot/app/media/images` respectively
    - Custom dashboards from `app/media/dashboards` - move to `docroot/app/media/dashboards`
    - Any custom themes from `themes` - move to `/docroot/themes`
1. Rename `/var/www/html` to `/var/www/html-old` and `/var/www/html-new` to `/var/www/html`
1. When you're done, update your web server configuration to point to `/var/www/html/docroot` instead of `/var/www/html`
1. You have now switched to a Composer-based installation. Test if Mautic works as expected.

## Frequently Asked Questions (FAQs)

Q: Is existing data retained?

A: Yes. Switching to the Composer-based installation only affects app files. Nothing happens to your data.

Q: What's the minimum Mautic version required to switch to the Composer-based installation?

A: You need at least Mautic 4.0.0 for switching to the Composer-based installation.

[marketplace]: </marketplace>
[upgrade-changes]: <https://www.mautic.org/blog/community/important-changes-mautic-install-and-upgrade-process>