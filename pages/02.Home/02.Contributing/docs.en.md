---
title: 'Contributing to the Mautic documentation'
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
Mautic is an open-source marketing automation platform. We welcome contributions to improve and maintain our documentation. 

Mautic is made up of over 39 Git repositories. To contribute to the Mautic user guide, you must fork the [Mautic user documentation Git repository.][mautic-docs-github] Contributions to the Mautic developer documentation can also be made by forking the [Mautic developer documentation Git repository.][developer-docs-github] 



<!-- ## Table of Contents -->

<!--
Use this site to generate the TOC list elements:

- https://ecotrust-canada.github.io/markdown-toc/

remove the first two lines
-->

- [Get Started](#get-started)
- [Report Issues and Fix Bugs](#report-issues-and-fix-bugs)
- [Documentation Repository Structure](#documentation-repository-structure)
- [Style guide](#style-guide)
- [How to contribute](#how-to-contribute)
  * [Using Grav](#using-grav)
  * [Using GitHub](#using-github)
    + [Editing documentation using the command-line](#editing-documentation-using-the-command-line)
    + [Editing documents in the GitHub browser interface](#editing-documents-in-the-github-browser-interface)
- [Mautic specific information](#mautic-specific-information)
  * [Example domain references](#example-domain-references)
    + [Protocol scheme: http vs https](#protocol-scheme--http-vs-https)
  * [Linking to Release versions](#linking-to-release-versions)
    + [`latest` version](#-latest--version)
  * [References to _leads_ and _lead lists_](#references-to--leads--and--lead-lists-)
      - [reference note](#reference-note)


## Getting Started
 GitHub and Grav can be used for contributions to the Mautic documentation, but we'd prefer GitHub for the following reasons:

- *Versions* - Previous versions can be easily restored or viewed.
- *Authorship* - Each file and line has its author.
- *Community contributions* - Collaborate on a document without deleting other contributors' work.

While working with GitHub requires some knowledge of Git to clone, modify, commit, and push changes, you can choose to edit the files directly in GravCMS web interface. 

For more information on how to contribute using GitHub, refer to the [Using GitHub](#using-github) section. 
For more information on how to contribute using Grav, the refer to [Using Grav](#using-grav) section.

## Report Issues and Fix Bugs
To make changes to the current documentation, we recommend you to file an issue to reach an agreement on your proposal before putting significant effort into it. To report new issues or fix an existing issue, visit the [Mautic Documentation Issues][doc-issues] page on GitHub.

You can familiarize yourself with the Mautic contribution process by  looking at the list of **`good first issues`** that have been earmarked for new contributors. These issues have a relatively limited scope.

To own and fix a ticket, check the comment thread of the GitHub ticket to ensure that no one else is already working on it's fix. If no owners are assigned, leave a comment stating that you intend to work on it to avoid any accidental duplication of your effort.

## Understanding the Documentation Repository Structure
Mautic documentation is written using [Markdown markup][markup], a simple but flexible text formatting language. The Markdown files are appended with the *.md* extension.

The **`README.md`** file introduces and describes the repository, and does not contain any product documentation.

Available folders in the repository include:
 - The **`pages`** folder contains folders for each chapter in the Mautic user guide. Each folder contains its own **`docs.en.md`** (one per language - currently, English only) file and the different images used in the *.md* files. For example, within the **Campaigns** folder, you'll find sub-folders for sub-topics such as **Managing Campaigns**, **Campaign Events**, etc..
  - Similarly, the **`plugins`** folder contains folders for each plugin that Mautic offers.
   - The **`themes`** folder contains a folder with supporting files for an available theme available for this repository. 

## Style Guide

We encourage you to read the [Mautic Style Guide][style guide] for a consistent tone, voice, and messaging across the Mautic user documentaion. You can find our Style Guide [here][style guide].

## How to contribute
On the [Issues][doc-issues] section of the Mautic user documentaion GitHub repository, select an issue you want to work on, and leave a message for a Mautic administrator to assign it to you.

You can choose to contribute using either Gitpod or GitHub.

### Using Gitpod

For more information on how Gitpod works, watch [this](https://www.youtube.com/watch?v=D41zSHJthZI) video.

### Using GitHub Desktop

To contribute using GitHub:
1. Fork this [GitHub][mautic-docs-github] repository to add it to your profile repositories. 
1. Clone the project from your account on to your machine to have a local copy of the project. Ensure that the development environment setup is exactly as stated in the project’s readme file.
1. Launch the GitHub desktop client on your machine.
1. In the top section of the GitHub desktop client, select **mautic-documentation** as your **Current Repository**.
1. To create a new branch, select **Current Branch** to expand the window.
1. On the **Branches** tab, select **New Branch**.
1. On the **Create a Branch** window, enter a descriptive **Name** (for example, {your-username}-{issue-that-is-going-to-be-fixed}), and click **Create Branch**. 
This is your working directory.

After you have finished working on your assigned GitHub ticket, you must publish the branch for review.

To publish your edits to your local branch:

1. In the top section of the GitHub desktop client, select the **Current Repository** tab.
<br>The **Current Repository** section lists the changes you have made to your file.
1. In the bottom section of the **Current Repository** tab, enter a brief summary and a message describing the key edits you have made to your document. <br>Refer to repository guidelines.
1. Click **Commit to {branch name}**.

After pushing the edits to the local branch, to create a pull request:
1. Navigate to your GitHub account (for example, https://github.com/{username}/) on the portal.
1. Click on your profile in the upper-right corner to select **Your respositories > mautic-documentation**. <br> A notification detailing your push to your branch with a button labeled **Compare & pull request** is displayed at the top of the page.
1. Click **Compare & pull request**.
1. On the Open a pull request page, enter details about the changes you have made to the document. <br>Reference any [Issues][doc-issues] that the current pull request (PR) resolves so that they are automatically linked. For example, if the PR closes an existing issue #0001, reference it in the description as 'closes #0001'.
1. Click **Create pull request** to generate the PR link.
1. Share the pull request (PR) link at https://github.com/mautic/user-documentation.


Select a file to edit on your fork.
1. Make your commits.
1. Open a pull request to `base fork: mautic/mautic-documentation` with `base: master`.
1. Include and reference any [Issues][doc-issues] your Pull Request addresses. Be sure to write 'closes #0001' if your PR will close an existing issue, so that they are automatically linked.

### Using the Git command-line

To edit documents using the Git command-line system:

1. On the command-line window, enter `cd` to change to the location of the documentation repository.
1. Clone this repository.

    ````console
    git clone https://github.com/mautic/mautic-documentation.git --origin upstream
    ````

1. Fork this repository at [GitHub][mautic-docs-github] or use the [`hub`][hub] utility.

    ````console
    hub fork --remote-name origin
    ````

1. Once cloning has completed, open the project in the editor of your choice.
1. Create a new branch for your edits. Please name your branch something descriptive like `{yourusername}-revision-readme-file`

    ````console
    git checkout -b {yourusername}-revision-readme-file upstream/master
    ````

1. Make your changes.
1. Stage and commit your changes to your _local_ repository.

    ````console
    git status --short
    git add <new and modified files>
    git commit --message 'move contributing to new file'
    ````

1. Push to `origin`.

    ````console
    git push origin
    ````

1. Review the changes at your fork -`https://github.com/{yourusername}/mautic-documentation`.
1. Submit your pull request using one of these methods:
   - Direct link - `https://github.com/{yourusername}/mautic-documentation/pull/new/{yourusername}-revision-readme-file`
   - GitHub web interface - `base fork: mautic/mautic-documentation` and `base: master` at [GitHub][mautic-docs-github]
   - Use the [`hub`][hub] utility

    ````console
    hub pull-request
    ````

#### Editing documents in the GitHub browser interface

If you're unfamiliar with the Git command-line but still want to contribute to the Mautic documentation via GitHub, read this section.

Using *README.md* as an example:

1. [Fork][mautic-docs-fork] this repository under your account so you'll have permission to edit.
1. Select the *README.md* file . Refer to the [Mautic Documentation Repository Structure](#mautic-documentation-repository-structure) section. 
1. With the content of *README.md* visible, click on the pencil icon to begin editing the file.
1. After you've made a change, scroll down to the *Commit changes* form. Saving your change requires describing what was changed and why.
1. Before submitting your commit, select the box for *Creates a new branch* to start a new branch for your change. Name your branch something like `{yourusername}-revision-readme-file`
1. Select *Propose file change*.
1. In the next dialogue box, describe what you've changed and why then select *Create pull request* to open a pull request proposing we add your changes to our official repository.

>**Note**: If you are updating more than one file,  then you can select the newly created branch to switch to the branch, and then repeat this process until you have made all the required edits, before creating a pull request.

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

Avoid using the term _**`current`**_ or _**`latest`**_ if you actually mean _"the currently released version of Mautic that I installed."

In most cases, it has no meaning when a new version is released. Instead, check the [latest release][release-latest] and explicitly use that version number.

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
[mautic-github]: <https://github.com/mautic/mautic>
[mautic-docs-slack]: <https://mautic.slack.com/archives/C02HV781U>
[mautic-slack-invite]: <https://mautic.org/slack>

[semver]: <https://semver.org/spec/v2.0.0.html>
[gitbook]: <https://www.gitbook.com/>
[markup]: <https://help.github.com/en/github/writing-on-github/basic-writing-and-formatting-syntax>
[hub]: <https://github.com/github/hub/releases>
[linguistic]: <https://github.com/github/linguist>
[style guide]: </contributing/style-guide>
