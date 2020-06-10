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
![mautic-maxmind-account](mautic-maxmind-account.png "mautic-maxmind-account")
1. After logging in, under services click on "My License Key" on the left hand side in the menu
![maxmind-license-key-2](maxmind-license-key-2.png "maxmind-license-key-2")
3. Then, Click on Generate new License Key
![maxmind-generate-key-2](maxmind-generate-key-2.png "maxmind-generate-key-2")
1. Answer "Will this key be used for GeoIP Update?" with No and confirm
![maxmind-confirm-key](maxmind-confirm-key.png "maxmind-confirm-key")
1. Copy the license key that you see on the screen
![axmind-license-key](maxmind-license-key.png "axmind-license-key")
1. Go to Mautic > Settings > Configuration > System Settings > Miscellaneous Settings and enter the license key into the "IP lookup service authentication" field
![mautic-maxmind-license-key](mautic-maxmind-license-key.png "mautic-maxmind-license-key")
1. Click "Fetch IP Lookup Data Store". This will download the IP lookup database to your Mautic instance.
1. Set up the [cron job][cron-jobs] to periodically download a fresh copy.

[216-release]: <https://github.com/mautic/mautic/releases/tag/2.16.0>
[Maxmind Account]: <https://www.maxmind.com/en/accounts/>
[maxmind-signup]: <https://www.maxmind.com/en/geolite2/signup>
[cron-jobs]: </setup/cron-jobs>