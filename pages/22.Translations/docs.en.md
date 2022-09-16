---
title: Translations
media_order: ''
body_classes: ''
order_by: ''
order_manual: ''
taxonomy:
    category:
        - docs
---

---------------

Mautic is used by a world-wide community and therefore it can be localized to any language. If you cannot find your language yet, take a look to the section about how to translate Mautic.

## How to select a language in Mautic

Language can be selected in 2 places.

### 1. Default language

In the Mautic configuration the default language can be configured. It is pre-set to `English - United States` by default. Every user will see this language if she doesn't configure her language in her profile.

1. Open the right admin menu by clicking on the cog icon in the top right corner.
2. Select the *Configuration* menu item.
3. Select the default language.
4. Save the configuration.

![Select the default language](translations-select-language.png "Select the default language")

### 2. User language

A user can define her own language and override the default language. This lets a multilangual team work on the same Mautic instance.

1. Open the user menu by clicking on the user name in the top right corner.
2. Click on *Account* menu item.
3. Select the user language.
4. Save the user profile.

![Select the user language](translations-select-user-language.png "Select the user language")

## How to translate Mautic

Mautic can be translated to any language. As Mautic is a community project, it can be translated by any community member to any language. Translations are made in the [Transifex][transifex] web app.

1. Create an account at [Transifex][transifex] if you don't have one already.
2. Take a look at the [list of languages][transifex] which were created for the project already.
3. Create a language if your language is missing or apply for an existing language.

Take a look at official [Transifex Documentation][transifex-documentation]if you have any questions about the translation process.

## How to update a language

A language is downloaded automatically every time the configuration is saved and the language hasn't been downloaded already. The tricky part is that Mautic won't download a language if it has been already downloaded. So to update a language:

1. Open the Mautic file system via SFTP or SSH.
2. In the Mautic root folder you should see the folder called *translations*. Open it.
3. In the *translations* folder are the languages stored. Remove the folder of the language you want to update.
4. Go go Mautic configuration and save it with the language you've deleted.

The language should be downloaded again with the latest translations. The translations are generated from Transifex once a day.

If you have any questions about translations, join the community in the [Slack #Translations channel][slack-channel].


[transifex]: <https://www.transifex.com/mautic/mautic/>
[transifex-documentation]: <http://docs.transifex.com/tutorials/txeditor/>
[slack-channel]: <https://mautic.slack.com/archives/C02HV79J2>

## Translation overrides

Mautic allows you to override the existing language translations without the need to hack the core files. That is good idea especially because a Mautic upgrade would remove your modifications. Here's how to change translations correctly:

As an example, let's override the first menu item "Dashboard" to "Banana" as that's what everyone was thinking anyway.

![Override Dashboard menu item](translations-dashboard.png "Override Dashboard menu item")

### 1. Search for the translation key

The best way to search for the right translation key is in a text editor like VS Code that will allow you to search for a text in all files of Mautic's source code and filter those files by file extension `*.ini`. GitHub has also an option to search for strings in the repository but it's not particulary good search engine. But let's use it for this example. I'm searching for "Dashboard menu" as there is special translation for the menu item and another for the page title. I know that because I looked in my text editor. GitHub won't find the right translation when you search for just "Dashboard". And then we can filter for only INI files. Here is the link to the search result:

https://github.com/mautic/mautic/search?l=INI&q=Dashboard+menu

The first file it found is `app/bundles/DashboardBundle/Translations/en_US/messages.ini` and there is `mautic.dashboard.menu.index="Dashboard"` line in it which looks like what we want to change.

### 2. Override the translation

The hard part is behind us. We know we have to override the `mautic.dashboard.menu.index` translation key. To do so, go to the folder `translations` in the root directory of the Mautic project. Create new folder in it called `overrides`. In this folder create the folder for the locale you want to override. In this case we'll override the default locale which is `en_US` but if you use different language then you'll see its locale as a folder in the `translations` folder so you'll know how to call the folder.

In the `translations/overrides/en_US` folder create new file called `messages.ini`. Notice it's the same file name as the original. It must be the same. Some translations may be in `flashes.ini` or `validators.ini` and if you override a translation from those files then you have to create the correct file too and put the translation in it. But in our case it's `translations/overrides/en_US/messages.ini`.

In this file we'll copy the line we want to override from the original `app/bundles/DashboardBundle/Translations/en_US/messages.ini` file and change the translation like so:

`mautic.dashboard.menu.index="Banana"`

Save the file and clear the cache with `bin/console cache:clear` command. Refresh the page and the administration is finally perfect:

![Dashboard menu item overriden to Banana](translations-banana.png "Dashboard menu item overriden to Banana")





