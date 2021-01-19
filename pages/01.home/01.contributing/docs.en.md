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
  - [Guide to Grav markdown styles](#grav-markdown)
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
1. Open a pull request to `base fork: mautic/mautic-documentation` with `base: master`
1. Include and reference any [Issues][doc-issues] your Pull Request addresses

#### Editing documentation using the command line

1. In the command line `cd` to where you want the documentation repository located
1. Clone this repository

    ````console
    git clone https://github.com/mautic/mautic-documentation.git --origin upstream
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
   - GitHub web interface - `base fork: mautic/mautic-documentation` and `base: master` at [GitHub][mautic-docs-github]
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

The folders in this repository are grouped together by topic. For example, within the *asset* folder, you'll see it has its own **`README.md`** file (becomes `./index.html`) which contains the primary description of the Asset menu; the *manage_assets.md* file is a subitem; the *media* subfolder contains all the images used in the *.md* files.

## Style Guide

The style guide section is very much a :construction: Work in Progress.

Please contribute :)

### Grav markdown

Grav ships with built-in support for [Markdown](http://daringfireball.net/projects/markdown/) and [Markdown Extra](https://michelf.ca/projects/php-markdown/extra/).

Here are the main elements of Markdown and what the resulting HTML looks like:

>>> <i class="fa fa-bookmark"></i> Bookmark this page for easy future reference!

#### Headings

Headings from `h1` through `h6` are constructed with a `#` for each level:

```markdown
# h1 Heading
## h2 Heading
### h3 Heading
#### h4 Heading
##### h5 Heading
###### h6 Heading
```

Renders to:

# h1 Heading
## h2 Heading
### h3 Heading
#### h4 Heading
##### h5 Heading
###### h6 Heading

HTML:

```html
<h1>h1 Heading</h1>
<h2>h2 Heading</h2>
<h3>h3 Heading</h3>
<h4>h4 Heading</h4>
<h5>h5 Heading</h5>
<h6>h6 Heading</h6>
```

<br>
<br>
<br>

#### Comments

Comments should be HTML compatible

```html
<!--
This is a comment
-->
```
Comment below should **NOT** be seen:

<!--
This is a comment
-->

<br>
<br>
<br>

#### Horizontal Rules

The HTML `<hr>` element is for creating a "thematic break" between paragraph-level elements. In markdown, you can create a `<hr>` with any of the following:

* `___`: three consecutive underscores
* `---`: three consecutive dashes
* `***`: three consecutive asterisks

renders to:

___

---

***


<br>
<br>
<br>


#### Body Copy

Body copy written as normal, plain text will be wrapped with `<p></p>` tags in the rendered HTML.

So this body copy:

```markdown
Lorem ipsum dolor sit amet, graecis denique ei vel, at duo primis mandamus. Et legere ocurreret pri, animal tacimates complectitur ad cum. Cu eum inermis inimicus efficiendi. Labore officiis his ex, soluta officiis concludaturque ei qui, vide sensibus vim ad.
```
renders to this HTML:

```html
<p>Lorem ipsum dolor sit amet, graecis denique ei vel, at duo primis mandamus. Et legere ocurreret pri, animal tacimates complectitur ad cum. Cu eum inermis inimicus efficiendi. Labore officiis his ex, soluta officiis concludaturque ei qui, vide sensibus vim ad.</p>
```


<br>
<br>
<br>


#### Emphasis

##### Bold
For emphasizing a snippet of text with a heavier font-weight.

The following snippet of text is **rendered as bold text**.

```markdown
**rendered as bold text**
```
renders to:

**rendered as bold text**

and this HTML

```html
<strong>rendered as bold text</strong>
```

##### Italics
For emphasizing a snippet of text with italics.

The following snippet of text is _rendered as italicized text_.

```markdown
_rendered as italicized text_
```

renders to:

_rendered as italicized text_

and this HTML:

```html
<em>rendered as italicized text</em>
```


##### Strikethrough
In GFM (GitHub flavored Markdown) you can do strikethroughs.

```markdown
~~Strike through this text.~~
```
Which renders to:

~~Strike through this text.~~

HTML:

```html
<del>Strike through this text.</del>
```

<br>
<br>
<br>


#### Blockquotes
For quoting blocks of content from another source within your document.

Add `>` before any text you want to quote.

```markdown
> **Fusion Drive** combines a hard drive with a flash storage (solid-state drive) and presents it as a single logical volume with the space of both drives combined.
```

Renders to:

> **Fusion Drive** combines a hard drive with a flash storage (solid-state drive) and presents it as a single logical volume with the space of both drives combined.

and this HTML:

```html
<blockquote>
  <p><strong>Fusion Drive</strong> combines a hard drive with a flash storage (solid-state drive) and presents it as a single logical volume with the space of both drives combined.</p>
</blockquote>
```

Blockquotes can also be nested:

```markdown
> Donec massa lacus, ultricies a ullamcorper in, fermentum sed augue.
Nunc augue augue, aliquam non hendrerit ac, commodo vel nisi.
>> Sed adipiscing elit vitae augue consectetur a gravida nunc vehicula. Donec auctor
odio non est accumsan facilisis. Aliquam id turpis in dolor tincidunt mollis ac eu diam.
```

Renders to:

> Donec massa lacus, ultricies a ullamcorper in, fermentum sed augue.
Nunc augue augue, aliquam non hendrerit ac, commodo vel nisi.
>> Sed adipiscing elit vitae augue consectetur a gravida nunc vehicula. Donec auctor
odio non est accumsan facilisis. Aliquam id turpis in dolor tincidunt mollis ac eu diam.


<br>
<br>
<br>

#### Notices

We have four notice styles and they extend the standard markdown syntax for block quotes.  Basically levels of 3 block quote or greater produce notices in 4 colors:

##### Yellow

```markdown
>>> Sed adipiscing elit vitae augue consectetur a gravida nunc vehicula. Donec auctor
odio non est accumsan facilisis. Aliquam id turpis in dolor tincidunt mollis ac eu diam.
```

Renders to:

>>> Sed adipiscing elit vitae augue consectetur a gravida nunc vehicula. Donec auctor
odio non est accumsan facilisis. Aliquam id turpis in dolor tincidunt mollis ac eu diam.

##### Red

```markdown
>>>> Sed adipiscing elit vitae augue consectetur a gravida nunc vehicula. Donec auctor
odio non est accumsan facilisis. Aliquam id turpis in dolor tincidunt mollis ac eu diam.
```

Renders to:

>>>> Sed adipiscing elit vitae augue consectetur a gravida nunc vehicula. Donec auctor
odio non est accumsan facilisis. Aliquam id turpis in dolor tincidunt mollis ac eu diam.

##### Blue

```markdown
>>>>> Sed adipiscing elit vitae augue consectetur a gravida nunc vehicula. Donec auctor
odio non est accumsan facilisis. Aliquam id turpis in dolor tincidunt mollis ac eu diam.
```

Renders to:

>>>>> Sed adipiscing elit vitae augue consectetur a gravida nunc vehicula. Donec auctor
odio non est accumsan facilisis. Aliquam id turpis in dolor tincidunt mollis ac eu diam.

##### Green

```markdown
>>>>>> Sed adipiscing elit vitae augue consectetur a gravida nunc vehicula. Donec auctor
odio non est accumsan facilisis. Aliquam id turpis in dolor tincidunt mollis ac eu diam.
```

Renders to:

>>>>>> Sed adipiscing elit vitae augue consectetur a gravida nunc vehicula. Donec auctor
odio non est accumsan facilisis. Aliquam id turpis in dolor tincidunt mollis ac eu diam.

<br>
<br>
<br>


#### Lists

##### Unordered
A list of items in which the order of the items does not explicitly matter.

You may use any of the following symbols to denote bullets for each list item:

```markdown
* valid bullet
- valid bullet
+ valid bullet
```

For example

```markdown
+ Lorem ipsum dolor sit amet
+ Consectetur adipiscing elit
+ Integer molestie lorem at massa
+ Facilisis in pretium nisl aliquet
+ Nulla volutpat aliquam velit
  - Phasellus iaculis neque
  - Purus sodales ultricies
  - Vestibulum laoreet porttitor sem
  - Ac tristique libero volutpat at
+ Faucibus porta lacus fringilla vel
+ Aenean sit amet erat nunc
+ Eget porttitor lorem
```
Renders to:

+ Lorem ipsum dolor sit amet
+ Consectetur adipiscing elit
+ Integer molestie lorem at massa
+ Facilisis in pretium nisl aliquet
+ Nulla volutpat aliquam velit
  - Phasellus iaculis neque
  - Purus sodales ultricies
  - Vestibulum laoreet porttitor sem
  - Ac tristique libero volutpat at
+ Faucibus porta lacus fringilla vel
+ Aenean sit amet erat nunc
+ Eget porttitor lorem

And this HTML

```html
<ul>
  <li>Lorem ipsum dolor sit amet</li>
  <li>Consectetur adipiscing elit</li>
  <li>Integer molestie lorem at massa</li>
  <li>Facilisis in pretium nisl aliquet</li>
  <li>Nulla volutpat aliquam velit
    <ul>
      <li>Phasellus iaculis neque</li>
      <li>Purus sodales ultricies</li>
      <li>Vestibulum laoreet porttitor sem</li>
      <li>Ac tristique libero volutpat at</li>
    </ul>
  </li>
  <li>Faucibus porta lacus fringilla vel</li>
  <li>Aenean sit amet erat nunc</li>
  <li>Eget porttitor lorem</li>
</ul>
```

##### Ordered

A list of items in which the order of items does explicitly matter.

```markdown
1. Lorem ipsum dolor sit amet
2. Consectetur adipiscing elit
3. Integer molestie lorem at massa
4. Facilisis in pretium nisl aliquet
5. Nulla volutpat aliquam velit
6. Faucibus porta lacus fringilla vel
7. Aenean sit amet erat nunc
8. Eget porttitor lorem
```
Renders to:

1. Lorem ipsum dolor sit amet
2. Consectetur adipiscing elit
3. Integer molestie lorem at massa
4. Facilisis in pretium nisl aliquet
5. Nulla volutpat aliquam velit
6. Faucibus porta lacus fringilla vel
7. Aenean sit amet erat nunc
8. Eget porttitor lorem

And this HTML:

```html
<ol>
  <li>Lorem ipsum dolor sit amet</li>
  <li>Consectetur adipiscing elit</li>
  <li>Integer molestie lorem at massa</li>
  <li>Facilisis in pretium nisl aliquet</li>
  <li>Nulla volutpat aliquam velit</li>
  <li>Faucibus porta lacus fringilla vel</li>
  <li>Aenean sit amet erat nunc</li>
  <li>Eget porttitor lorem</li>
</ol>
```

**TIP**: If you just use `1.` for each number, Markdown will automatically number each item. For example:

```markdown
1. Lorem ipsum dolor sit amet
1. Consectetur adipiscing elit
1. Integer molestie lorem at massa
1. Facilisis in pretium nisl aliquet
1. Nulla volutpat aliquam velit
1. Faucibus porta lacus fringilla vel
1. Aenean sit amet erat nunc
1. Eget porttitor lorem
```

Renders to:

1. Lorem ipsum dolor sit amet
2. Consectetur adipiscing elit
3. Integer molestie lorem at massa
4. Facilisis in pretium nisl aliquet
5. Nulla volutpat aliquam velit
6. Faucibus porta lacus fringilla vel
7. Aenean sit amet erat nunc
8. Eget porttitor lorem


<br>
<br>
<br>


#### Code

##### Inline code
Wrap inline snippets of code with `` ` ``.

```markdown
In this example, `<section></section>` should be wrapped as **code**.
```

Renders to:

In this example, `<section></section>` should be wrapped with **code**.

HTML:

```html
<p>In this example, <code>&lt;section&gt;&lt;/section&gt;</code> should be wrapped with <strong>code</strong>.</p>
```

##### Indented code

Or indent several lines of code by at least four spaces, as in:

<pre>
  // Some comments
  line 1 of code
  line 2 of code
  line 3 of code
</pre>

Renders to:

    // Some comments
    line 1 of code
    line 2 of code
    line 3 of code

HTML:

```html
<pre>
  <code>
    // Some comments
    line 1 of code
    line 2 of code
    line 3 of code
  </code>
</pre>
```


##### Block code "fences"

Use "fences"  ```` ``` ```` to block in multiple lines of code.

<pre>
``` markup
Sample text here...
```
</pre>


```
Sample text here...
```

HTML:

```html
<pre>
  <code>Sample text here...</code>
</pre>
```

##### Syntax highlighting

GFM, or "GitHub Flavored Markdown" also supports syntax highlighting. To activate it, simply add the file extension of the language you want to use directly after the first code "fence", ` ```js `, and syntax highlighting will automatically be applied in the rendered HTML. For example, to apply syntax highlighting to JavaScript code:

<pre>
```js
grunt.initConfig({
  assemble: {
    options: {
      assets: 'docs/assets',
      data: 'src/data/*.{json,yml}',
      helpers: 'src/custom-helpers.js',
      partials: ['src/partials/**/*.{hbs,md}']
    },
    pages: {
      options: {
        layout: 'default.hbs'
      },
      files: {
        './': ['src/templates/pages/index.hbs']
      }
    }
  }
};
```
</pre>

Renders to:

```js
grunt.initConfig({
  assemble: {
    options: {
      assets: 'docs/assets',
      data: 'src/data/*.{json,yml}',
      helpers: 'src/custom-helpers.js',
      partials: ['src/partials/**/*.{hbs,md}']
    },
    pages: {
      options: {
        layout: 'default.hbs'
      },
      files: {
        './': ['src/templates/pages/index.hbs']
      }
    }
  }
};
```

<br>
<br>
<br>



#### Tables
Tables are created by adding pipes as dividers between each cell, and by adding a line of dashes (also separated by bars) beneath the header. Note that the pipes do not need to be vertically aligned.


```markdown
| Option | Description |
| ------ | ----------- |
| data   | path to data files to supply the data that will be passed into templates. |
| engine | engine to be used for processing templates. Handlebars is the default. |
| ext    | extension to be used for dest files. |
```

Renders to:

| Option | Description |
| ------ | ----------- |
| data   | path to data files to supply the data that will be passed into templates. |
| engine | engine to be used for processing templates. Handlebars is the default. |
| ext    | extension to be used for dest files. |

And this HTML:

```html
<table>
  <tr>
    <th>Option</th>
    <th>Description</th>
  </tr>
  <tr>
    <td>data</td>
    <td>path to data files to supply the data that will be passed into templates.</td>
  </tr>
  <tr>
    <td>engine</td>
    <td>engine to be used for processing templates. Handlebars is the default.</td>
  </tr>
  <tr>
    <td>ext</td>
    <td>extension to be used for dest files.</td>
  </tr>
</table>
```

##### Right aligned text

Adding a colon on the right side of the dashes below any heading will right align text for that column.

```markdown
| Option | Description |
| ------:| -----------:|
| data   | path to data files to supply the data that will be passed into templates. |
| engine | engine to be used for processing templates. Handlebars is the default. |
| ext    | extension to be used for dest files. |
```

| Option | Description |
| ------:| -----------:|
| data   | path to data files to supply the data that will be passed into templates. |
| engine | engine to be used for processing templates. Handlebars is the default. |
| ext    | extension to be used for dest files. |


<br>
<br>
<br>


#### Links

##### Basic link

```markdown
[Assemble](http://assemble.io)
```

Renders to (hover over the link, there is no tooltip):

[Assemble](http://assemble.io)

HTML:

```html
<a href="http://assemble.io">Assemble</a>
```
>>> Please see later resources on using link macros, which is how we use links in the documentation.

##### Add a title

```markdown
[Upstage](https://github.com/upstage/ "Visit Upstage!")
```

Renders to (hover over the link, there should be a tooltip):

[Upstage](https://github.com/upstage/ "Visit Upstage!")

HTML:

```html
<a href="https://github.com/upstage/" title="Visit Upstage!">Upstage</a>
```

##### Named Anchors

Named anchors enable you to jump to the specified anchor point on the same page. For example, each of these chapters:

```markdown
# Table of Contents
  * [Chapter 1](#chapter-1)
  * [Chapter 2](#chapter-2)
  * [Chapter 3](#chapter-3)
```
will jump to these sections:

```markdown
## Chapter 1 <a id="chapter-1"></a>
Content for chapter one.

## Chapter 2 <a id="chapter-2"></a>
Content for chapter one.

## Chapter 3 <a id="chapter-3"></a>
Content for chapter one.
```
**NOTE** that specific placement of the anchor tag seems to be arbitrary. They are placed inline here since it seems to be unobtrusive, and it works.


<br>
<br>
<br>


#### Images
Images have a similar syntax to links but include a preceding exclamation point. They must always have alternative text.

```markdown
![Minion](http://octodex.github.com/images/minion.png)
```
![Minion](http://octodex.github.com/images/minion.png)

or
```markdown
![Alt text](http://octodex.github.com/images/stormtroopocat.jpg "The Stormtroopocat")
```
![Alt text](http://octodex.github.com/images/stormtroopocat.jpg "The Stormtroopocat")

Like links, Images also have a footnote style syntax

```markdown
![Alt text][id]
```
![Alt text][id]

With a reference later in the document defining the URL location:

[id]: http://octodex.github.com/images/dojocat.jpg  "The Dojocat"


    [id]: http://octodex.github.com/images/dojocat.jpg  "The Dojocat"


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

These will link to [`plugins/plugin-resources/testing-integrations`][testing] on the documentation website created from the [_`/pages/12.Plugins/00.General%20Resources/01.Integration%20test/docs.en.md`_][testing] source file.

```markdown
[testing]: <plugins/plugin-resources/testing-integrations>

```

#### Heading anchors

Heading anchors enable linking directly to a Markdown heading from within the same document very easily.  The anchors are auto-generated for all headings.
The link target is specified inline.

```markdown
You can have different anchors in your text, for example to this [Section][#anchor-section] right here.

### Images

Images should be placed in the msame folder as the markdown file for the page, and should be appropriately named according to what they represent.

Link format:

```markdown
![alternative text here](image-reference.png "Tooltip text here")
```

#### Relative image links

To display an image already in the documentation repository, use a relative path.

```markdown
![form rebuild cache](rebuild.png "Rebuild form cache"")
```

#### Absolute image links

For images that cannot be uploaded via the GitHub web interface, upload them to a public URL service and use the generated link.

```markdown
![apple](http://example.com/images/apple.png "Like this delicious apple")
```

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

- Prefer the `https://` protocol in documentation.

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

