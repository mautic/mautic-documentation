---
title: 'How to update Mautic'
taxonomy:
category:
- docs
slug: how-to-update-mautic
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

---

There are two ways to update Mautic:

1. [Using the Command Line][command-line-update] - recommended
2. Through the [user interface][user-interface-update]

If your instance is in production, has a large number of contacts and/or is  on shared hosting, it's **strongly** recommended that you update at the command line.

>>>> Updating in the user interface requires a significant amount of resources, and can be error-prone if the server restricts resource allocation. This can lead to failed updates and corrupted data.

## Stability levels
By default, Mautic receives notifications both in the user interface and at the command line for stable releases only.

If you wish to help with testing early access releases in a development environment, please edit your configuration and set the stability level to Alpha, Beta, or Release Candidate. This allows you to receive notifications for early access releases. **Always** read the release notes before updating to an early access release.

>>>> Never enable early access releases for production instances

[command-line-update]: </setup/how-to-update-mautic/updating-at-command-line>
[user-interface-update]: </setup/how-to-update-mautic/updating-in-the-browser>
