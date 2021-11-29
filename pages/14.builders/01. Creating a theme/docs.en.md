---
title: 'Creating a theme'
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

[MJML][mjml] enables marketers to easily create and maintain beautiful and responsive themes for Mautic.

## Why use email themes?

### Purpose of a theme
The GrapesJs builder makes it possible to insert HTML code and edit it in a 'What You See Is What You Get' (WYSIWYG) environment.

A theme can feature a wide variety of predefined blocks and sections reflecting the desired email design - a template from which to start.

By choosing a theme, you can create beautiful emails very efficiently.

## Modifying legacy themes
The GrapesJs Builder checks the Theme configuration file before listing the available Themes, to determine which are compatible with the Builder.

Since [Mautic 3.3][mautic-3.3] a new line defines the compatible Builders:

File name: config.json

    {
      "name": "Great Theme",
      "author": "Mr. Robot",
      "authorUrl": "https://mautic.org",
      "builder": "grapesjsbuilder",
      "features": [
        "email"
      ]
    }
    
With the builder/s defined, the Theme shows in the Theme selection page.

If you wish to support more than one Builder, specify them in an array:

`"builder": ["legacy", "grapesjsbuilder"],`

## Creating a Theme from scratch

### HTML markup
It's possible to use HTML for themes, and the GrapesJs builder offers basic WYSIWYG editing capabilities.

Once converted into HTML, however, the structure is table based, and the blocks are hard to move around. For this reason, MJML themes are preferable.

### MJML markup
The MJML language allows the creation of blocks which can be freely moved around in the editor, changing the layout fundamentally without coding.

In order to harness the power of MJML, you must code the whole theme in MJML.

The best place to do so is the online editor at [https://mjml.io][mjml].

Documentation on using sections, columns, and blocks is available in the [MJML Documentation][mjml-docs]

#### Head components
At present, Mautic won't process the `<mj-head>` tags. None of the `<mj-attribuites>` run, so you have to do all styling inline.

#### Body components
At present, Mautic processes most `<mj-body>` components.

**Tested elements are:**
mj-button, mj-column, mj-divider, mj-image, mj-navbar, mj-section, mj-spacer, mj-text
  
#### Image asset relative URLs
Images have to refer to the themes folder the following way:
  
` <mj-image src="{{ getAssetUrl('themes/'~theme~'/assets/imagename.ext', null, null, true) }}" alt="logo" align="center" width="105px" padding="10px 0"></mj-image>`
  
### File structure
```
name.zip
├── assets
│   ├── image1.ext
│   └── image2.ext
├── html
│   ├── email.html.twig
│   ├── email.mjml.twig
│   ├── base.html.twig
│   └── message.html.twig
├── config.json
└── thumbnail.png
```
  
### Steps to save the Theme package
  
  Once your design in MJML is final, go through the following steps to create the theme package:

  * Save your images in the assets folder.
  * Save your MJML in the `html` folder as `email.mjml.twig` AND `email.html.twig`.
  * Use the `base.html.twig` and `message.html.twig` files from the basic theme or make your changes there.
  * Save your config.json as described previously
  * Create a thumbnail - around 400px wide, 600px high.
  * Compress the contents of the folder as a Zip file

[mautic-3.3]: <https://github.com/mautic/mautic/releases/tag/3.3.0-rc>
[mjml]: <https://mjml.io/>
[mjml-docs]: <https://documentation.mjml.io/>