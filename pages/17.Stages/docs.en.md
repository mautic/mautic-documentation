---
title: Stages
media_order: ''
body_classes: ''
order_by: ''
order_manual: ''
taxonomy:
    category:
        - docs
---

-----------
## Stages Overview

Stages is a way to define the lifecycle of a contact. Create stages based on your marketing stages, and move your contacts from stage to stage.

### Creating/Managing a Stage

To create a new stage, go to the stages menu identified by a tachometer. Click on the new button and fill in with you relevant data.

Notice Mautic uses 'weight' for stages, this is a way to balance your contact's stages.  When moving contacts from stage to stage, this will make sure a contact doesn't go back to previous stages.

### Moving Contact's from stage to stage

Use a campaign to move your contacts from stage to stage. When creating your campaign choose a _Move Contact to Stage_ action. So if a contact has been sent an email, or has opened an email, you can select to change the contact's stage based on any campaign criteria.

>>> It is not possible to move a contact to a stage which has a lesser weight than their current stage. For example if they are currently in Stage B which has a weight of 50, you cannot move them to Stage A which has a weight of 25.

###Contact's Lifecycle

Create a lifecycle widget in your dashboard based on segments to also view what stages contacts are in.
