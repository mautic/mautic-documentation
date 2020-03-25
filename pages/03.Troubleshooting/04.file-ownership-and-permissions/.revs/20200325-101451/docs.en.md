---
title: 'File ownership and permissions'
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
If you experience errors like the following:
```
mautic.WARNING: PHP Warning - require(/mautic/app/cache/prod/doctrine/orm/Proxies/__CG__MauticCategoryBundleEntityCategory.php): failed to open stream: No such file or directory - in file /mautic/vendor/doctrine/common/lib/Doctrine/Common/Proxy/AbstractProxyFactory.php - at line 209
```
there is a strong likelihood that you have problems with the permissions and/or ownership of the files and folders on your Mautic instance.

This article is written from the perspective of a Linux server using Apache, which is the most common hosting environment for Mautic. Nginx and IIS servers will have different configurations, but the principles remain the same.

## Why are permissions important?
File and folder permissions specify who and what can read, write, modify, and access them. Ownership determines which user 'owns' the files and folders - and hence is able to carry out actions based on the permission settings.  

### User
A user is the owner of the file. By default, the person who created a file becomes its owner. Hence, a user is also sometimes called an _owner_.

### Group
A group can contain multiple users. All users belonging to a group will have the same access permissions to the file. Groups are used to simplify permissions - all users in a specific group will inherit the permissions assigned to that group, rather than having to assign permissions to each user individually.

### Other
Any other user who has access to a file comes into 'Other', meaning they have neither created the file, nor belong to a usergroup that owns the file. Practically, this means 'the rest of the world'. Hence, this is also referred to as _permissions for the world_.

Linux distinguishes between these three user types to prevent users accessing, editing or deleting files they should not be able to change. Read more about [file and folder ownership][ownership].

Permissions and ownership settings are critical to ensuring the security of your server and Mautic instance, so it's important to get them right!  If your files don’t have the appropriate permissions in place, it’s easier for hackers to intrude on your files and gain access to your Mautic instance. Setting your file permissions correctly may not save you from all attacks, but it will help make your Mautic instance a bit more secure.

## Why do permissions problems cause errors in Mautic?

Mautic needs access to read and write files in the Mautic directory to enable certain functions and scripts to run. If the permissions are not set correctly, or if the user that is trying to run them does not have the correct access, Mautic will not be able to function and you will see errors in the application and server logs.

Problems with permissions and ownership generally occur because:
* You've uploaded Mautic or made changes to files and folders as a different user to the one that Mautic uses to run - for example you uploaded files using 'user' but your web server executes scripts as www-data.
* The user that Mautic uses to run does not have the appropriate permissions on the files and folders - for example, 'user' isn't able to create directories, or read files
* An update has been run as a different user to that which Mautic uses to run - resulting in some files and folders having their ownership changed

## How to fix permission-related problems in Mautic
Resetting the permissions of your files and folders requires running some commands at the command line. You will need to have SSH access to your server, or ask someone who does to execute these commands for you.  Some hosting providers may be able to create a script to periodically reset permissions if this becomes an ongoing problem for you.

### Identifying the problem
Log into your server using SSH, and change to the Mautic directory using the command

`cd path/to/mautic`

In this directory, execute the following command:

`ls -l`

The `ls` command will list files and directories. It has an option of -l, which lists the contents in a long format, including their permissions and ownership amongst other information.

For a more detailed explanation of what all the information means, take a look at [this article][ls-syntax]

The key information we are looking for is in the first, third and fourth columns - the permissions, and the user and group owning the files/folders.

### Reset the file and folder permissions
If your file and folder permissions are incorrect, you can run the following commands to reset them:

```
find . -type f -not -perm 644 -exec chmod 644 {} +
find . -type d -not -perm 644 -exec chmod 755 {} +
chmod -R g+w app/cache/ app/logs/ app/config/
chmod -R g+w media/files/ media/images/ translations/
rm -rf app/cache/*
```

### Change ownership of files and folders

If your files and folders are owned by the wrong user, you will continue to experience errors even with the correct file and folder permissions. This is because the user may not have the permission (as they are not the owner of the files/folders) that is required.  Read more about [file and folder ownership][ownership]

>To find out which user Apache is running as, execute the following command and take note of the first entry in the line which is returned:
>
> `ps aux | grep apache2`
> 
> Use this information to find the groups with the following command
> 
> `groups apache_user` (where apache_user is the user you identified from the first step above)

To reset the ownership of files and folders, use the following command (ensuring that you **replace apache_user and apache_group** with the values identified in the steps above):

`sudo chown -R apache_user:apache_group`

This command **ch**-anges **own**-ership, using the -R flag which means recursively - including all files/folders within that location. [Read more about the chown command][chown-command]

[ls-syntax]: (https://www.garron.me/en/go2linux/ls-file-permissions.html)
[ownership]: (https://www.thegeekdiary.com/understanding-basic-file-permissions-and-ownership-in-linux/)
[chown-command]: (https://linuxize.com/post/linux-chown-command/)