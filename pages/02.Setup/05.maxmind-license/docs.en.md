---
title: 'Maxmind license'
media_order: 'maxmind-generate-key.png,maxmind-generate-key-2.png,maxmind-license-key.png,mautic-maxmind-license-key.png'
taxonomy:
    category:
        - docs
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
From the [2.16 release][216-release], Mautic has supported using a license key to access the Maxmind IP lookup service.

Follow these steps to configure your Mautic instance to use the license key.

1. Create a MaxMind account by going to [Maxmind Signup][maxmind-signup]
1. After signup, check your email and click on access your [Maxmind Account][Maxmind Account].
1. Click on the Contact icon at the top right of the menu to login
![](mautic-maxmind-account.png)
1. After logging in, under services click on "My License Key" on the left hand side in the menu
![](maxmind-generate-key.png)
1. Click Generate new License Key
![](maxmind-generate-key-2.png)
1. After clicking "Generate new License Key". Answer "Will this key be used for GeoIP Update?" with No
![](confirm-key.png)
1. Confirm and copy the license key that you see on the screen
![](maxmind-license-key.png)
1. Go to Mautic > Settings > Configuration > System Settings > Miscellaneous Settings and enter the license key into the "IP lookup service authentication" field
![](mautic-maxmind-license-key.png)
1. Click "Fetch IP Lookup Data Store". This will download the IP lookup database to your Mautic instance.
1. Set up the [cron job][cron-jobs] to periodically download a fresh copy.

[216-release]: <https://github.com/mautic/mautic/releases/tag/2.16.0>
[maxmind-signup]: <https://www.maxmind.com/en/geolite2/signup>
[Maxmind Account]:<https://www.maxmind.com/en/accounts/>
[cron-jobs]: </setup/cron-jobs>