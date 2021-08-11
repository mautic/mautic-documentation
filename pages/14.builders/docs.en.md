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

`"builder": ["grapesjsbuilder"],`

If you wish to use the theme in multiple builders, you can use this syntax:

`"builder": ["legacy", "grapesjsbuilder"],`

>>>> NOTE: This syntax changed between Mautic 3.3.* and Mautic 4 to enable support for multiple builders - if you have been testing in the beta phase you will need to update your configuration files, otherwise you will experience a 500 error.

An example of a full configuration file can be found in the blank theme:
```json
{
  "name": "Blank",
  "author": "Mautic team",
  "authorUrl": "https://mautic.org",
  "builder": ["legacy", "grapesjsbuilder"],
  "features": ["page", "email", "form"]
}
```

From the 3.3 General Availability release there will be three email templates that support MJML, and also some landing page templates will also be made available in the near future.  

### Themes

If you search through the list of available themes, the new MJML themes `Brienz`, `Paprika` and `Confirm Me` will not be available until you enable the GrapesJS plugin.

### Creating new Themes

#### Why use themes?
The GrapesJs builder makes it possible to insert HTML code and edit it in a 'What You See Is What You Get' (WYSIWYG) environment.
A theme allows you to create a template which can feature a wide variety of blocks and sections reflecting the desired email, landing page and form design.
By choosing a theme as a starting point and adding or removing blocks as needed, beautiful emails can be created very efficiently.

#### Modifying legacy Themes
The GrapesJs Builder checks the Theme configuration file before listing the available Themes, to determine which are compatible with the Builder.
As of Mautic 3.3 a new line has to be added, that defines which email designer is the template suitable for:

File name: config.json

```    {
      "name": "Great Template",
      "author": "Mr. Robot",
      "authorUrl": "https://mautic.org",
      "builder":  ["grapesjsbuilder"],
      "features": [
        "email"
      ]
    }`

Once the Builder is defined, the Theme will show in the Theme selection page.

If you wish to support more than one Builder, specify them in an array:

`"builder": ["legacy", "grapesjsbuilder"],`

#### Creating a Theme from scratch
##### HTML Markup
As mentioned before, it is possible to use HTML for Themes, and the GrapesJs Builder will try to offer WYSIWYG editing possibilities from that markup.
However once a Theme is converted into HTML, the structure will be table based, and the blocks above and below each other are hard to move around.

##### MJML Markup
The [MJML language][mjml] allows us to create blocks, that can be freely moved around in the editor, changing the template fundamentally without coding.
In order to harness the power of MJML, the whole template has to be coded in MJML.

The best place to do so is the online editor at https://mjml.io.
Documentation on using sections, columns and blocks can be found here: [https://documentation.mjml.io][mjml-docs]

###### Head components
Mautic will not process the <mj-head> tags at this point. None of the <mj-attribuites> will run, so you have to do all styling inline.

###### Body components
Most <mj-body> components will be processed.

**Tested elements are:**
mj-button, mj-column, mj-divider, mj-image, mj-navbar, mj-section, mj-spacer, mj-text

###### Image asset relative URLs
Images have to refer to the themes folder the following way:

` <mj-image src="{{ getAssetUrl('themes/'~template~'/assets/imagename.ext', null, null, true) }}" alt="logo" align="center" width="105px" padding="10px 0"></mj-image>`

###### File structure
`name.zip
├── assets
│   ├── image1.ext
│   └── image2.ext
├── html
│   ├── email.html.twig
│   ├── email.mjml.twig
│   ├── base.html.twig
│   └── message.html.twig
├── config.json
└── thumbnail.png`

##### Steps to save the Theme package

  Once your design in MJML is final, go through the following steps to create the template package:

  * save your images in the assets folder
  * Save your MJML in the html folder as email.mjml.twig AND email.html.twig
  * Use the base.html.twig and message.html.twig files from the basic theme or make your changes there
  * Save your config.json as described above
  * Create a thumbnail (around 400px wide, 600px high)
  * Zip the contents of the folder

### Reporting bugs

#### Known bugs / issues

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
[github]: <https://github.com/mautic/mautic/issues?q=is%3Aopen+is%3Aissue+label%3Abuilder-grapesjs>
[friendly]: <https://friendly.is/en/>
[idea2]: <https://idea2.ch>
[hartmut.io]: <https://hartmut.io>
[release-notes]: <https://github.com/mautic/plugin-grapesjs-builder/releases>
