---
title: 'Campaign events'
media_order: 'send-email-delay (1).png,send-json-webhooks.png,submits-form.png,visits-a-page.png,jump-to-event.png'
taxonomy:
    category:
        - docs
slug: campaign-events
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

Below are notes on some of the specific campaign events.

## **Campaign Actions**

### Send Email - Marketing vs Transactional

![](send-email-delay%20(1).png)

In the send email action, there is an option to select Transaction or Marketing. A transactional email is one that can be sent to the contact multiple times. A marketing email is one that can only be sent to the contact once across multiple sources (e.g. another campaign). If the contact has already received this email from another source or the current campaign, the email will not be sent again and the contact simply progresses on through the campaign.


### Send email to user

This action will allow you to send email to:

- any Mautic user
- contact's owner
- any email addresses (TO, CC, BCC).

Emails sent through this action will not generate any statistics for contacts nor emails.

The email tokens will get populated with the real values including contact field values. But the email hash is bogus so the links like unsubscribe won't work correctly. It's similar behaviour like when a user sends itself a test email.

### Send a Webhook

Action Send a Webhook with GET, POST, PUT, PATCH, DELETE, TRACE request support (curl). It was created based on [GitHub discussion][webhook-discussion-github]. Return true if page status code is 200/201. Data and headers values support contact field tokens (`{contactfield=firstname}` etc.).

Mautic 2.15.0 [adds][215-ip-as-token] possibility to use contact's IP address as a token `{contactfield=ipAddress}`.

Mautic 3.1.0 [adds][8959-send-content-as-json] the possibility to send webhook payloads in JSON format.  To send a JSON payload, add a header entry with the label `content-type` and value `application/json`:
![](send-json-webhooks.png)

### Delete contact

This action will **permanently delete the contact** who will trigger this action in your campaign flow, together with all the information Mautic knows about that contact. See in the [segment docs][segments] about how to use this action to delete all contacts in a segment.

##### The Delete contact action is special for 2 reasons:

1.  It will also delete the campaign event log record about that contact so this action will always show 0% progress in the campaign detail page. Even though it could have deleted some contacts. There is no record about it.

2. This action doesn't allow to connect other campaign events to it. There is no point in doing so since the contact won't exist after this action is triggered.

### Focus items

See the documentation on [Focus items][focus-items] for an in-depth walk through

### Update contact's primary company

A campaign action was added in Mautic 2.14 which allows you to edit a contact's primary company via a campaign. Read also about [Mautic's companies support][companies].

Action update contact's primary company based on company custom fields. 

If you try update company name, then action will add new or existed company with same name to contact and mark it as primary.


### Update contact information
You can use the update contact information action to change the values stored in the contact fields.
Note that for Date Fields, you can use relative dates (eg: +4 days or -2 days).

### Jump to Event

A pretty nifty feature which lets you jump to any campaign step in the campaign. You don't have to build reoccuring campaign workflows, just define them once and use the "Jump to Event" action!

![](jump-to-event.png)

## **Campaign Decisions**
Decisions are things the user does which we can track, like his page visit or wheter he opens an email or not. 

### Visits a page

Specify single or multiple pages you want the Contact to visit. Once a page that you specified is visited, the contact will advance to the next campaign step. 

Note: The decision uses the OR operator between fields (Limit to Pages, URL, Referrer).

![](visits-a-page.png)

## Campaign Conditions

### Contact field value
You can use the contact field value condition to create branches with different behavior in your campaigns.
Note that for Date Fields, you can use relative dates (eg: +4 days or -2 days).

### Device Visit

Specify and seperate visits from different devices. You can define the Device Type (desktop, smartphone etc.), Device Brand (Acer, Apple, Samsung etc.) and the Devise OS (IOS, Android etc.) 

### Downloads Asset 

Choose the Asset you want the Contact to download before advancing in the campaign. Once the chosen Asset has been downloaded, the contact will continue in the campaign. 

Note: You can choose multiple Assets to download, once **one of them** was downloaded the step is fullfilled.

### Request Dynamic Content 

Step needed to use campaign based Dynamic Content. Click here to read more about [campaign based Dynamic Content](campaign-based-dwc)

### Submits Form

Define one or more forms, which the Contact needs to fill out.

![](submits-form.png)

Note: You can choose multiple Forms, once **one of them** was submitted the step is fullfilled.

#### Email related Decisions
These decision camppaign steps can only be used if the previous campaign action is "Send Email".

### Opens Email

The contact opens up the email. 

### Clicks Mail

The contact clicks on a link within the send email.

### Replies to Email

If correctly setup in the [Email settings][email-settings], you can track if a contact replied to the mail you send to him.

[webhook-discussion-github]: <https://www.github.com/mautic/mautic/issues/854>
[215-ip-as-token]: <https://www.github.com/mautic/mautic/pull/6539>
[segments]: </contacts/manage-segments>
[focus-items]: </channels/focus-items>
[companies]: <contacts/companies>
[8959-send-content-as-json]: <https://github.com/mautic/mautic/pull/8959>
[email-settings]: <https://docs.mautic.org/en/channels/emails>
[campaign-based-dwc]: <https://docs.mautic.org/en/components/dynamic-web-content>
