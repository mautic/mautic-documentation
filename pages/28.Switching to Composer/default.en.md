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

Up until Mautic 4, users could simply download Mautic as a ZIP file and install it on any PHP server. However, many users were running into installation and update errors (TODO maybe link background article?). Next to that, Mautic recently introduced the Marketplace (TODO link to docs page on Marketplace) which isn't compatible with this installation method.

For the reasons mentioned above, Mautic will require all users to use Composer-based installations starting from Mautic 5.

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
    - Configuration files - in most cases this can be found at `app/config/local.php`
    - The entire `plugins` directory
    - Uploads (TODO specify exact paths)
    - Anything else I forgot??? Themes?
1. Rename `/var/www/html` to `/var/www/html-old` and `/var/www/html-new` to `/var/www/html`
1. When you're done, you will have to update your webserver configuration to point to `/var/www/html/docroot` instead of `/var/www/html`
1. You have now switched to a Composer-based installation! Test if Mautic works as expected.

## Frequently Asked Questions (FAQs)

Q: Can I keep my existing data?

A: Yes you can! Switchting to the Composer-based installation only affects app files. Nothing will happen to your data.

Q: What is the minimum Mautic version I need to switch to the Composer-based installation?

A: You need at least Mautic 4.0.0 for switchting to the Composer-based installation.
