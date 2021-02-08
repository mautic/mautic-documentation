---
title: 'Troubleshooting emails'
taxonomy:
    category:
        - docs
slug: troubleshooting-emails
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

---
## Open email tracking doesn't get tracked

Emails are being tracked by a tracking pixel. This is simply a 1 pixel GIF image in the source code of email messages sent by Mautic. 

When an email is opened by an email client like Outlook, Thunderbird or GMail, the client tries to load the images in it. The image load request is what Mautic uses to track the email open action.

Some email clients have auto loading images disabled, and users have to click on a "Load Images" button to load images inside an email message. 

If the images aren't loaded for this reason or another, **Mautic doesn't know about the open action**. Therefore, email open tracking is not 100% accurate.

## Email link clicks are not getting tracked

Before an email is sent, Mautic replaces all links in the email with links back to Mautic including a unique key. If the contact clicks on such a link, the contact is redirected to Mautic. 

Mautic tracks the click action and redirects the contact to the original location. It's fast so the contact doesn't usually notice the additional redirect.

If the email click doesn't get tracked, make sure that:

1. Your Mautic server is on a public URL. **Tracking doesn't work on a localhost**.
1. Make sure the email was sent to an existing contact **via a campaign or a segment email**. Emails sent by the *Send Example* link, *direct email* (from the contact detail) or *form submission preview* won't replace links with trackables.
1. Make sure the URL in the `href` attribute is **absolute and valid**. It should start with http:// or https://.
1. You've opened the link in a incognito browser. More about it in the **[Campaign troubleshooting][campaign-troubleshooting].**
1. Check if the link in the email has been replaced by Mautic's tracking link. If not, report it on [Github][mautic-github] with all the details (Mautic version, PHP version, what the link URL is before sending, what it is after sending and so on).

## Unsubscribe link doesn't work

The unsubscribe link **doesn't work in test emails**. 

This is because the test emails are sent to a Mautic **user** and not to a Mautic **contact**. 

Mautic users cannot be unsubscribed and therefore the unsubscribe link looks like this: `https://mautic.example.com/|URL|`. However, the link will work correctly when you send the email to a contact.  

Best practice is to create a segment with a small number of users to receive test emails (for example, yourself) - this will ensure that you can fully test features such as unsubscribe behaviour.

[campaign-troubleshooting]: </campaigns/troubleshooting-campaigns>
[mautic-github]: <https://github.com/mautic/mautic/issues>