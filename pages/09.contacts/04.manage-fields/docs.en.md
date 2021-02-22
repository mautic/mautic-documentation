---
title: 'Manage custom fields'
media_order: 'access-admin-menu.png,admin-menu.png,custom-fields.jpg'
slug: manage-custom-fields
taxonomy:
    category:
        - docs
---

---
You can manage Custom Fields through the _Admin_ menu (click the cogwheel upper right hand side of Mautic).

![access admin menu](access-admin-menu.png)

![admin menu](admin-menu.png)

## Custom Fields

The _Custom Fields_ page will let you view all existing Contact fields as well as any custom contact fields you have created.

![custom fields](custom-fields.jpg)

You will notice the group column which will show you where the specific field will be shown on the _Contact profile_. In the last column, you may see several icons which signify various properties of the field:

![custom field icons](custom-field-icons.png)

1. Lock icon - These fields are unable to be removed as they are used by the core installation.
2. List icon - These fields can be used as filters of segments.
3. Asterisks icon - These fields are required when filling in the contact form
4. Globe icon - These fields are publicly updatable through the [tracking pixel][variables] URL query (see [Contact Monitoring][contact monitoring] for more details).

### Published Fields

There is a toggle switch which shows before each label title.\
This type of switch is used throughout the Mautic UI to publish and unpublish items.

![unpublish fields](unpublish-fields.gif)

### Adding A New Field

You can create additional custom fields and define the data type you want that field to hold. In addition to the data type you will also select the group for that particular field. This will define where the field displays on the Contact edit and detail view.

![new custom field](new-custom-field.jpg)

### Creating Custom Fields via a command

Each new Custom Field for Contacts or Companies adds a new column to the database. This operation gets slower with larger instances of Mautic, and it locks the table while it is running, meaning that no changes can be made until the field is created. It will also time out the HTTP request, so that the User Interface will report the column exists, but Contact/Company updates will actually fail, because the column is still missing. 

There is a way around this when you configure the processing of field creation in the background. 

Since [Mautic 3.3][mautic-3.3] there is an option you can set in your `app/config/local.php` file: `'create_custom_field_in_background' => true,`. 

If this is configured, only the field metadata will be created, so you will be able to see the new Custom Field in the list of Custom Fields. It will be unpublished until a command `bin/console mautic:custom-field:create-column` runs. This command will create the actual column in the table and publishes the field metadata.

With this configuration enabled, the HTTP request timeout is prevented because the long running SQL query that is creating the new table column is handled in a background task.

The table lock issue can be mitigated if you run the command only once per day when you know that most of your audience is offline, therefore less traffic will be going into Mautic and there is less chance of this being a problem.

[contact monitoring]: </contacts/manage-contacts/contact-monitoring>
[variables]: </setup/variables>
[mautic-3.3]: <https://github.com/mautic/mautic/releases/tag/3.3.0>
