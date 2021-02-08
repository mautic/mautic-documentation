---
title: 'Managing forms'
media_order: 'new-form.png,page-break.png,form-actions.jpg,repost.png,forms-field-matching.png,rebuild.png,injection.png'
slug: managing-forms
taxonomy:
    category:
        - docs
---

---
The new form view lets you create a form and attach any fields you want to collect from your users. After you've created the fields you can then define what actions you want to perform after the user submits the information.

## Form Overview

The form overview provides a quick overview of the submissions received over a time period to easily analyze how successful a particular form is. The bottom of the form overview outlines the fields and actions included as part of a particular form.

## Form Fields

A form can contain as many fields as needed. These fields can be laid out dynamically by the system or handled via HTML if you want more control.

>>> When using the file upload field there is a limit of 1,000 submissions using the same filename.

![new-form](new-form.png)

### Page Breaks

Page breaks is a new feature in [Mautic 2.2.0][release-2.2.0] that allows multi-paged forms. Note that the submission does not happen till the final page and the submit button is pressed.

Each page break will add a customizable continue/back button that will navigate to the next or previous page. If a page break is added after the submit button, the continue button will be replaced with the submit button itself when the form is generated.

![page-break](page-break.png)

## Form Actions

Form actions are items to be handled on the submission of the form. You can define multiple actions to be performed on each submission. As of [Mautic 2.2.0][release-2.2.0], different actions are available based on form type.

![form actions](form-actions.jpg)

### Form Re-Post Action

Results from a Mautic form can be re-posted to a 3rd party form using the new "Post results to another form" submit action.

An email can be configured to send the results if the form fails to forward.

Each form field can be have it's name customized to match that of the recipient _form/script_.

In addition to the form data, an array of `mautic_form` with details like ID, name, and the URL the form was submitted to (if available) along with `mautic_contact` with the details of the contact that submitted.

![repost](repost.png)

## Creating and Updating Contacts and Companies with Forms

To have your form create or update contacts (in order to update, there must be a matching unique identifier). Each form field can be mapped to a custom contact field through the form's Contact Field tab. Some fields result in automatic matching such as email and country.

As of [Mautic 2.10.0][release-2.10.0] you are now able to match form fields with company fields in order to create a company and link it to the contact created through the form. You will only be able to create a company if the company name field is populated. It will update the company if it can identify it through Company Name and Country, City and State.
![forms - field matching](forms-field-matching.png)

As of [Mautic 2.2.0][release-2.2.0], for fields that include select lists (select, radio, checkboxes), options can be synced with the contact field itself. No more having to manually keep them in sync! If a custom field's list is updated, simply rebuild the form's HTML.

![rebuild](rebuild.png)

### Kiosk mode

The kiosk mode is helpful when you know that some form will be submitted from one device by multiple contacts. For example like a kiosk at a conference. When the kiosk mode is turned on, each submission will create a new contact. When kiosk mode is turned off, Mautic will edit the contact which belongs to the current session.

### No index mode

In [Mautic 2.15.0][release-2.15.0], [Mautic][mautic] introduced the ability to disable search engines from indexing forms. With this option you can disable search engines from indexing `https://example.com/form/{formid}` if set to "Yes".

## Form Injection

There are three ways you can use the form. You can copy the entire output or you can have the form injected dynamically using the provided javascript. These are two options for directly including the form on a page, you can alternatively embed the form directly in a Mautic landing page if you choose.

![form injection][injection]

[injection]: <injection.png>

