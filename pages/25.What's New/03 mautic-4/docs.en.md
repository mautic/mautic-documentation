---
title: 'Mautic 4'
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

## Version 4.0

Mautic 4.0 brings several long-awaited features in Mautic. They are outlined as follows:

### Hosting Requirements

- The minimum PHP version is raised from 7.3 to 7.4.
- The minimum MySQL version is increased from version 5.5.3 to 5.7.14.

## Update to Mautic 4

Before you consider updating to Mautic 4, you must be running at least the latest stable version of Mautic 3. Updating from Mautic 2 to Mautic 4 is not, and will not, be supported. Once you have tested your backup, you can proceed with the update.

## New email and landing page builder

The new email and landing page builder is enabled by default - you can disable it under Plugins if you prefer to continue using the legacy builder, until Mautic 5 when the legacy builder will be removed. Ensure you reload the page if you disable the new builder.

## Updated themes

All themes you wish to use in the new builder will need a simple, one line change to be made in their configuration file. Read the documentation here.

## OAuth2 support

OAuth1 support has been removed. Mautic supports the OAuth2 standard, including the Client Credentials grant, which was added in Mautic 4. Documentation can be found [here][developer]


[developer]: <https://developer.mautic.org/#client-credentials>