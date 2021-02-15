---
title: 'Getting started'
---

Are you ready for Mautic 3? Let's get started!

### I don't want to upgrade to Mautic 3 yet, how do I turn off upgrade notifications?
That's absolutely fine! This is handy, for example, when you use custom plugins that aren't ready for Mautic 3 (yet). The only thing you have to do is to go to `app/config/local.php` and add the following setting there:

```PHP
'block_mautic_3_upgrade'    => true,
```

The Mautic 3 upgrade notification will now disappear. If it doesn't disappear immediately, you can run `app/console mautic:update:find` on the command line so that it's hidden immediately.

### Choose your update method (web interface or CLI)
.... (add steps + screenshots here)

### Updating cron jobs
Because there are significant changes in Mautic 3's file structure, you will need to upgrade your cron jobs.

Example:

`app/console mautic:segments:update`

should now be:

`bin/console mautic:segments:update`