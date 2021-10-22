---
title: 'Installing the tracking script'
taxonomy:
    category:
        - docs
slug: install-mautic-tracking-script
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
## How to install the tracking script

After installation and setup of the cron jobs you're ready to begin tracking contacts. You need to add a simple piece of JavaScript to the websites for each site you wish to track via Mautic. This is a very simple process and you can add this tracking script to your website template file, or install a Mautic integration for the more common Content Management System platforms. Here is an example of the tracking JavaScript which you can access by clicking on 'Tracking Settings' in the global configuration:

    <script>
    (function(w,d,t,u,n,a,m){w['MauticTrackingObject']=n;
        w[n]=w[n]||function(){(w[n].q=w[n].q||[]).push(arguments)},a=d.createElement(t),
        m=d.getElementsByTagName(t)[0];a.async=1;a.src=u;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://example.com/mautic/mtc.js','mt');

    mt('send', 'pageview');
    </script>

You should change the site URL - replace `example.com/mautic` with the URL to your Mautic instance - in the script example provided, but it's recommended to copy it from the tracking settings in your instance.

Checkout [Contact Monitoring][contact-monitoring] for more details.

[contact-monitoring]: </contacts/manage-contacts/contact-monitoring>

