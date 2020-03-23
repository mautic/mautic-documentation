---
title: 'Working with php.ini resource limits'
media_order: 64cb269464e6bfc29022160cf4cc869cfb840b2b_2_690x322.png
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
    * Access to a text editor such as nano or Vi

> Note: nano is used in this walkthrough, if you don't use Nano simply replace 'nano' with the name of the editor you prefer to use. See [this resource][nano-kb-shortcuts] for a useful keyboard shortcut guide when using Nano.

If you do not have either of these, or if you do not feel confident making these changes, you will probably need to raise a support ticket with your hosting provider or hire a freelancer to make these changes for you.
    
## Find the php.ini file being loaded

The first step is to find which php.ini file is being loaded.  The [php.ini file][php-ini] is a configuration file which controls how PHP functions.

### I have access to Mautic
If you have access to your Mautic instance, navigate to Settings > System Info > PHP Info where you will be able to view a file which tells you every configuration setting for PHP that Mautic is using.  In particular, the areas outlined in red in the screenshot below will give you the paths to the relevant files.

![](64cb269464e6bfc29022160cf4cc869cfb840b2b_2_690x322.png)

### I do not have access to Mautic
If you can't access the System Info page of Mautic, you can manually generate a PHP Info page by placing a file in the root of your Mautic directory.

Create a file called info.php using the following command:

`nano info.php` 
    
In this file, paste the following:

```
<?php

// Show all information, defaults to INFO_ALL
phpinfo();

?>
```

Save this file, then browse to it in your web browser of choice.  

For example, https://example.com/mautic/info.php where your Mautic installation is within a folder called 'mautic' on your domain.

## A note on local v master values

When you view the PHP info file, you will notice two values, Master and Local.

### Master Value
This comes from your main php.ini file (the one being loaded above in the ‘Loaded configuration file’ section). This is the value which applies server-wide.

### Local Value
The global setting can be overridden locally in multiple locations, such as httpd.conf, .htaccess or other Apache configuration.

This is often used to get around restrictive settings at the server level, and can sometimes mean that making changes at the top global level doesn’t trickle down to your specific folder or location. So if you have a discrepancy between the two, check for a local .htaccess or a *.ini file within your Mautic directory (or check with your hosting provider!)

## Updating the value

Once you have located the php.ini file that is being used, you should be able to edit it using the following command:

```sudo nano path/to/file/php.ini```

Find the relevant setting using ctrl+w (keyboard shortcut for 'where') and then typing the setting you need to change - e.g. upload_max_filesize.

Change the value you see in the php.ini file, and then save, using ctrl+x (keyboard shortcut for 'exit') and then pressing 'y' to save changes.

## Restarting Apache

Once the changes have been saved, you will need to restart Apache for the changes to take effect.

It is always a good idea to do a dry-run first, using the following command

`sudo apachectl configtest`

This checks that your Apache configuration is sound before you restart the service.  Resolve any issues that are identified before restarting Apache.

Once you are happy, run the following command to restart Apache:

### Ubuntu and Debian
`sudo systemctl restart apache2`

### CentOS and Red Hat
`sudo systemctl restart httpd`

## Overriding the value
If you are not able to change the value at the php.ini level, it may be possible (dependant on your server configuration) to override the value at the local folder level.

Check out [this article][php-configuration] for more details on how to override the php.ini settings with a local .htaccess file.

As an example of two settings you may wish to use in a local htaccess file to override the values in the global php.ini file:

`php_value upload_max_filesize 20M`
`php_value max_execution_time 600`

This should be considered as a last resort, and may not be supported by your hosting provider.

[php-ini]: (https://www.php.net/manual/en/configuration.file.php)
[nano-kb-shortcuts]: (https://staffwww.fullcoll.edu/sedwards/Nano/NanoKeyboardCommands.html)
[php-configuration]: (https://www.php.net/manual/en/configuration.changes.php)
