---
title: Style Guide
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

## Style Guide

The style guide section is Work in Progress. Please contribute.

  - [Whitespace and spaces](#whitespace-and-spaces)
  - [Lists](#lists)
      - [Example nested list](#example-nested-list)
      - [Nested list markdown syntax](#nested-list-markdown-syntax)
  - [Code blocks](#code-blocks)
      - [Example `<codeblock>`](#example-codeblock)
      - [`<codeblock>` markdown syntax](#codeblock-markdown-syntax)
      - [Example nested `<codeblock>`](#example-nested-codeblock)
      - [Nested `<codeblock>` markdown syntax](#nested-codeblock-markdown-syntax)
  - [Links](#links)
    - [Absolute links](#absolute-links)
    - [Relative links](#relative-links)
    - [Heading anchors](#heading-anchors)
  - [Images](#images)
    - [relative image links](#relative-image-links)
    - [absolute image links](#absolute-image-links)

### Whitespace and spaces

- One blank line around headings
- One blank line around list items
- One blank line around code blocks
- One final blank line

- Two spaces after a full stop.  Next sentence.

### Lists

- Use `1.` only for numbered lists.
- Use `-` for unnumbered lists
  - Indent spaces until first character of content in line above
  - which is effectively 2 spaces for nested unnumbered lists

<details><summary>example list</summary>

##### Example nested list

1. Item the first
1. Something else
   1. indent spaces until first character of content in line above
   1. that means line up on the `S` in `Something`
      1. and the first `t` in `that`
1. And finally
   - minor point from the `A`

- not part of the numbered list

<details><summary>markdown syntax</summary>

##### Nested list markdown syntax

```markdown
1. Item the first
1. Something else
   1. indent spaces until first character of content in line above
   1. that means line up on the `S` in `Something`
      1. and the first `t` in `that`
1. And finally
   - minor point from the `A`

- not part of the numbered list
```

</details>
</details>

### Code blocks

1. Prefer fenced `<codeblock>`s with three backticks
1. Must have [language identifier][linguistic]
   - Use `text` if no highlighting required
1. Fenced code blocks within lists need to be indented for numbered lists to continue

<details><summary>example codeblock</summary>

##### Example `<codeblock>`

```php
/**
 * Constructor.
 *
 * @param string $environment The environment
 * @param bool   $debug       Whether to enable debugging or not
 *
 * @api
 */
public function __construct($environment, $debug)
{
    defined('MAUTIC_ENV') or define('MAUTIC_ENV', $environment);
    defined('MAUTIC_VERSION') or define(
        'MAUTIC_VERSION',
        self::MAJOR_VERSION.'.'.self::MINOR_VERSION.'.'.self::PATCH_VERSION.self::EXTRA_VERSION
    );

    parent::__construct($environment, $debug);
}
```

<details><summary>A markdown syntax</summary>

##### `<codeblock>` markdown syntax

```markdown

/**
 * Constructor.
 *
 * @param string $environment The environment
 * @param bool   $debug       Whether to enable debugging or not
 *
 * @api
 */
public function __construct($environment, $debug)
{
    defined('MAUTIC_ENV') or define('MAUTIC_ENV', $environment);
    defined('MAUTIC_VERSION') or define(
        'MAUTIC_VERSION',
        self::MAJOR_VERSION.'.'.self::MINOR_VERSION.'.'.self::PATCH_VERSION.self::EXTRA_VERSION
    );

    parent::__construct($environment, $debug);
}

```

</details>
</details>

<details><summary>example nested codeblock</summary>

##### Example nested `<codeblock>`

1. START list item

   Example nested `<codeblock>`

    ```php
    /**
     * Constructor.
     *
     * @param string $environment The environment
     * @param bool   $debug       Whether to enable debugging or not
     *
     * @api
     */
    public function __construct($environment, $debug)
    {
        defined('MAUTIC_ENV') or define('MAUTIC_ENV', $environment);
        defined('MAUTIC_VERSION') or define(
            'MAUTIC_VERSION',
            self::MAJOR_VERSION.'.'.self::MINOR_VERSION.'.'.self::PATCH_VERSION.self::EXTRA_VERSION
        );

        parent::__construct($environment, $debug);
    }
    ```

1. END list item

<details><summary>markdown syntax</summary>

##### Nested `<codeblock>` markdown syntax

```markdown
    ```php
    /**
     * Constructor.
     *
     * @param string $environment The environment
     * @param bool   $debug       Whether to enable debugging or not
     *
     * @api
     */
    public function __construct($environment, $debug)
    {
        defined('MAUTIC_ENV') or define('MAUTIC_ENV', $environment);
        defined('MAUTIC_VERSION') or define(
            'MAUTIC_VERSION',
            self::MAJOR_VERSION.'.'.self::MINOR_VERSION.'.'.self::PATCH_VERSION.self::EXTRA_VERSION
        );

        parent::__construct($environment, $debug);
    }
    ```
```

</details>
</details>

### Links

[link macro]: <http://example.com>
[testing]: <./../plugins/integration_test.html>

Often you'll want to make a link to another place in the documentation.  We prefer to group links at the bottom of a page, and provide a reference macro in the text.
This make linking to the same place much easier.  In Markdown, it looks like this:

#### Absolute links

You can have different links in your text, some leading [here][link macro] and others leading [there][link macro].

```markdown
You can have different links in your text, some leading [here][link macro] and others leading [there][link macro].

[link macro]: <http://example.com>
```

#### Relative links

These will link to [`/plugins/plugin-resources/testing-integrations`][testing] on the documentation website created from the [_`pages/13.Plugins/00.General%20Resources/01.Integration%20test/docs.en.md`_][testing] source file.  These should still use a link macro as with absolute links.

The first line is an example from within the same section.  The second for anywhere else in the directory structure.

```markdown
[testing]: </plugins/plugin-resources/testing-integrations>

```

#### Heading anchors

Heading anchors enable linking directly to a Markdown heading from within the same document very easily.  The anchors are auto-generated for all headings.
The link target is specified inline.

```markdown
You can have different anchors in your text, for example to this [Section][#anchor-section] right here.

### Images

Images should be placed in the media subfolders in the different sections of this repository.

Link format:

```markdown
![alternative text here](image-reference.png "Tooltip text here")
```

#### Relative image links

To display an image already in the documentation repository, use a relative path.

The first line is an example of using images in the same section.  The second for anywhere else in the directory structure.

```markdown
![form rebuild cache](media/rebuild.png "Rebuild form cache"")

![form rebuild cache](./../forms/media/rebuild.png "Rebuild form cache")
```

#### Absolute image links

For images that cannot be uploaded via the GitHub web interface, upload them to a public URL service and use the generated link.

```markdown
![apple](http://example.com/images/apple.png "Like this delicious apple")
```

> **Warning**
>
> ##### internal absolute image link
>
> This link format should NOT be used.
>
> ~~`![form rebuild cache](/forms/media/rebuild.png "Rebuild form cache")`~~

### Videos
You can embed a YouTube video using the following syntax:
    `[plugin:youtube](https://www.youtube.com/watch?v=<videoid>)`
    
