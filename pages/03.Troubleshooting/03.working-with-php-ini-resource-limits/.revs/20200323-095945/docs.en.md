---
title: 'Working with php.ini resource limits'
published: false
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

---
You may come across limitations with your server configuration when installing or using Mautic.  These commonly manifest as errors such as:

    The Uploaded file exceeds the upload_max_filesize directive

    Maximum execution time of 30 seconds exceeded - in file <filepath> - at line <line number> 

    PHP Error: Allowed memory size of <number> bytes exhausted (tried to allocate <number> bytes) - in file <filepath> - at line <number>

These are, in general, **not** errors with Mautic, they are related to the way in which your server has been configured.  To resolve these issues you will need to make some changes to your server configuration.

## Requirements

To resolve these problems you will require:
    * Access to your server to change configuration files - generally via SSH - or;
    * Access to your hosting provider's Control Panel, which _may_ allow you to change these settings via the User Interface

If you do not have either of these, you will probably need to raise a support ticket with your hosting provider.
    
## Find the php.ini file being loaded

The first step is to find which php.ini file is being loaded.  The [php.ini file][php-ini] is a configuration file which controls how PHP functions.

### I have access to Mautic
If you have access to your Mautic instance, navigate to Settings > System Info > PHP Info where you will be able to view a file which tells you every configuration setting for PHP that Mautic is using.



[php-ini]: (https://www.php.net/manual/en/configuration.file.php)
