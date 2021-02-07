---
title: 'Record UTM tags in a Form'
media_order: 'utm-timeline.png,Record-utm-tags.png,Contact-field.png'
published: false
taxonomy:
    category:
        - docs
slug: utm-tags-form
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

## Form Action

UTM ("Urchin Tracking Monitor") tags are usually used for tracking with Google Analytics. For this purpose, links are extended by UTM parameters. If a contact clicks on a link with such a UTM parameter, this click is recorded in Google Analytics. 

But you can also utilize these parameters using Mautic! The form action "Record UTM tags" records these UTM tags and saves them, enabling you to use them in your Mautic instance.

![](Record-utm-tags.png)

**The following UTM tags can be recorded using the form action:**
* UTM tags that are being recorded:
* utm_campaign
* utm_content
* utm_medium
* utm_source
* utm_term

## Contact Timeline

Once a contact has submitted a form, which contains the "Record UTM tags" form action, you will be able to see the UTM tags in the timeline of the Contact. Every recorded parameter will be displayed here.

![](utm-timeline.png)

**Note:**
You can also utilize the recorded UTM tags to use them in a campaign as a Condition. Use the Condition "Contact field value" and choose the UTM tag that you want to check on.

![](Contact-field.png)