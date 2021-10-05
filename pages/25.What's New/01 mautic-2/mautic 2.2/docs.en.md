---
title: 'Mautic 2.2'
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
## Version 2.2

Mautic 2.2 introduces a handful of new features and some new capabilities that we think will continue to set you and your marketing apart. The full release notes are at [https://github.com/mautic/mautic/releases/tag/2.2.0][release-2.2]


### Hosting Requirements

- The PHP minimum version is now 5.6.19 (PHP 7 is supported!)
- The MySQL minimum version is now 5.5.3
- PostgreSQL support has been dropped


### Dynamic Email Content

Users now have the ability to vary content in their email based on filters. Instead of creating multiple emails for slightly different messages, users can now save time by creating one email and can insert variations of content into the email. The content will be dynamic at the time of sending the email.

### Account Based Marketing

A new entity has been created called ‘Companies’. Every contact will be associated to a Company and users will now have an all-company view of contacts. This means they will be able to see all contacts associated with a company, create filters and trigger actions based on company criteria. Marketers can now focus on nurturing, analyzing and converting a targeted group of accounts (or Companies) to implement Account Based Marketing.

### Recency/Frequency

For contacts subject to frequency limits, emails sent to them are now put in a queue to send once the limit timeframe has passed. Users can specify the priority on marketing emails to prevent backlogs and ensure important messages are sent in a timely manner.

### Update to forms

The form experience has been vastly improved. Users can now successfully pick a theme to apply to a form. In addition, results of a campaign form can be sent to a specified email address. Page breaks have been added to make forms more digestible to the contact filling out the form. Data from one form can be written to another. Syncing data between contact fields and forms has also been upgraded – changes made to contact fields can be easily written to forms; values from a form can be transformed and written to contact fields. Users also have the ability to further ppersonalize thank you pages using tokens.

### New Plugins

Two plugins have been created for this release. The first is the Gmail plugin. This is a Chrome and Firefox plugin that shows timeline data from Mautic right in the browser. Also, when writing an email to an individual, the email can be tracked and written to the contact’s timeline in Mautic by clicking a little checkbox. The second plugin is the Outlook plugin. Emails sent from Outlook can be written to and tracked in Mautic. Check these out!


[release-2.2]: <https://github.com/mautic/mautic/releases/tag/2.2.0>