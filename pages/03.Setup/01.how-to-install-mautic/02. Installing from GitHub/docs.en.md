---
title: 'Installing from GitHub'
taxonomy:
category:
- docs
slug: install-mautic-from-github
twitterenable: true
twittercardoptions: summary
articleenabled: false
orgaenabled: false
orga:
ratingValue: 2.5
orgaratingenabled: false
personenabled: false
facebookenable: true
googledesc: 'How to install Mautic by cloning from GitHub.'
twitterdescription: 'How to install Mautic by cloning from GitHub.'
facebookdesc: 'How to install Mautic by cloning from GitHub.'
---
## Cloning Mautic from GitHub

When working with Mautic in a testing environment, or contributing to Mautic, it is important to have all the files locally from the GitHub repository, many of which are excluded in the production build process.

It is recommended that you consider installing the [GitHub CLI tool][github-cli], as it makes the process much simpler.

### Create a personal fork

Before you start working with Mautic, you must create a personal fork of Mautic. This functions as a parallel copy of the Mautic codebase where you can create working areas - known as branches - and then make a Pull Request to have your changes merged into the main Mautic repository.

To make a personal fork, click on 'Fork' at the top right of the page on the Mautic GitHub repository.

If you already have a fork, you can click to go there directly. If you don't you will see an option to create a fork. 

>>>>> Please always choose to fork into a **personal account** rather than an organization. The latter prevents Mautic's maintainers from working with your Pull Request.

### Clone your personal fork

Once the fork is created, click on the green 'code' button to access the command for cloning the repository. Using the GitHub CLI this will be in the format:

    gh repo clone username/mautic

Switch to your terminal, and when in the directory where you wish to install Mautic, paste the command.

### Install Mautic

#### Using DDEV

If you use [DDEV][ddev] - recommended for testing and development with Mautic - you can now change into the mautic directory and kick off the DDEV quickstart using the command:

    ddev start

This will spin up a DDEV instance - by default at https://mautic.ddev.site - and will also give the option to set up Mautic ready for you to install. This runs through the composer install process, and installs Mautic at the command line with a default username of `admin` and password of `mautic`.

#### Using a localhost environment

If you prefer not to use DDEV, the configuration steps are as follows:

1. Run `composer install` to install the required dependencies
2. Complete the installation process either in the web interface, or at the command line - see [Installing Mautic][installing-mautic].

[github-cli]: <https://cli.github.com>
[ddev]: <https://ddev.readthedocs.io/en/stable/>
[installing-mautic]: </setup/how-to-install-mautic>