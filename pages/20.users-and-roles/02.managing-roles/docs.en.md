---
title: 'Managing Roles'
media_order: 'screenshot-local.mautic3-2020.11.21-13_36_43.png,screenshot-local.mautic3-2020.11.21-13_39_46.png'
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

Roles are used in Mautic to control what resources and actions a user can access.

## Creating a new role

To create a new role, navigate to Roles using an Administrator account via the Settings cog at the top right of the screen and selecting 'Roles'.  Then click on 'New'.

### Full System Access

If you enable the 'Full System Access' switch, you are creating an Administrator account which has the highest level of access to your Mautic instance.  

![Screenshot showing Full System Access switch](screenshot-local.mautic3-2020.11.21-13_36_43.png)

These accounts should be limited, and you should ensure that they have secure credentials.

If you select this option, you will not be able to configure anything under 'Permissions' because by default, this account has full access to everything.

### Setting granular permissions

Mautic allows you to create roles with granular permissions for each bundle - or part - of Mautic.  

To configure a role, leave the Full System Access switch at 'No' and click on the Permissions tab to start building the role.

![Screenshot showing granular permissions](screenshot-local.mautic3-2020.11.21-13_39_46.png)

#### Explaining the permission options

There are several different permission options that can be selected:

* View - this allows the users with this role to view this part of Mautic
* Edit - this allows the users with this role to make changes to this part of Mautic
* Create - this allows the users with this role to create new resources in this part of Mautic
* Delete - this allows the users with this role to delete resources in this part of Mautic
* Publish - this allows the users with this role to make resources in this part of Mautic available by publishing them
* Full - this allows the users with this role all of the permissions above

There are permission levels relating to resources the user has created themselves, and those created by others:

* Own - this allows the users with this role to view/edit/delete/publish their own resources in this part of Mautic, but not those created by others
* Others - this allows the users with this role to view/edit/delete/publish their own resources in this part of Mautic, and those created by others

Since the 3.2 release there is a permission level to prevent users from exporting resources:

* Export Access - Select disable to prevent the users with this role from exporting resources from this part of Mautic

There are permission levels relating to being able to manage resources:

* Manage - this allows the users with this role to manage resources in this area of Mautic (for example, managing custom fields or plugins)

There are permission levels relating to what fields in the Users section can be edited:

* Specified fields - allow or deny the users with this role to edit specified fields in the Users section (e.g. Name, Username, Email, Position)
* All - this allows the users with this role to edit all fields relating to the Users section