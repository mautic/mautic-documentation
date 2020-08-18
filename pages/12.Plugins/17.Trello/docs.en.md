---
title: Trello
media_order: ''
body_classes: ''
order_by: ''
order_manual: ''
taxonomy:
    category:
        - docs
---

-------------------

## Mautic - Trello plugin

This plugin can create a Trello card based on a contact

### Requirements

- Mautic V3.0.2
- Trello

## Authorize the plugin

**Attention**:
You might want to use a separate Trello user for the authorization process. Everyone who has access to your Mautic instance will be able to see the names of all the boards and lists the user used in the authorization process has access to. Also, they can create cards in those boards and lists.

1. Open Trello plugin settings (Settings > Plugins)\
   <img src="media/trello-plugin-settings-en.png" alt="Trello Plugin Settings" width="400"/>
2. Open [https://trello.com/app-key][trello app key] in a separate window.\
   <img src="media/trello-app-key-en.png" alt="Get auth keys on Trello" width="400"/>
3. Copy the displayed key and add it to the plugin settings
4. Click "Generate a Token" on the opened [Trello developer site][trello app key].
5. Follow the Trello authorization process
6. Copy the displayed token and add it to the Trello plugin settings

Don't forget to switch *Published* to *Yes* and save the configuration.

## Configure the plugin

Go to "your plugins and open the Trello settings. Here you have to choose which of your Trello boards you can to use for Mautic. Currently the plugin is limited to only one Trello board being with Mautic.
## Create Trello Card

1. Go to "Contacts"
2. Click on the contact you want to add to your Trello list
3. Click on the small arrow to display the advanced actions.
<img src="media/trello-plugin-add-card.png" alt="Get auth keys on Trello" width="400"/>

5. Click "Create Trello Card"
6. Enter all desired information you want to have displayed on the Trello card. 
7. Choose a List you can to add this Card to and if needed, you can define a Due date.
8. Click "Save"
<img src="media/trello-plugin-add-card-info-en.png" alt="Add Trello card information" width="400"/>

**Note:**
Like stated before, currently only lists from one single board can be selected. The board can be changed via Settings > Configuration > Trello.

[trello app key]: <https://trello.com/app-key>