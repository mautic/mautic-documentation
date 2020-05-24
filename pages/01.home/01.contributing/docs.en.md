---
title: Contributing
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

## Contributing to the Mautic documentation
---

This [repository][mautic-docs-github] serves as the [documentation][mautic-docs] for [Mautic][mautic], the open source marketing automation system.

Everyone is [welcome to contribute][CONTRIBUTING] to improve this information as needed.

<!-- ## Table of Contents -->

<!--
Use this site to generate the TOC list elements:

- https://ecotrust-canada.github.io/markdown-toc/

remove the first two lines
-->

- [Why Git](#why-git)
- [Why Grav](#why-grav)
- [How to contribute](#how-to-contribute)
  - [Editing documentation using the command line](#editing-documentation-using-the-command-line)
  - [Editing documents in the GitHub browser interface](#editing-documents-in-the-github-browser-interface)
- [File Structure](#file-structure)
- [Style Guide](#style-guide)
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
- [Mautic specific information](#mautic-specific-information)
  - [Example domain references](#example-domain-references)
    - [Protocol scheme: http vs https](#protocol-scheme-http-vs-https)
  - [Linking to Release versions](#linking-to-release-versions)
    - [`latest` version](#latest-version)
  - [References to _leads_ and _lead lists_](#references-to-_leads_-and-_lead-lists_)
      - [reference note](#reference-note)

## Why Git

Why is Git used for the documentation?

- *versions* - anyone can go back and look at what the text looked like.
- *authorship* - not only every file but every line has its author.
- *community contributions* - no need to worry about deleting someone else's work while working on the same document.

Although some Git knowledge is required to clone, modify, commit and push changes, there is a way to avoid that and edit the files directly in the GitHub web interface or via our web-based interface using the Grav CMS. If you know Git, use the workflow you like. If not, the following guide will show you how to contribute easily.

## Why Grav
Previously Gitbook was used to manage the Mautic documentation, however, this became cumbersome to maintain and difficult for those who were not familiar with Git.  The Education Team looked into various solutions and decided that Grav would best meet the needs of the Community.

## How to contribute

### Using Grav
1. Create a Mautic Community login, or log in with your existing forum/website account at [the login page][mautic-docs-login]
1. Send a message in the [Documentation slack channel][mautic-docs-slack] to have your account raised to 'editor' - get a Slack invite [here][mautic-slack-invite]
1. When logged in, click on the 'Edit page in Grav' link on the relevant page and make your changes

### Using Github

1. Fork this repository at [GitHub][mautic-docs-github]
1. Select a file to edit on your fork
1. Make your commits
1. Open a pull request to `base fork: mautic/documentation` with `base: master`
1. Include and reference any [Issues][doc-issues] your Pull Request addresses

#### Editing documentation using the command line

1. In the command line `cd` to where you want the documentation repository located
1. Clone this repository

    ````console
    git clone https://github.com/mautic/documentation.git --origin upstream
    ````

1. Fork this repository at [GitHub][mautic-docs-github] or use the [`hub`][hub] utility

    ````console
    hub fork --remote-name origin
    ````

1. Once cloning has completed, open the project in your editor of choice
1. Create a new branch for your edits. Please name your branch something descriptive like `{yourusername}-revision-readme-file`

    ````console
    git checkout -b {yourusername}-revision-readme-file upstream/master
    ````

1. Make your changes
1. Stage and commit your changes to your _local_ repository

    ````console
    git status --short
    git add <new and modified files>
    git commit --message 'move contributing to new file'
    ````

1. Push to `origin`

    ````console
    git push origin
    ````

1. Review the changes at your fork `https://github.com/{yourusername}/mautic-documentation`
1. Submit your pull request using one of these methods
   - Direct link: `https://github.com/{yourusername}/mautic-documentation/pull/new/{yourusername}-revision-readme-file`
   - GitHub web interface - `base fork: mautic/documentation` and `base: master` at [GitHub][mautic-docs-github]
   - use the [`hub`][hub] utility

    ````console
    hub pull-request
    ````

#### Editing documents in the GitHub browser interface

> **Note: Useful if you're unfamiliar with the command line but still want to contribute to the Mautic documentation via Github**

Using *README.md* as an example:

1. [Fork][mautic-docs-fork] this repository under your account so you'll have permission to edit.
1. Select the *README.md* file (refer to the [file structure section](#file-structure) below if needed)
1. With the content of *README.md* visible, click on the pencil icon to begin editing the file
1. The *.md* extension means this file was written in [Markdown][markup], a simple but flexible text formatting language. Mautic documentation is written with [Markdown markup][markup] specifically.
1. After you've made a change, scroll down to the *Commit changes* form. Saving your change requires describing what was changed and why.
1. Before submitting your commit, select the box for *Creates a new branch* to start a new branch for your change. Name your branch something like `{yourusername}-revision-readme-file`
1. Select *Propose file change*
1. In the next dialogue box, describe what you've changed and why then select *Create pull request* to open a pull request proposing we add your changes to our official repository.

## File Structure

The **`README.md`** file serves as the introduction and description of this repository. This file does not contain any product documentation.

The **`SUMMARY.md`** file defines the menu of the documentation. If you add a new page to the documentation, you'll have to also add a new line there defining the title and the link to the file (formatted like the existing menu items).

The folders in this repository are grouped together by topic. For example, within the *asset* folder, you'll see it has its own **`doc.en.md`** file (becomes `./index.html`) which contains the primary description of the Asset menu; the *manage_assets.md* the file is a subitem; the *media* subfolder contains all the images used in the *.md* files.

## Style Guide

The style guide section is very much a :construction: Work in Progress.

Please contribute :)

### Whitespace and spaces

- One blank line around headings
- One blank line around list items
- One blank line around code blocks
- One final blank line

- Two spaces after a full stop.  Next sentence.

### Lists

- Use `1.` for numbered lists.
- Use `1.` only for numbered lists.
- Use `-` for unnumbered lists
  - Indent spaces until the first character of content in the line above
  - which is effectively 2 spaces for nested unnumbered lists

<details><summary>example list</summary>

##### Example nested list

1. Item the first
1. Something else
   1. indent spaces until the first character of content in the line above
   1. that means to line up on the `S` in `Something`
      1. and the first `t` in `that`
1. And finally
   - a minor point from the `A`

- not part of the numbered list

<details><summary>markdown syntax</summary>

##### Nested list markdown syntax

```markdown
1. Item the first
1. Something else
   1. indent spaces until the first character of content in the line above
   1. that means to line up on the `S` in `Something`
      1. and the first `t` in `that`
1. And finally
   - a minor point from the `A`

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

Often you'll want to make a link to another place in the documentation.  We prefer to group links at the bottom of a page and provide a reference macro in the text.
This makes linking to the same place much easier.  In Markdown, it looks like this:

#### Absolute links

Aut et laudantium ad [ratione id][link macro]. Ut similique quis et ut.
Consectetur eum quia totam [recusandae][link macro] necessitatibus dolorem debitis.

```markdown
Aut et laudantium ad [ratione id][link macro]. Ut similique quis et ut.
Consectetur eum quia totam [recusandae][link macro] necessitatibus dolorem debitis.

[link macro]: <http://example.com>
```

#### Relative links

These will link to [`plugins/integration_test.html`][testing] on the documentation website created from the [_`plugins/integration_test.md`_][testing] source file.

The first line is an example from within the same section.  The second for anywhere else in the directory structure.

```markdown
[testing]: <integration_test.html>

[testing]: <./../plugins/integration_test.html>
```

#### Heading anchors

Heading anchors enable linking directly to a Markdown heading from within the same document very easily.  The anchors are auto-generated for all headings.
The link target is specified inline.

```markdown
Aut et laudantium ad [ratione id](#heading-anchors). Ut similique quis et ut.
Consectetur eum quia totam [recusandae](#style-guide) necessitatibus dolorem debitis.
```

### Images

Images should be placed in the media subfolders in the different sections of this repository.

Link format:

```markdown
![alternative text here](image-reference.png "Tooltip text here")
```

#### relative image links

To display an image already in the documentation repository, use a relative path.

The first line is an example of using images in the same section.  The second for anywhere else in the directory structure.

```markdown
![form rebuild cache](media/rebuild.png "Rebuild form cache"")

![form rebuild cache](./../forms/media/rebuild.png "Rebuild form cache")
```

#### absolute image links

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
    
## Mautic specific information

### Example domain references

Use `example.com` as the reference domain for documentation.

For the various installation types, use

- standard Mautic URL example

    ```http
    https://example.com
    ```

  - include `www` if relevant

      ```http
      https://www.example.com
      ```

- Mautic installed as subdomain URL

    ```http
    https://mautic.example.com
    ```

- Mautic installed as subdirectory URL

    ```http
    https://example.com/mautic
    ```

#### Protocol scheme: http vs https

- Prefer the `https://` protocol in the documentation.

    ```http
    https://example.com
    ```

- If you need to show both protocols, add brackets around the `(s)`

    ```http
    http(s)://example.com
    ```

### Linking to Release versions

- Use an [absolute external link](#absolute-links) to reference the [official released versions][release-list] of [Mautic].  The project adheres to [Semantic Versioning][semver], so all version numbers have three components: `<MAJOR>.<MINOR>.<PATCH>`

- Prefix the version with the word `Mautic` in the text, and the full three-part version number in the link macro.
  - A `<MAJOR>.<MINOR>` release version without `<PATCHES>` may be used in the text, but still use the full three-part version number in the link.
- Wrapping the version number in `<code>` backticks "`" is optional.

> Since [Mautic `2.9`][release-2.9.0], when...

```markdown
Since [Mautic `2.9`][release-2.9.0], when...

[release-2.9.0]: <https://github.com/mautic/mautic/releases/tag/2.9.0>
```

#### `latest` version

Avoid using the term _**`current`**_ or _**`latest`**_ if you actually mean _"the currently released version of Mautic that I installed"_.

In most cases, it has no meaning when a new version is released.  Instead, check the [latest release][release-latest] and explicitly use that version number.

Do NOT do this:

> In ~~the [`latest`][release-latest] version of Mautic~~...

DO this instead:

> In [Mautic `2.15.3`][release-2.15.3] ...

```markdown
> In [Mautic `2.15.3`][release-2.15.3] ...

[release-2.15.3]: <https://github.com/mautic/mautic/releases/tag/2.15.3>
```

### References to _leads_ and _lead lists_

Include this **Note** if there are references to outdated terminology that cannot be updated.

> **Note**
>
> In this document, there may be references to outdated terminology such as
>
> - _leads_,
> - _lists_ or _lead lists_, and
> - _anonymous leads_
>
> In [Mautic version `1.4`][release-1.4.0],
>
> - _leads_ were renamed to _**contacts**_
> - _lead lists_ were renamed to _**segments**_
> - _anonymous leads_ were renamed to _**visitors**_

<details><summary>markdown syntax</summary>

##### reference note

```markdown
> **Note**
>
> In this document, there may be references to outdated terminology such as
>
> - _leads_,
> - _lists_ or _lead lists_, and
> - _anonymous leads_
>
> In [Mautic version `1.4`][release-1.4.0],
>
> - _leads_ were renamed to _**contacts**_
> - _lead lists_ were renamed to _**segments**_
> - _anonymous leads_ were renamed to _**visitors**_

[release-1.4.0]: <https://github.com/mautic/mautic/releases/tag/1.4.0>
```

</details>

<!-- markdown style links -->

[CONTRIBUTING]: <https://github.com/mautic/mautic-documentation/CONTRIBUTING.md>
[release-list]: <https://github.com/mautic/mautic/releases>
[release-latest]: <https://github.com/mautic/mautic/releases/latest>
[release-2.15.3]: <https://github.com/mautic/mautic/releases/tag/2.15.3>
[release-2.9.0]: <https://github.com/mautic/mautic/releases/tag/2.9.0>
[release-1.4.0]: <https://github.com/mautic/mautic/releases/tag/1.4.0>

[mautic-docs]: <https://docs.mautic.org>
[mautic-docs-login]: <https://docs.mautic.org/login>
[mautic-docs-github]: <https://github.com/mautic/mautic-documentation>
[mautic-docs-fork]: <https://github.com/mautic/mautic-documentation#fork-destination-box>
[mautic-doc-license]: <https://github.com/mautic/mautic-documentation/blob/master/LICENSE>
[doc-issues]: <https://github.com/mautic/mautic-documentation/issues>

[developer-docs]: <https://developer.mautic.org>
[developer-docs-github]: <https://github.com/mautic/developer-documentation>

[Mautic]: <https://mautic.org/>
[mautic]: <https://mautic.org/>
[mautic-github]: <https://github.com/mautic/mautic>
[mautic-docs-slack]: <https://mautic.slack.com/archives/C02HV781U>
[mautic-slack-invite]: <https://mautic.org/slack>

[semver]: <https://semver.org/spec/v2.0.0.html>
[gitbook]: <https://www.gitbook.com/>
[markup]: <https://help.github.com/en/github/writing-on-github/basic-writing-and-formatting-syntax>
[hub]: <https://github.com/github/hub/releases>
[linguistic]: <https://github.com/github/linguist>

