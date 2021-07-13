---
title: 'Style Guide'
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
The Mautic Style guide recommends best practices that aims to bring about a consistent style, voice, and tone across the documentation. Though we recommend following the [Google developer documentation style guide][Google-style-guide], here are a few Mautic-specific best practices to follow: 

  - [Capitalization](#capitalization)
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
  - [Videos](#videos)
  - [Guide to available markdown styles](#markdown-styles) 

### Capitalization
 - Always capitalize all instances of **Mautic**.
 - Capitalize the first letter of all the official Mautic terms, such as, Contact, Component, Form, Campaign, Email, Points, Stages, etc.  

### Whitespace and spaces

- One blank line around headings
- One blank line around list items
- One blank line around code blocks
- One final blank line

- One space after a full stop. Next sentence.

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

<details><summary>example code block</summary>

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

<details><summary>example nested code block</summary>

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

Often you'll want to make a link to another place in the documentation. We prefer to group links at the bottom of a page, and provide a reference macro in the text.
This make linking to the same place much easier. In Markdown, it looks like this:

#### Absolute links

You can have different links in your text, some leading [here][link macro] and others leading [there][link macro].

```markdown
You can have different links in your text, some leading [here][link macro] and others leading [there][link macro].

[link macro]: <http://example.com>
```

#### Relative links

These will link to [`/plugins/plugin-resources/testing-integrations`][testing] on the documentation website created from the [_`pages/13.Plugins/00.General%20Resources/01.Integration%20test/docs.en.md`_][testing] source file. These should still use a link macro as with absolute links.


```markdown
[testing]: </plugins/plugin-resources/testing-integrations>

```

#### Heading anchors

Heading anchors enable linking directly to a Markdown heading from within the same document very easily. The anchors are auto-generated for all headings.
The link target is specified inline.

```markdown
You can have different anchors in your text, for example to this [Section][#anchor-section] right here.
```

### Images

Images should be placed in the same folder as the page they are used on. The image should be added to Git as a file to be included in the repository, not uploaded to GitHub and hosted by GitHub.

To link to an image in your repository, use the following format:

```markdown
![alternative text here](image-reference.png "Tooltip text here")
```

### Videos
You can embed a YouTube video using the following syntax:
    `[plugin:youtube](https://www.youtube.com/watch?v=<videoid>)`

### Markdown styles

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

    

[Google-style-guide]: <https://developers.google.com/style>