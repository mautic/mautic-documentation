---
title: 'SMS Text Messages'
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

---------------------
This new channel was added in Mautic 1.4.0. It allows Mautic to send text messages from campaigns.


## Create a new Text Message

A Text Message can be created/modified only via Campaign Builder.

Before you start to send text messages from your Mautic you need to configure the text messages correctly see [Twilio Plugin][twilio-plugin], Then follow these steps:

1. Go to *Campaigns*.
2. Edit an existing campaign or create a new one.
3. Open the Campaign Builder.
4. Add a *Send Text Message* action to the canvas.
5. Click the *New Text Message* button. The form in a new browser window will appear.
6. Fill in the *Internal Name*, *Text Message* and if required, change the language. Save it.

The new Text message will be pre-selected so you can save the *Send Text Message* action as well. You can use the action in your Campaign dripflow.

[twilio-plugin]: </plugins/twilio>
[twilio]: <https://www.twilio.com>
[twilio-paid-accounts]: <https://support.twilio.com/hc/en-us/articles/223183208-Upgrading-to-a-paid-Twilio-Account>
[twilio-international-alphanumeric-id]: <https://support.twilio.com/hc/en-us/articles/223133767-International-support-for-Alphanumeric-Sender-ID>
[twilio-docs-alphanumeric-id]: <https://support.twilio.com/hc/en-us/articles/223181348-Getting-started-with-Alphanumeric-Sender-ID>
