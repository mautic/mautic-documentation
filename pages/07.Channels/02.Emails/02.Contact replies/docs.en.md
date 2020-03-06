---
title: 'Contact replies'
taxonomy:
    category:
        - docs
slug: contact-replies
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
## Setup

Contact Replies were added in [Mautic 2.12.0][mautic-212]. To use it you must have access to an IMAP server **other than Google or Yahoo** (as they will overwrite return paths, which prevents this feature from working).

1. To use the Monitored email feature you must have the PHP IMAP extension enabled (most shared hosts will already have this turned on).

2. Configure all Mautic sender/reply-to email addresses to send a copy to one single inbox (most email providers support this feature in their configuration panel).  
 
 > Note that it is best to create an email address specifically for this purpose, as Mautic will read each message it finds in the given folder.

3. Go to the Mautic configuration and set up the inbox to monitor replies.

![Contact Replies IMAP folder](contact-replies-imap-folder.png "Contact Replies IMAP folder")

4. To fetch and process the read messages reply, run the following command:

`php /path/to/mautic/app/console mautic:email:fetch`

## Usage

Contact replies can be used within campaigns as decision after an email has been sent, to take action based on whether the user has replied to the email. Mautic tries to read inbox, parse messages, and find replies from the specified contact. The contact, when a match is found, will proceed down the positive path immediately after the reply is detected. 

![Contact Replies campaign decision](contact-replies-campaign-decision.png)

[mautic-212]: <https://github.com/mautic/mautic/releases/tag/2.12.0>
