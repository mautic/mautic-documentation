---
title: 'Progressive profiling'
slug: progressive-profiling
taxonomy:
    category:
        - docs
---

---
This feature was added in Mautic 2.1.0.

Progressive profiling is a powerful feature used to reduce the length of forms by hiding all the fields which are already known. This will prevent your contacts from feeling overwhelmed by massive forms and will even reduce the time it takes to fill out a form if fields are already known to your Mautic instance and thus are hidden for the contact.

## Configuration

There are two ways to configure a form field to only display when the asked values are unknown. 

It is recommended to use the Email field in each Form. From [Mautic 2.9][mautic-2.9] the email field can be hidden, but use this with caution. Email as identifier of a Contact could be unusable if same PC is used by more people (public library, schools...).

1. Maximum fields displayed at a time

A global feature to enable progressive profiling and allow the rendering of a specified amount of fields each time.

![screenshot of maximum fields to show at a time setting](https://user-images.githubusercontent.com/462477/80913098-3f71c500-8d42-11ea-919c-13763228bc1c.png)

2. Always display

Always force the display of the field, even if you set a maximum number of fields (x) and this field is not in the first x fields - this is helpful for fields like Email which must always be displayed.**. 

![Screenshot showing the always display setting](https://user-images.githubusercontent.com/462477/80913150-b6a75900-8d42-11ea-944d-7552882b215f.png)

3. Display field only if the value is not yet known

	Mautic will search for a value in two places before the Form is rendered for the current Contact:

#### 1. Show when value exists

If this option is set to "No", Mautic checks if the value for this field exists in the database or if the value was provided in a former form submission already. If a value is found, the field won't be displayed in the form. If this option is set to "Yes", Mautic will show the field, regardless whether a value is found or not. The default configuration for this option is "Yes".

#### 2. Display field only after X submissions.

If you have a form that you would like to use multiple times, with more fields occuring the more times a contact fills it out, while still only using a single form, the option "Display field only after X submissions" is what you are looking for. As the name already states, the field will only appear once the form hast been submitted X times. This goes hand in hand very well with the ability to hide fields if the value is already known. 

For example: A form asks for the email, first and last name of a contact on the first time it is filled out and when the contacts fills out the form a second time, the first and the last name fields will be hidden and instead contact will be asked to fill in their company and phone.

## Limits of Progressive Profiling

### The search history limit

Mautic forms which do not use progressive profiling are as fast as they can be. The HTML of the form is rendered once, stored and this "cached" HTML is used for the next form load. When a progressive profiling configuration is turned on for any of the form fields, the form HTML might be different for each contact. It can even change for each contact after each submission. The impact of this is that **form-caching cannot be used**, and the form load time will be slower for a progressive profiling forms.

There also is a limit of 200 submissions from which Mautic searches for existing form values. This limit was added to prevent possible long form loading times - or even hitting the server time or memory limits - when a contact has several thousand form submissions. This limit might cause Mautic to display/hide the wrong fields if the contact exceeds this limit.

### The embed type limit

Progressive Profiling forms **will not work if you embed your form as static HTML**. It will work at form preview, form public page, form embedded via JS, form embedded via iframe.

### The kiosk mode limit

Progressive Profiling features are turned off if you switch the form to the Kiosk Mode. The form always creates a new contact on each submission in the Kiosk Mode. It doesn't track the device from which the form was submitted.
