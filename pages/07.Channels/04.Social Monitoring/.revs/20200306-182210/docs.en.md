---
title: 'Social monitoring'
taxonomy:
    category:
        - docs
slug: social-monitoring
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

It's possible to add contacts to Mautic through monitoring Twitter for mentions and hashtags.

## Requirements

- The [Twitter plugin][twitter-plugin] must be configured.
- The `app/console mautic:social:monitoring` command must be triggered periodically. Add it to your [cron configuration][cron-jobs].

![](social-monitor.jpg)

## Hashtags

Go to Channels->Social Monitoring and click New.
Select Twitter Hashtags as the Monitoring Method.
Type the hashtag you wish to monitor in the Twitter Hashtag box.
Name the monitor and click save.
![](social-mautic.jpg)

## Mentions

The process is the same for Twitter mentions.
![](social-mention.jpg)

As people use the hashtag or mention that you're monitoring, you'll see them being added to your contact list.  From there you can use that information in a Campaign.

[twitter-plugin]: </plugins/twitter>
[cron-jobs]: </setup/cron-jobs>