> **ProTip**
>
> **It is recommended NOT to paste the injection code twice, it risks creating problems on the submit form action when mandatory fields are submitted empty.**


    <script>
    (function(w,d,t,u,n,a,m){w['MauticTrackingObject']=n;
        w[n]=w[n]||function(){(w[n].q=w[n].q||[]).push(arguments)},a=d.createElement(t),
        m=d.getElementsByTagName(t)[0];a.async=1;a.src=u;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://example.com/mtc.js','mt');

    mt('send', 'pageview');
    </script>

## Form results

When on the form overview page you can click the Results button located in the top right to open a tabular view of all form submissions. These results can be easily filtered and sorted by each column heading.

## Form Preview

The form preview provides a popup overview of what the form will look like. Remember that form styling is controlled by the surrounding page or website content and thus will display differently in final layout than in the preview.

## Form Style

It is possible to choose a theme for a form. If you do so and the theme supports this feature, the form will be styled by CSS from that theme.

## Pre-populate a form field value

> **ProTip**
>
> **When testing the pre-population of forms you should always use a browser in incognito mode, because being logged in as an administrator can confuse Mautic.**

It is possible to pre-populate the value of a form field from the URL query parameters. However, this only works for form fields that are linked to contact fields, all of which can be found on the Settings -> Custom fields page. (In spite of the name, this page lists all fields, including core ones.)

Before starting it is **critical** that any fields to be pre-populate are set to be "publicly updatable" by editing them via [custom fields][custom-fields]. With this setting enabled, Mautic fields can be altered programatically.

You will also need to know the aliases of the contact fields you wish to pre-populate, because you will use these aliases in the URL to feed in your data. The alias can be obtained from the table when viewing the same Settings -> Custom fields page mentioned above.

Create the form fields in the usual way, and link it to the appropriate contact field. In the Behaviour tab, enable the "Auto fill data" setting.

Once these three important steps have been followed for each form field you wish to pre-populate, you will be able to move on to building your URL.

> **Checklist**
>
> **1. My contact field has "Publicly updatable" enabled under Custom fields**
> 
> **2. My form field is linked to the correct contact field under Contact Field on the field settings**
> 
> **3. My form field has "Auto fill data" enabled under Behavior on the field settings**

### Building your URL

By way of an example, we will pretend we want to prepopulate a field linked to Contact: First name in a landing page on an example Mautic instance. To illustrate this we can imagine we have added our form to a landing page at `my-landing-page`, using either the JavaScript method or the `{form=N}` variable method (where N is the form ID). The address is:

`http(s)://example.com/my-landing-page`

The contact field's alias is `firstname`, so if I want to prepopulate the content of the field linked to the contact first name field, my URL would look like this:

`http(s)://example.com/my-landing-page?firstname=Mauty`

If I added another field and linked it to Contact: Phone, which has the alias `phone`, to pre-populate this phone number field I would make this URL:

`http(s)://example.com/my-landing-page?firstname=Mauty&phone=020%20000%20000`

Etc.

You may want to take some time to learn more about [percent encoding](https://en.wikipedia.org/wiki/Percent-encoding) and [query strings](https://en.wikipedia.org/wiki/Query_string) if you are not familiar.

> **ProTip**
>
> **If you pass Mautic the key identifying data for a contact - their email address - via the URL, it will automatically prefill all information in auto-fillable fields it already knows about, even if that information was not provided in the URL.**

### Pre-populate the values automatically in an email
 
>>> This section describes building a link within an email to pass contact data to a page with an embedded form. It is important to note forms **within** emails are never recommended. While it is possible to do this with Mautic, in reality form support in mail clients is still poor, so there's a real risk many of your contacts will have a bad experience.

You should always use the `{pagelink=N}` variable, where N is the ID of the landing page e.g. `{pagelink=1}`, to create the link to a landing page in a Mautic email. In most cases this is all you need. In the rendered email sent to a contact, the URL may be converted into something like: `http(s)://example.com/my-landing-page?ct=A_REALLY_LONG_STRING`

So, what happened is `{pagelink=1}` was converted into the landing page URL and had `?ct=A_REALLY_LONG_STRING` appended. The really long string is encoded information about the contact which includes the contact ID. When the contact hits the landing page, this really long string allows Mautic to know who the contact is and automatically populate their details into every properly configured auto-fillable field in the embedded form. You do not need to pass any data in the URL.

However, if you wished to augment the data known about a contact with something prefilled, you can. For example, you might have made a new custom contact field to register which product a contact is interested in, Product A or Product B. This is a new field so Mautic won't have any data for it, you want to gather it via an email. You might send an email to solicit product interest with two links, one to select Product A and one to select Product B, and those two links would look like this, if your contact field has the alias of `product`:

`{pagelink=1}?product=A`

`{pagelink=1}?product=B`

Which will be converted automatically when the email is sent into:

`http(s)://example.com/my-landing-page?ct=A_REALLY_LONG_STRING?product=A`

`http(s)://example.com/my-landing-page?ct=A_REALLY_LONG_STRING?product=B`

Your form has a hidden field connected to the Contact: Email field and a visible radio button field with A and B as product choices. You will find the email address is passed to the hidden email field and the product selector is pre-populated with the selection according to the link the contact clicked. When they click submit, Mautic will have captured the entire trail through email sent, read, link opened and form submitted, it will all appear on the contact record and their product choice will be recorded in your new custom contact field with the alias of `product`.

Note, your form field alias has nothing to do with the URL, as long as the form field exists, is linked to the `product` contact field and set to auto-fill as described above, and has the appropriate values, A and B, the parameter name in your querystring will be the contact alias and Mautic will connect the parameter to the matching form field.

### Remove Contact from Do Not Contact (undo unsubscribe)

[Mautic 2.3][release-2.3.0] added new action **Remove Contact from Do Not Contact**. If a contact unsubscribes from your email marketing, you can't send another emails.  Use action **Remove Contact from Do Not Contact** in your forms and the contact will receive email again.

[release-2.2.0]: <../../../../index.php.com/mautic/mautic/releases/tag/2.2.0>
[release-2.3.0]: <../../../../index.php.com/mautic/mautic/releases/tag/2.3.0>
[release-2.10.0]: <../../../../index.php.com/mautic/mautic/releases/tag/2.10.0>
[release-2.15.0]: <../../../../index.php.com/mautic/mautic/releases/tag/2.15.0>
