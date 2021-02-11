---
title: 'Decisions'
media_order: ''
published: true
taxonomy:
    category:
        - docs
slug: decisions
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
## Decisions

Campaign decisions are actions that your Contacts initiate. Downloading an asset, opening an email, or visiting a landing page are examples of decisions. These decisions can be either directly initiated or implied based on non-action. The options for decisions change based on the Campaign actions that you select.

A decision usually has two paths that are denoted by the red and green points on the decision tree. 

 - Green Points ![](green-point.png) indicate actions that are considered contact-initiated points. A contact is sent down this path if the contact has taken a direct action such as opening an email or submitting a form. Actions that follow the green points are executed (or scheduled if a delay is set) at the time the contact takes the action.
  - Red points ![](red-point.png) indicate actions that are considered non-action points. A contact is sent down this path if a contact has NOT taken some direct action. Use an action's delay settings to define at what point the campaign should send the contact down this path.

Depending on whether the criteria for the decision is met, the contact is sent down either the green or the red points in the decision tree. For example, consider an instance where the decision is to open an email. There can be two outcomes. If the contact chooses to open the email, then the green decision point connects to the next action to be taken in the campaign workflow. If, however, the contact does not open the email, then the red decision point connects to a different action to be taken (e.g. a delay of 30 days then a second email sent).



![](campaign-decisions.gif)

Here are the decisions that Mautic offers in the Campaign builder:

| Decision        | Description  | 
| :------------- | :----------: |
|**Device visit** |Set the options to track whether <br> your contact visits your page from a <br> specific device type, brand, or operating system.
|**Downloads asset**|Set the options to track whether <br> your contact downloads specified assets.|
|**Request dynamic content**|Set options to push campaign-based <br> dynamic content if you have a <br> webpage or landing page where you <br> want to add dynamic content.|
|**Submits form**|Set options to track whether the <br> contact has submitted any Mautic <br> forms. You can also limit this decision <br> to track specific forms.|
|**Visits a page**|Specify single or multiple pages you want the contact to visit.|
|

<br>

### Email-Related Decisions

Some decisions in the campaign builder are available for use only if you select the **Send Email** campaign action.

Here are the decisions that are email-related:

| Decision        | Description  | 
| :------------- | :----------: |
|**Opens email**| Tracks whether the contact <br> opens the email.|
|**Clicks email**|Tracks whether the contact <br> clicks a link within the send email.|
|**Replies to email**|Tracks if a contact has replied to an<br> email that you sent.|
|
<br>


> **Note**:
A contact must already be part of the campaign in order for it to recognize the decision that is executed. Therefore, campaigns should never start with a decision unless you are manually managing the contacts assigned to it and the decision is expected to be executed at a later time.

