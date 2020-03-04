---
title: 'Contact replies'
slug: contact-replies
taxonomy:
    category:
        - docs
---

---------------------
## Setup

Contact Replies were added in Mautic 2.12.0. To use it you must have access to an IMAP server other than Google or Yahoo (as they will overwrite return paths).

1. To use the Monitored email feature you must have the PHP IMAP extension enabled (most shared hosts will already have this turned on).

2. Configure all Mautic sender/reply-to email addresses to send a copy to one single inbox (the most of the email providers support this feature in their configuration panel).  
 
 > Note that it is best to create an email address specifically for this purpose, as Mautic will read each message it finds in the given folder.

3. Go to the Mautic configuration and set up the inbox to monitor replies.

![Contact Replies IMAP folder](contact-replies-imap-folder.png "Contact Replies IMAP folder")

4. To fetch and process the read messages reply, run the following command:

`php /path/to/mautic/app/console mautic:email:fetch`

## Usage

Contact replies can be used within campaigns as decision after an email has been sent, to take action based on whether the user has replied to the email. Mautic tries to read inbox, parse messages, and find replies from the specified contact. The contact, when a match is found, will proceed down the positive path immediately after the reply is detected. 

![Contact Replies campaign decision](contact-replies-campaign-decision.png)

