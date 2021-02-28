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

 - Green paths ![Icon showing the positive action path (green)](green-point.png) indicate actions that are considered positive or affirmative actions. A Contact is sent down this path if the Contact **has** taken a direct action such as opening an email or submitting a form. Actions that follow the green paths are executed (or scheduled if a delay is set) at the time the Contact takes the action.
  - Red paths ![Icon showing the negative action path (red)](red-point.png) indicate actions that are considered non-action points. A Contact is sent down this path if a Contact **has not** taken the action. Use an action's delay settings to define at what point the Campaign should send the Contact to the following steps on this path.

Depending on whether the criteria for the decision is met, the Contact is sent down either the green or the red paths in the decision tree. For example, consider an instance where the decision is to open an email. There can be two outcomes. If the Contact chooses to open the email, then the green decision path connects to the next action to be taken in the Campaign workflow. If, however, the Contact does not open the email, then the red decision path connects to a different action that will be taken (e.g. a delay of 7 days then a second email sent).



![Screenshot showing Campaign decisions available in Mautic](campaign-decisions.gif)

Here are the decisions that Mautic offers in the Campaign Builder:

| Decision        | Description  | 
| :------------- | :----------: |
|**Device visit** |Set the options to track whether your Contact visits your page/s from a specific device type, brand, or operating system.
|**Downloads asset**|Set the options to track whether your Contact downloads specified asset/s.|
|**Request dynamic content**|Set options to push Campaign-based Dynamic Content if you have a webpage or Landing Page where you want to add Dynamic Content.|
|**Submits form**|Set options to track whether the Contact has submitted any Mautic Forms. You can also limit this decision to track specific Forms.|
|**Visits a page**|Specify one or multiple Pages you want the Contact to visit. Can be Mautic Landing Pages or pages on your website.|
|

<br>

### Email-Related Decisions

Some decisions in the Campaign Builder are available for use only if you select the **Send Email** Campaign action.

Here are the decisions that are Email-related:

| Decision        | Description  | 
| :------------- | :----------: |
|**Opens email**| Tracks whether the Contact opens the Email.|
|**Clicks email**|Tracks whether the Contact clicks a link within the sent Email. This infers that the email has been opened.|
|**Replies to email**|Tracks if a Contact has replied to an Email that you sent. For more information, see [Contact replies][contact-replies]. |
|
<br>
<Link here>

[contact-replies]: </channels/emails/contact-replies>