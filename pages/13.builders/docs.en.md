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

Since [Mautic 3.3][mautic-3.3], Mautic has shipped with an updated, modern builder for creating emails and landing pages.  It is available as a beta release - an optional plugin - until Mautic 4.0 where we plan to fully replace the legacy builder, assuming all goes well during the beta phase.

>>> To use your existing templates with the new Email builder, you will need to add one line to your configuration file. Read on for further details.

## About GrapesJS
The new builder is based on the Open Source [GrapesJS][grapesjs] framework and was created by the team at [Webmecanik][webmecanik] who have kindly donated it to the Mautic Community.

GrapesJS is an open-source, multi-purpose, Web Builder Framework which combines different tools and features with the goal to help build HTML templates without any knowledge of coding. 

### Available end-user features

#### Drag & Drop Built-in Blocks
GrapesJS comes with a set of built-in blocks, in this way you're able to build your templates faster. If the default set is not enough you can always add your own custom blocks.

#### Limitless styling
GrapesJS implements a simple and powerful Style Manager module which enables independent styling of any component inside the canvas. It's also possible to configure it to use any of the CSS properties.

#### Responsive design
GrapesJS gives you all the necessary tools you need to optimize your templates to look awesomely on any device. In this way you're able to provide various viewing experiences. In case more device options are required, you can easily add them to the editor.

#### The structure always under control
You can nest components as much as you can but when the structure begins to grow the Layer Manager comes very handy. It allows you to manage and rearrange your elements extremely fast, focusing always on the architecture of your structure.

#### The code is there when you need it
You don't have to care about the code, but it's always there, available for you. When the work is done you can grab and use it wherever you want. Developers could also implement their own storage interfaces to use inside the editor.

#### Asset Manager
With the Asset Manager is easier to organize your media files and it's enough to double click on the image to change it.

## About the builder

### Enabling the builder
Since Mautic 3.3-RC1 the builder is available to enable in the Plugins section of Mautic. Go to the Settings (click the cog wheel at the top right) > Plugins > GrapesJS and click on it. Change the slider to Yes.

Now you will need to **clear your Mautic cache** (located in var/cache) before you will be able to work with the new GrapesJS builder.

### Templates

To use your existing templates with the new Email builder, you will need to add one line to your configuration file in the template folder:

`"builder": "grapesjsbuilder",`

From the 3.3 General Availability release there will be three email templates that support MJML, and also some landing page templates will also be made available in the near future.  

Before these are released, you can download the files/test the pull requests [here][mjml-templates]. You can also use the blank theme from Webmecanick which you can access [here][blank-theme].

### Themes

`Brienz` and `Paprika` aren't be available if you search the list of available themes. You'll need to enable GrapesJS builder to get these two themes. Then, in addition to Blank and the other themes, these two themes, **Brienz** and **Paprika**, would now be available.


### Reporting bugs

#### Known bugs / issues

* Code mode is not available if there are no active themes
* Code mode is not working in emails (but you can copy/paste your code into the code editor of the builder)
* Cloning MJML Template - Reverts template to HTML and locks editor
* Link Editor is out of viewport on bottom page/email links
* Cant use space, delete or backspace for text in buttons
* Gmail 404 broken image for images with spaces
* Live page render includes links to plugin Javascript and CSS
* Invalid URLs should be blocked for images
* Page Builder CSS is not loaded when initially editing a page (it is fine once you save, and open the page with the Preview or Live URL)
* Toggle on/off publish email throws an error

Please use the issue queue on the [Github repository][github] to check for the latest updates and report bugs with the plugin. Be sure to search first in case someone has already reported the bug!

## Switching back to the legacy Builder
In case you are not happy with the plugin at the moment, you can easily switch back to the legacy Builder (original Mautic Builder). You can do so very quickly:

1. Go to Mautic Settings > Click the cogwheel on the right-hand top corner
2. Open the Plugins Directory > click on "Plugins" inside the menu
3. Find the GrapesJs Plugin and click on it > Click "No" and then "Save and Close"
4. Clear the cache

The GrapesJs Plugin has been unloaded, and the legacy builder will now be active again.

## Thanks and credits

Thank you to everyone who contributed to this project. Special thanks to [Webmecanik][webmecanik] for all their hard work in creating and contributing this amazing new builder; to Joey from [Friendly Automate][friendly] for donating three email themes to the Community, and to Adrian Schimpf from [idea2][idea2] and Alex Hammerschmied from [hartmut.io][hartmut.io] for their work in leading the project.

And of course a really big thank you to all the contributors who have helped to bring this project to this point, many of whom are listed in our [release notes][release-notes].

[mautic-3.3]: <https://github.com/mautic/mautic/releases/tag/3.3.0-rc>
[grapesjs]: <https://grapesjs.com/>
[webmecanik]: <https://www.webmecanik.com/en>
[mjml-templates]: <https://github.com/mautic/mautic/pulls?q=is%3Apr+is%3Aopen+mjml>
[github]: <https://github.com/mautic/plugin-grapesjs-builder/issues>
[blank-theme]: <https://github.com/mautic/plugin-grapesjs-builder/files/4757520/blank_mjml.zip>
[friendly]: <https://friendly.is/en/>
[idea2]: <https://idea2.ch>
[hartmut.io]: <https://hartmut.io>
[release-notes]: <https://github.com/mautic/plugin-grapesjs-builder/releases>
