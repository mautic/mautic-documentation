---
title: Twilio
media_order: ''
body_classes: ''
order_by: ''
order_manual: ''
taxonomy:
    category:
        - docs
---

-------------------
## Mautic - Twilio plugin


Before you start to send text messages from your Mautic, it needs to be connected to the service which can send them. The first and default implemented service is [Twilio][twilio]. In order to configure the text messages correctly, follow these steps:

1. Create an account at Twilio.com.
2. In Mautic, go to *Settings* (cog icon) > *Plugins*.
3. Open *Twilio* plugin and activate it.
4. Copy the *Account SID* from Twilio account and paste it to *Account SID* field in the Twilio plugin configuration.
5. Unlock and copy the *Auth Token* and paste it to *Auth Token* field in the Twilio plugin configuration.
6. Go to *Products* > *Phone Numbers* in Twilio, copy the number and paste it to the *Sending Phone Number* field in Mautic.
7. Select the *Text Message Enabled?* switch to *Yes* and save the Mautic configuration.


## Alphanumeric Sender ID

Alphanumeric Sender ID allows you to send Twilio Programmable SMS messages using a personalized sender name, in supported countries (see [International Support for Alphanumeric Sender ID][twilio-international-alphanumeric-id]).

Instead of using an E.164 formatted Twilio Phone number for the "From" value, you can use a custom string like your own business' branding.

**Note:** Additionally, messages sent out using an **Alphanumeric Sender ID can not be replied to directly**.

###  Alphanumeric Sender ID requirements

Alphanumeric Sender ID is automatically supported on all new [upgraded (paid) Twilio accounts][twilio-paid-accounts]. It is not supported for Free Trial accounts.

You can validate that Alphanumeric Sender is enabled on your account by following these steps:

1.  Login to your account at [www.twilio.com][twilio].
2.  From the left side navigation bar, click Programmable SMS.
3.  Click Settings.
4.  Verify that "Alphanumeric Sender ID" is set to Enabled.

### Send SMS Messages using an Alphanumeric Sender ID with Mautic

Just setup your alias in plugin settings:

![](alphanumeric-id.png)

Read more info about [Alphanumeric Sender ID][twilio-docs-alphanumeric-id] on Twillio site.

[twilio]: <https://www.twilio.com>
[twilio-paid-accounts]: <https://support.twilio.com/hc/en-us/articles/223183208-Upgrading-to-a-paid-Twilio-Account>
[twilio-international-alphanumeric-id]: <https://support.twilio.com/hc/en-us/articles/223133767-International-support-for-Alphanumeric-Sender-ID>
[twilio-docs-alphanumeric-id]: <https://support.twilio.com/hc/en-us/articles/223181348-Getting-started-with-Alphanumeric-Sender-ID>
