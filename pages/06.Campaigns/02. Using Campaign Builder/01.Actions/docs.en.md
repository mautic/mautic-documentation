---
title: 'Actions'
media_order: 'send-email-delay-nonaction.png'
published: true
taxonomy:
    category:
        - docs
slug: actions
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
Campaign actions are events that you initiate on your contacts or contact records. These can represent sending communications to the contact or may automate operational tasks to keep your marketing running. A single Campaign can include more than one action. When you create a Campaign, you select one of these actions to begin the workflow.

The actions that Mautic offers in a Campaign include:

| Action        | Description  | 
| :------------- | :----------: | 
| **Add Do Not Contact**|Adds the user to the Do Not Contact (DNC) list |
| **Add to Company's score** |Adds or subtracts a designated number of Points to or from the score for all Companies associated with the Contact. |
|**Add Company action**| Associates a Contact with a Company and sets the Company as the primary Company for the Contact.|
|**Adjust contact points**| Adds or subtracts Points from the Contact’s Point total.|
|**Change campaigns**| Removes a Contact from the existing Campaign, moves them into another Campaign, restarts the current Campaign or a combination of these. You must remove a Contact from a Campaign before restarting the Campaign.|
|**Change contact’s stage**| Moves a Contact to the specified Stage.|
|**Delete contact**| Permanently deletes the Contact record along with all the information about that Contact, including the Campaign event log record about that Contact. See the [Segment docs][segments] about how to use this action to delete all Contacts in a Segment.|
|**Jump to Event**| Moves Contacts from one point in a Campaign to another without rebuilding events. Use this action to send the Contact to a different path in the Campaign.|
|**Modify contact’s segments**| Adds or removes Contacts to/from Segments. If a Contact is removed from a dynamic (filter-based) Segment by a Campaign action, they won’t be re-added to the Segment based on meeting the filter criteria.|
|**Modify contact’s tags**| Overwrites or appends Tags on a Contact record. You can add or remove Tags, or do both, in the same action.|
|**Push contact to integration**| Sends the Contact record to the r> selected integration, either creating a new Contact in the chosen integration or updating the connected Contact record.|
|**Remove Do Not Contact**| Removes the user from the Do Not Contact (DNC) list.|
|**Send a webhook**| Sends a Webhook to a defined URL, using the GET, POST, PUT, PATCH, or DELETE methods. Headers and data are customizable, and support the use of tokens, such as contact fields and the contact's IP address. For example, {contactfield=firstname}|
|**Send email**| Sends a transaction or marketing Email to the selected contact. A transactional Email can be sent to the contact multiple times. A marketing Email can be sent to the contact only once across multiple sources. If the contact has already received this Email from another source or the current Campaign, the Email will not be sent again and the contact progresses through the Campaign.|
|**Send email to user**| Sends an Email to an entity other than the contact. This may be a Mautic user, the Contact’s owner, or non-users. Emails sent using this action do not generate any statistics for Contacts or Emails.|
|**Send marketing message**| Sends a message using the Contact's preferred Channel.|
|**Update contact**| Updates the existing Contact's fields with the specified values.|
|**Update contact's primary company**| Updates the existing Contact's primary Company fields with the specified value. See [documentation on Companies][companies].|
|**Update contact owner**| Updates the Contact's owner.|
|

**Notes**:
1.  As the first step of your Campaign, you typically send out an Email to your Segments. When you add an Email to a Campaign, you can select a potential **delay** for when the Email is delivered as shown in the following image.

 If the action is attached to a decision's **non-action** initiated decision path, the delay becomes how long the Contact has to take action before the Campaign progresses down the non-action path. 
![Image showing delayed actions on a non-action decision path in a campaign](send-email-delay-nonaction.png)

2. The Delete Contact action also deletes the Campaign event log record about that contact. Therefore, though this action might always display 0% progress on the Campaign detail page, it could have deleted some Contacts.

   The Delete Contact action doesn't allow other Campaign events to be connected to it. Since the Contact will not exist after this action is triggered, Campaign events cannot be triggered after this point.

After adding an action, you can place a decision on the Campaign.


[segments]: </contacts/manage-segments>
[companies]: <contacts/companies>
