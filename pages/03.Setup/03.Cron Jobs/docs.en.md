---
title: 'Cron jobs'
taxonomy:
    category:
        - docs
slug: cron-jobs
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

---------------------

>>> Mautic 3 introduced a new path for cron jobs `bin/console` - if you are using the legacy Mautic 2.x series you should replace this with the older version, `app/console`

Mautic requires a few [cron jobs][cron-jobs] to handle some maintenance tasks such as updating contacts or campaigns, executing campaign actions, sending emails, and more. You must manually add the required cron jobs to your server. Most web hosts provide a means to add cron jobs either through SSH, cPanel, or another custom panel. Please consult your host's documentation/support if you are unsure on how to set up cron jobs.

If you're new to Linux or Cron Jobs, then the Apache Foundation has [an excellent guide][apache-foundation-guide] which we would suggest that you read before asking questions via the various support channels.

When setting up cron jobs, you must choose how often you want the cron jobs to run. Many shared hosts prefer that you run scripts every 15 or 30 minutes and may even override the scheduled times to meet these restrictions. Consult your host's documentation if they have such a restriction.

**It is HIGHLY recommended that you stagger the following required jobs so as to not run the exact same minute.**

For instance:
- 0,15,30,45 <— mautic:segments:update
- 5,20,35,50 <— mautic:campaigns:update
- 10,25,40,55 <— mautic:campaigns:trigger

## Required
Mautic needs some mandatory cron jobs to run on a regular basis. They are listed as follows:

### Segments
**To keep the segments current:**

```
php /path/to/mautic/bin/console mautic:segments:update
```

By default, the script will process contacts in batches of 300. If this is too many for your server's resources, use the option `--batch-limit=X` replacing X with the number of contacts to process each batch.

You can also limit the number of contacts to process per script execution using `--max-contacts` to further limit resources used.

### Campaigns
**To keep campaigns updated with applicable contacts:**

```
php /path/to/mautic/bin/console mautic:campaigns:update
```

By default, the script will process contacts in batches of 300. If this is too many for your server's resources, use the option `--batch-limit=X` replacing X with the number of contacts to process each batch.

You can also limit the number of contacts to process per script execution using `--max-contacts` to further limit resources used.

**To execute campaigns events:**

```
php /path/to/mautic/bin/console mautic:campaigns:trigger
```

By default, the script will process events in batches of 100. If this is too many for your server's resources, use the option `--batch-limit=X` replacing X with the number of events to process each batch.

You can also limit the number of contacts to process per script execution using `--max-events` to further limit resources used.

**To send frequency rules rescheduled marketing campaign messages:**
Messages that are marked as [_Marketing Messages_][marketing-messages] (such as emails to be sent as part of a marketing campaign) , will be inserted into a message queue IF frequency rules are setup as either systemwide or per contact. To process this queue and reschedule sending these messages, this cron job should be added to your list of jobs:

`mautic:messages:send`

**NOTE** that these messages will only be added to the queue if frequency rules are applied either systemwide or per contact.

## Optional
Depending on your server configuration, you can set up additional cron jobs that are optional but can be used for tasks such as sending emails, importing contacts, and more. The optional cron jobs are listed as follows:

### Process Email Queue

If the system is configured to queue emails to the filesystem, a cron job is required to process them.

```
php /path/to/mautic/bin/console mautic:emails:send
```

### Fetch and Process Monitored Email

If you are using [Bounce Management][bounce-management], set up the following command to fetch and process messages:

```
php /path/to/mautic/bin/console mautic:email:fetch
```

### Social Monitoring

If you are using [Social Monitoring][social-monitoring], add the following command to your cron configuration:

```
php /path/to/mautic/bin/console mautic:social:monitoring
```

### Import Contacts
To import an especially large number of contacts in the background, use the following command:

```
php /path/to/mautic/bin/console mautic:import
```

The time taken for this command to execute depends on the number of contacts in the CSV file. However, on successful completion of the import operation, a notification will appear on the Mautic dashboard.


### Webhooks

If Mautic is configured to send webhooks in batches, use the following command to send the payloads:

```
php /path/to/mautic/bin/console mautic:webhooks:process
```

### Update MaxMind GeoLite2 IP Database

