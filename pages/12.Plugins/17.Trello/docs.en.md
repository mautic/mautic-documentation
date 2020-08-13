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

This plugin can:

- Create a Trello card based on a contact and link back to this contact

### Requirements

- Mautic V3.02

### Authorize the plugin

1. Open [https://trello.com/app-key](https://trello.com/app-key).
2. Open Trello settings from your Mautic plugin screen in a separate window.
3. Copy the displayed key and add it to the plugin settings
4. Click "Generate a Token" on [https://trello.com/app-key](https://trello.com/app-key)
5. Follow the authorization process at Trello
6. Copy the displayed Token and add it to the Trello plugin settings

Don't forget to switch *Published* to *Yes* and save the configuration.

#### Attention
You might want to use a separate Trello user for the authorization process. Everyone who has access to your Mautic will be able to see the names of all the boards and lists this user has access to (no the cards) and create cards in them.

### Configure the plugin

Go to your settings and set your favourite board. Currently you can only use the plugin with one favourite board.