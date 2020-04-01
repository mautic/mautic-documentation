---
title: 'Progressive profiling'
slug: progressive-profiling
taxonomy:
    category:
        - docs
---

---
This feature was added in Mautic 2.1.0.

Progressive profiling makes your forms smarter by asking for the most important information that you don't have yet. This way your contacts won't feel overwhelmed by long forms and saves time by answering questions Mautic already knows the answer to. Progressive Profiling lets you improve the form conversion rate.

## Configuration

There are two possible ways that you can configure a form field to display only when needed. The configuration is in the __Behavior__ tab in the field configuration form. The Behavior (Progressive Profiling) can be configured for all field types except the _button_ field. We recommend use  email field visible because it is the identifier of a contact. The button field must be always visible because otherwise the form couldn't be submitted.

It's recommended to use the email field in each form. From Mautic 2.9 email can be hidden, but be aware of that. Email as identifier of a contact could be unusable if same PC is used by more people (public library, schools...).

1. Display field only if the value is not known yet

	Mautic will search for a value in two places before the form is rendered for the current contact:

* Former form submissions
  
  Mautic will search for the field value in the previous form submissions of the current contact. If a value is found, the field might be hidden if configured so. There are limitations of the search history (see below).   

* Contact profile values
  
   If the form field is linked with a contact field, Mautic will check if there is a value in the contact's profile and hides the field if configured to do so.

2. Display field only after X submissions.

If you want to ask a contact additional questions on the second form load, you can specify so for each lead. It works nicely with hiding fields which you already know the answer to. For the first submission, the contact can be asked to fill in the First and the Last name. When they come to the form for a second time, the First and the Last name fields will be hidden and instead they will be asked to fill in their Company and Phone.

## Limits of Progressive Profiling

### The search history limit

The Mautic forms without progressive profiling are as fast as they can be. The HTML of the form is rendered once, stored and this "cached" HTML is used for the next form load. When a progressive profiling configuration is turned on for any of the form fields, the form HTML might be different for each contact. It can even change for each contact after each submission. The impact of this is that form caching cannot be used, and the form load time will be slower for a progressive profiling form.

There is limit of 200 submissions from which Mautic searches for existing form values. This limit was added to prevent possible slow form loads - or even hitting the server time or memory limits - when a contact has several thousand form submissions. This limit might cause Mautic to display/hide the wrong fields.

### The embed type limit

Progressive Profiling forms **will not work if you embed your form as static HTML**. It will work at form preview, form public page, form embedded via JS, form embedded via iframe.

### The kiosk mode limit

Progressive Profiling features are turned off if you switch the form to the Kiosk Mode. The form always creates a new contact on each submission in the Kiosk Mode. It doesn't track the device from which the form was submitted.

The Progressive Profiling options under the Behavior tab will still be accessible in the Form Builder so you could easily switch the Kiosk mode off and use the Progressive Profiling features again.