Mautic uses [MaxMind's][maxmind] GeoLite2 IP database by default. The database is licensed under the [Creative Commons Attribution-ShareAlike 3.0 Unported License][ccasa-unported-license] and thus cannot be packaged with Mautic. The database can be downloaded manually through Mautic's Configuration or the following script can be used as a cron job to automatically download updates. (MaxMind updates their database the first Tuesday of the month).

```
php /path/to/mautic/bin/console mautic:iplookup:download
```

### Clean up Old Data

Clean up a Mautic installation by purging old data. Note that not all data is able to be purged. Currently supported are audit log entries, visitors (anonymous contacts), and visitor page hits. Use `--dry-run` to view the number of records to be purged before making any changes.

Use ‘--gdpr’ flag to delete data to fulfill GDPR European regulation. This will delete leads that have been inactive for 3 years.

**This will permanently delete data! Be sure to keep database backups.**

```
php /path/to/mautic/bin/console mautic:maintenance:cleanup --days-old=365 --dry-run
```

### MaxMind CCPA compliance

MaxMind requires users to keep a "Do Not Sell" list up to date, and remove all data that was added relating to those IP addresses in the past from MaxMind.

See more details in the official MaxMind website: [https://blog.maxmind.com/tag/ccpa/][maxmind-ccpa]

It is recommended to run these two commands once per week, one after another.

```
php /path/to/mautic/bin/console mautic:donotsell:download
```
This command will download the database of Do Not Sell IP addresses from MaxMind.

```
php /path/to/mautic/bin/console mautic:max-mind:purge
```
This command will find data in the database that was loaded from MaxMind's Do Not Sell IP addresses and deletes the data.

### Send Scheduled Broadcasts (e.g. segment emails)

Starting with Mautic 2.2.0, it is now possible to use cron to send scheduled broadcasts for channel communications. The current only implementation of this is for segment emails. Instead of requiring a manual send and wait with the browser window open while ajax batches over the send - a command can now be used. The caveat for this is that the emails must be published and must have a published up date - this is to help prevent any unintentional email broadcasts. Just as it was with the manual/ajax process - only contacts who have not already received the specific communication will have it sent to them. This command will send messages to contacts added to the source segments later, so if you don't want this to happen, set an unpublish date.

```
php /path/to/mautic/bin/console mautic:broadcasts:send [--id=ID] [--channel=CHANNEL]
```

#### Command parameters:

- `--channel=email` what channel to execute. All channels will be sent if none provided all channels.

- `--id=X` is what ID of email, SMS or other entity to send.

- `--limit=X` is how many contacts are pulled from the database to be processed. 100 by default. So X contacts will receive their emails if this command is triggered. Next time the contact runs it will be next X contacts and so on.

- `--batch=X` is in how big batches will the emails be sent at once. This can be different for every provider. For example Mautic has API connection to Sparkpost. Such API can send 1000 emails per 1 call. So batch should be 1000 for fastest sending speed. Not more. But SMTP providers cannot handle 1000 at 1 time.

- `--min-contact-id` and `--max-contact-id` will allow to separate email sending by smaller chunks by contact ID ranges. If those ranges won't overlap this allows to run several broadcast commands in parallel.

### Send Scheduled Reports

Starting with Mautic 2.12.0, it is now possible to use cron to send scheduled reports.

```
php /path/to/mautic/bin/console mautic:reports:scheduler [--report=ID]
```

>**Note**: For releases prior to 1.1.3, it is required to append ` --env=prod` to the cron job command to ensure commands execute correctly.

### Configure Mautic Integrations
To perform synchronization of all integrations and to manage plugins, use the cron job commands in this section.

**To fetch leads from the integration:**

```
php /path/to/mautic/bin/console
mautic:integration:fetchleads
```

or

```
php /path/to/mautic/bin/console
mautic:integration:synccontacts
```

**To push lead activity to an integration:**

```
php /path/to/mautic/bin/console
mautic:integration:pushactivity
```
 or

 ```
php /path/to/mautic/bin/console
mautic:integration:pushleadactivity
 ```

These commands work with all available plugins. To avoid performance issues when using multiple integrations, you must specify the name of the integration to be performed by adding the `–integration` suffix to the command. For instance, for integration of Mautic with Hubspot, use the following command:

```
php /path/to/mautic/bin/console
mautic:integration:fetchleads --integration=Hubspot
mautic:integration:pushactivity --integration=Hubspot
```

**To  install, update, enable, or disable plugins:**

```
php /path/to/mautic/bin/console
mautic:plugins:reload
```

> Note: You can replace `mautic:plugins:reload` with `mautic:plugins:install` or `mautic:plugins:update`. They are the same commands with different alias.

## Tips & Troubleshooting

If your environment provides a command-line specific build of php, often called `php-cli`, you may want to use that instead of `php` as it will have a cleaner output.  On BlueHost and probably some other PHP hosts, the `php` command might be setup to discard the command-line parameters to `console`, in which case you must use `php-cli` to make the cron jobs work.

To assist in troubleshooting cron issues, you can pipe the output of each cron job to a specific file by adding something like `>>/path/to/somefile.log 2>&1` at the end of the cron job. Then you can look at the contents of the file to see what was printed. If an error is occurring when running run the cron job, you will see it there, otherwise the file will be empty or have some stats. The modification time of the file informs you of the last time the cron job ran. You can thus use this to figure out whether or not the cron job is running successfully and on schedule. In addition it is recommended to enable the non-interactive mode together with the no-ansi mode when you run your commands using cron. This way you ensure, that you have proper timestamps in your log and the output is more readable.

Example output
```
$ php bin/console mautic:segments:update --no-interaction --no-ansi
[2016-09-08 06:13:57] Rebuilding contacts for segment 1
[2016-09-08 06:13:57] 0 total contact(s) to be added in batches of 300
[2016-09-08 06:13:57] 0 total contact(s) to be removed in batches of 300
[2016-09-08 06:13:57] 0 contact(s) affected
```


If you have SSH access, try to run the command directly to see if any errors are generated. If there is nothing printed from either in a SSH session or in the cron output from above, check the server's logs. If you see similar errors to `'Warning: Invalid argument supplied for foreach()' in /vendor/symfony/console/Symfony/Component/Console/Input/ArgvInput.php:287`, you either need to use `php-cli` instead of `php` or try using `php -d register_argc_argv=On`.
`

[cron-jobs]: <https://en.wikipedia.org/wiki/Cron>
[apache-foundation-guide]: <https://www.howtoforge.com/a-short-introduction-to-cron-jobs>
[maxmind]: <http://www.maxmind.com>
[ccasa-unported-license]: <http://creativecommons.org/licenses/by-sa/3.0/>
[marketing-messages]: </contacts/message-queue>
[bounce-management]: </channels/emails/bounce-management>
[social-monitoring]: </channels/social-monitoring>
