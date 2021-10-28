---
title: 'Email & Landing Page Builder'
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

## Introduction

Since [Mautic 3.3][mautic-3.3], Mautic has shipped with an updated, modern builder for creating emails and landing pages. In [Mautic 4.0][mautic-4.0] it's the default builder.

>>> To use your existing templates with the new builder, you need to add one line to your configuration file. Read on for further details.

## About GrapesJS
The new email and landing page builder was initiated as an MVP by [Webmecanik][webmecanik]. It is based on the open source [GrapesJS][grapesjs] framework and was developed and further refined by [Aivie][aivie] who kindly made it available to the Mautic community.

GrapesJS is an open source, multi-purpose, Web Builder Framework which combines different tools and features with the goal to help build HTML templates without any knowledge of coding.

### Available end-user features

#### Drag & drop built-in blocks
GrapesJS comes with a set of built-in blocks, in this way you're able to build your templates faster. If the default set isn't enough you can always add your own custom blocks.

#### Limitless styling
GrapesJS implements a simple and powerful Style Manager module which enables independent styling of any component inside the canvas. It's also possible to configure it to use any of the CSS properties.

#### Responsive design
GrapesJS gives you all the necessary tools you need to optimize your templates to look awesomely on any device. In this way you're able to provide various viewing experiences. In case you require more device options, you can easily add them to the editor.

#### The structure always under control
You can nest components as much as you can but when the structure begins to grow the Layer Manager comes very handy. It allows you to manage and rearrange your elements extremely fast, focusing always on the architecture of your structure.

#### The code is there when you need it
You don't have to care about the code, but it's always there, available for you. When the work is done you can grab and use it wherever you want. Developers could also implement their own storage interfaces to use inside the editor.

#### Asset manager
With the Asset Manager is easier to organize your media files and it's enough to double click the image to change it.

## About the builder

### Enabling the builder
Since Mautic 3.3-RC1 the builder is available to enable in the Plugins section of Mautic. Go to the Settings by clicking the cog wheel at the top right > Plugins > GrapesJS and click the GrapesJS icon. Change the slider to Yes.

Now you need to **clear your Mautic cache** located in var/cache and refresh the page before you can work with the new GrapesJS builder. Some browsers may also require you to clear the browser cache.

By default, Mautic 4 activates the new builder. Follow the previous steps to revert to the legacy builder, remembering to clear the cache and reload the page.

### Email builder overview
![Screenshot of email editor](editor_overview.png)

The functions of the email builder are as follows:

1. You can select different screen size to preview your emails.

2. You have the ability to undo and redo your changes.

3. Editor functions from left to right: display grids, Full screen view, export MJML / HTML code, Edit code, display customization options, display blocks, close editor.

4. Layout sections. These objects function as the basic structure of your design. Create your email structure from sections, and pull in the different blocks you want to use.

5. Content blocks. You can populate your newsletter with these content blocks. Each block has specific layout, settings and design.

### Templates

To use your existing templates with the new builder, you need to add one line to your configuration file in the template folder:

`"builder": ["grapesjsbuilder"],`

If you wish to use the theme in multiple builders, you can use this syntax:

`"builder": ["legacy", "grapesjsbuilder"],`

>>>> NOTE: this syntax changed between Mautic 3.3.* and Mautic 4 to enable support for multiple builders - if you have been testing in the beta phase you need to update your configuration files to avoid a 500 error.

The blank theme contains an example of a full configuration file:
```json
{
  "name": "Blank",
  "author": "Mautic team",
  "authorUrl": "https://mautic.org",
  "builder": ["legacy", "grapesjsbuilder"],
  "features": ["page", "email", "form"]
}
```

From the 3.3 General Availability release there are be three email templates that support MJML.  

### Themes

If you search through the list of available themes, the new MJML themes `Brienz`, `Paprika` and `Confirm Me` display only with the new builder.

To learn more about creating themes please [check the documentation][creating-a-theme].

### Reporting bugs

#### Known bugs / issues

Please use the issue queue on the [GitHub repository][github] to find the latest updates and report bugs with the plugin. Be sure to search first in case someone has already reported the bug.

## Switching back to the legacy Builder
In case you are not happy with the plugin at the moment, you can easily switch back to the legacy Builder (original Mautic Builder). You can do so very quickly:

1. Go to Mautic Settings > Click the cogwheel on the right-hand top corner
2. Open the Plugins Directory > click "Plugins" inside the menu
3. Find the GrapesJs Plugin and click it > Click "No" and then "Save and Close"
4. Clear the cache and reload the page (you may also need to clear your browser cache)

The GrapesJs Plugin has been unloaded, and the legacy builder will now be active again.

## Thanks and credits

Thank you to everyone who contributed to this project. Special thanks to Adrian Schimpf from [Aivie][aivie] for all their hard work in leading the project, to [Webmecanik][webmecanik] for initializing this amazing new builder and to Joey from [Friendly Automate][friendly] for donating three email themes to the Community. Additional contributions: Alex Hammerschmied from [hartmut.io][hartmut.io], Dennis Ameling.

And of course a really big thank you to all the contributors who have helped to bring this project to this point.

[mautic-3.3]: <https://github.com/mautic/mautic/releases/tag/3.3.0-rc>
[mautic-4.0]: <https://github.com/mautic/mautic/releases/tag/4.0.0>
[grapesjs]: <https://grapesjs.com/>
[webmecanik]: <https://www.webmecanik.com/en>
[github]: <https://github.com/mautic/mautic/issues?q=is%3Aopen+is%3Aissue+label%3Abuilder-grapesjs>
[friendly]: <https://friendly.is/en/>
[aivie]: <https://aivie.ch>
[hartmut.io]: <https://hartmut.io>
[release-notes]: <https://github.com/mautic/mautic/releases>
[creating-a-theme]: </builders/create-a-theme-grapesjs-builder>
