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

[contact monitoring]: </contacts/manage-contacts/contact-monitoring>
[variables]: </setup/variables>

### Creating Custom Fields via a command

Each new custom field for contact or a company is adding new column to the database. This operation gets slower with more data. It also locks the table so no changes can come in for tens of minutes in some cases. It will also time out the HTTP request so the UI will report the column exist but contact/company updates will actually fail because the column is missing. There is a way around when you set a background processing of field creation. 

There is now an option you can set in your `app/config/local.php` file: `'create_custom_field_in_background' => true,`. If this is set then only the field metadata will be created so you will be able to see the new custom field in the list of custom fields. But it will be unpublished until a command `bin/console mautic:custom-field:create-column` runs. This command will create the actual column in the table and publishes the field metadata.

With this the HTTP request timeout is fixed because the long running SQL query that is creating the new table column is handled in a background task.

The table lock can be solved if you run the command only 1/day when you know that most of your audiance is offline. When there is not as much traffic goint into Mautic then the lock is not that big of an issue.
