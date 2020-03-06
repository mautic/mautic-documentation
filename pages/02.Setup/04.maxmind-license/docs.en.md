---
title: 'Maxmind license'
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

From the 2.16 release, Mautic has supported using a license key to access the Maxmind IP lookup service.

Follow these steps to configure your Mautic instance to use the license key.

1. Create a MaxMind account by going to [Maxmind Signup][maxmind-signup]
1. After logging in, go to "My License Key" on the left hand side in the menu
1. Click "Generate new License Key". Answer "Will this key be used for GeoIP Update?" with No
1. Copy the license key that you see on the screen
1. Go to Mautic > Configuration > System Settings > Miscellaneous Settings and enter the license key into the "IP lookup service authentication" field
1. Click "Fetch IP Lookup Data Store". This will download the IP lookup database to your Mautic instance.
1. Set up the [cron job][cron-jobs] to periodically download a fresh copy.


[maxmind-signup]: <https://www.maxmind.com/en/geolite2/signup>
[cron-jobs]: </setup/cron-jobs>