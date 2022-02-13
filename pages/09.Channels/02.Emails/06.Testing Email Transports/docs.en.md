---
title: 'Testing Email Transports'
slug: testing-email-transports
taxonomy:
    category:
        - docs
---

---

## Document Purpose  
  
This document is intended for software developers who write Email Traspornts based on `Symfony Mailer`which will be introduced to Mautic start version 5.  
  
This document will describe Manual steps for testing and the items that you need to check before submitting your PR for approval in case you want to add a new transport.  
  
## Email Components

Each email sent out by Mautic includes the following components:  
  
1. Email Address (FROM, TO, CC, BCC, REPLY-TO): `Unicode` email address in this format `email@domain.com` or `email+test@domain.com`. Make sure that you always use the Unicode email address to accommodate special characters in languages like Arabic, Hebrew, or Chinese.  
2. Email Name (FROM, TO, CC, BCC, REPLAY-TO): `Unicode` Human-readable name, Make sure that you always use Unicode email address to accommodate special characters in languages like Arabic, Hebrew, or Chinese.  
3. Subject: `Unicode` string that might include `emojis`  
4. Text: `Unicode` string that might include `emojis`  
5. HTML: `Unicode` string that might include `emojis`, it will be in HTML format.  
6. Headers: `ANSI` string pairs, `Symfony/Mailer` will add most of the headers, but for some transports, you will need to add your own headers, so you can use the methods mentioned here <https://symfony.com/doc/current/mailer.html#message-headers> which is referenced in this file <https://github.com/symfony/symfony/blob/6.1/src/Symfony/Component/Mime/Header/Headers.php>  
7. Priority: sets the email priority based on enum  
8. Attachments: a file with a variety of mime types, the file size should not exceed a specific size provided by the transport provider, usually nothing more than 10MB and go up to 40MB (for the whole message, including the text, HTML, and anything embedded within the HTML)  
  
## Preparing Mautic for testing

1. Create 10 contacts with any email address you need  
2. Create a segment that includes the 10 contacts  
  
## Testing Email Transport

In order to test the email transport you need to go through the following steps:  
  
1. Testing the connection, by going to Mautic Configuration -> Email Settings -> Click on Test Connection. If the connection works you should see *success* otherwise you should see an *error*  
![Testing Connection](contact-replies-imap-folder.png "Testing Connection")  
  
2. Sending Sample Email: from the same screen where you test the connection, you should be able to send a sample email. The sample email will be sent to the email of the user you are logged in with. It will have a test message.  
  
3. Upload an asset: go to Components -> Assets and then upload a pdf file and make sure the file name is written in one of the Unicode languages (Arabic, Russian, German, etc)  
![Sample PDF](ملف.pdf "Sample PDF")  
  
4. Create a email template: Go to Channels -> Emails -> New -> Template Email -> Select Blank Theme  
Use the builder to do the following:

- Embed an image  
- Add Unicode text, you can use this "نحن نحب ان نقوم ببناء Mautic"  
- Close the builder,  
- Go to the Advanced tab  
- Fill From Name & From Address, Bcc, Reply-To, Add Attachment, custom headers, and Click on Auto Generate to create a text part of the email  
- Save the email and send a sample test, you should get everything you filled  
  
5. Create a email template: Go to Channels -> Emails -> New -> Template Email -> Select Blank Theme  

Use the builder to do the following:  

- Embed an image  
- Add Unicode text, you can use this "نحن نحب ان نقوم ببناء Mautic"  
- Close the builder,  
- Go to the Advanced tab  
- Fill From Name & From Address, Bcc, Reply-To, Add Attachment, custom headers, and Click on Auto Generate to create a text part of the email  
- Save the email and send a sample test, you should get everything you filled  
  
6. Create a email template: Go to Channels -> Emails -> New -> Segment Email -> Select Blank Theme  
Use the builder to do the following:  

- Embed an image  
- Add Unicode text, you can use this "نحن نحب ان نقوم ببناء Mautic"  
- Close the builder,  
- Go to the Advanced tab  
- Fill From Name & From Address, Bcc, Reply-To, Add Attachment, custom headers, and Click on Auto Generate to create a text part of the email  
- Save the email and send a sample test, you should get everything you filled  
  
7. Send an individual email: Go to the contacts page and select the contacts then click on send an email, you should be able to send an email directly to that specific email.  
  
8. Send a report email: create a report with any data and set it on a schedule, it should send an email with the report as an attachment  
  
9. There are other places like Forget Password: they need to work as well.  
  
## Testing Transport Callback  
  
Each transport should include a callback URL that webhooks should be `POSTed` to mark contacts who bounce as `DNC` in order to test these callbacks you need to do the following:  
  
1. Configure an email transport and make it the default transport  
2. Go to the URL on the following format `/mailer/{transport}/callback`  
3. You should get a message that says `success` and there should be a callback logic to handle the webhook
