---
title: 'Mautic 2.16.0'
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
## Version 2.16

This release 2.16 includes many enhancements and bug-fixes. The full release notes are at [https://github.com/mautic/mautic/releases/tag/2.15.3][release-2.15.3]



### Hosting Requirements

- The PHP minimum version is now 5.6.19 (PHP 7.3  is supported!)


### New Campaign Actions

This feature allows you to have a step in your campaigns which enables assigning of the ‘Do Not Contact’ status to a lead. Previously this could not be done as part of a campaign.

### Update to the Zoho CRM integration to support the new v2 API from Zoho

The Zoho CRM integration is improved to use the v2 API

### Update to Salesforce integration to support TLS 1.2

The Salesforce integration uses tls 1.2 since Salesforce disabled 1.1

### SameSite cookie fix for Chrome 80 and other browsers 

For future browsers verison samesite=None attribute

### Fix for Maxmind IP lookup feature requiring authorization

If you want to use MaxMind IP lookup, you now need to configure a license key (free) due to changes to their API. Please read the Mautic-specific instructions [here].





[release-2.15.3]: <https://github.com/mautic/mautic/releases/tag/2.16.0>
[here]: </setup/maxmind-license>