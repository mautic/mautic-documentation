---
title: 'Getting started'
---

Add some getting started steps here. 

## Updating cron jobs
Because there are significant changes in Mautic 3's file structure, you will need to upgrade your cron jobs.

Example:

`app/console mautic:segments:update`

should now be:

`bin/console mautic:segments:update`