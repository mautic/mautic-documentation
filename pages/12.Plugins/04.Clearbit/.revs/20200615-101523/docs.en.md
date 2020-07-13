---
title: Clearbit
media_order: ''
body_classes: ''
order_by: ''
order_manual: ''
taxonomy:
    category:
        - docs
---

-------------------

## Mautic - Clearbit plugin

This plugin can:

- Pull data from Clearbit via the API about contacts and companies into Mautic.

### Requirements

- Mautic installed on a publicly accessible URL. This plugin won't work on a localhost because callbacks from Clearbit to Mautic are necessary.
- Get a [Clearbit API key][clearbit-api-key]

### Authorize the plugin
![image](connectwiseauth.png)

### Usage
On the contacts and on the companies pages, there are two buttons: One on the row dropdown menu, and another one on the toolbar at the top:
![image](https://cloud.githubusercontent.com/assets/2924026/20488164/b0337e3a-afcb-11e6-8994-c213c9852632.png)

When clicking one of those buttons a window will pop up to confirm the action:
![image](https://cloud.githubusercontent.com/assets/2924026/20521597/8f7e8ec2-b071-11e6-99c2-590cb90c227f.png)

A few moments later, if information was found, the contact/company details will be updated.

[clearbit-api-key]: <https://dashboard.clearbit.com/signup>
