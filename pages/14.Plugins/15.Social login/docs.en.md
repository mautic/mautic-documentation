---
title: 'Social login'
media_order: Social-Login-2.png
taxonomy:
    category:
        - docs
slug: social-login
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

---------------

## Mautic - Social Login

Social login in Mautic is used to sign forms and pre-fill them with matched content, and also to update/create a contact in mautic with the information gathered from the social profile once the user has been signed in.

### Requirements
For social login buttons to be available you need to enable your social media buttons listed and authorized.

Please follow the links provided to create your social applications before you authorize and configure your plugins.
- [Twitter][twitter]
- [Facebook][facebook]
- [LinkedIn][linkedIn]

### Authorize the plugin

An application has to be created for authorization. While creating your social app, you might be asked for a *Callback URL*. This callback URL is the one provided in the configuration window for your plugin.

Once your app is created, copy the *API Key* to the *Client Key* field in Mautic's plugin configuration and *API Secret* to *Client Secret* field. Click the *Authorize* button.
Don't forget to switch *Published* to *Yes* and save the configuration.

### Configure the plugin

If your plugin is authorized correctly, you can configure the *Features* and *Contact Field Mapping* tab in the plugin configuration. Each plugin's feature tabs have different features depending on the integrations done with Mautic. For most of them you will have a "Social login" button. Enable this feature to use the social login in forms.

Next, you need to map your contact fields. Please be aware that the social login button will not only try to pre-fill the form with matched content, but it will also update/create a contact based on the social profile fields matched in this section.

*Note:* If no fields are matched, the social login will not be able to identify or create any contacts.

### Social login in forms

The social login buttons are used in forms. To be able to use them please make sure you have followed all steps mentioned above.
Then you will need to follow these steps:
1. Create a form.
2. Choose the social login field. Buttons for all plugins enabled will appear. Buttons for plugins that have not been authorized yet will not work properly.
3. To pre-fill the form: The social login tries to match fields that have the same or similar names to the fields found on the social profile.

![](Social-Login-2.png)

###Integration Fields

**Twitter**
'profileHandle','name', 'location', 'description', 'url', 'time_zone', 'lang', 'email'

**Facebook:**
'first_name','last_name','name','gender','locale','email','link',

**Linkedin** 'firstName','lastName','maidenName','formattedName','headline','location','summary','specialties','positions','publicProfileUrl','emailAddress'


[facebook]: <https://developers.facebook.com>
[linkedIn]: <https://developer.linkedin.com>
[twitter]: <https://developer.twitter.com/en>
