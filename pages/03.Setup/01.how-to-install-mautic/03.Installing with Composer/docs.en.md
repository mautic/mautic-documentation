---
title: 'Installing with Composer'
taxonomy:
category:
- docs
slug: install-and-manage-mautic-with-composer
twitterenable: true
twittercardoptions: summary
articleenabled: false
orgaenabled: false
orga:
ratingValue: 2.5
orgaratingenabled: false
personenabled: false
facebookenable: true
googledesc: 'How to install Mautic with Composer.'
twitterdescription: 'How to install Mautic with Composer.'
facebookdesc: 'How to install Mautic with Composer.'
---
## Installing Mautic with Composer

Since [Mautic 4.0][mautic-4], it's possible to install and manage Mautic using the full power of Composer, including support for Composer 2.

Mautic is in the process of decoupling plugins and themes from core, however at present while they have been technically mirrored out into separate repositories, the source files remain in [Mautic core][mautic-core]. 

As with a regular clone from GitHub, running `composer install` installs all the dependencies, there are some other handy features which you can take advantage of when installing and managing Mautic.

### Using the Recommended Project

The Mautic Recommended Project is a template which provides a starter kit for managing your Mautic dependencies with Composer.

>>>>> The instructions below refer to the global composer installation. You might need to replace composer with `php composer.phar` or similar for your setup.

The basic command to use the Recommended Project is:
    
    composer create-project mautic/recommended-project:^4 some-dir --no-interaction

With composer require you can download new dependencies to your installation.

    cd some-dir
    composer require mautic/mautic-saelos-bundle:~2.0

The composer create-project command passes ownership of all files to the created project. You should create a new git repository, and commit all files not excluded by the .gitignore file.

#### What does the Recommended Project template actually do?

When installing the given composer.json the following occurs:

* Install Mautic in the public-directory.
* Autoloader uses the generated composer autoloader in vendor/autoload.php, instead of the one provided by Mautic in public/vendor/autoload.php.
* Plugins - packages of type mautic-plugin - are in public/plugins/.
* Themes - packages of type mautic-theme - are in public/themes/.
* Creates public/media directory.
* Creates environment variables based on your .env file. See .env.example.

#### Updating Mautic Core

The Recommended Project attempts to keep all of your Mautic Core files up-to-date.

The project `mautic/core-composer-scaffold` updates your scaffold files whenever there is an update to `mautic/core-lib`. 

If you customize any of the "scaffolding" files - commonly .htaccess - you may need to merge conflicts if new release of Mautic Core result in changes to your modified files.

Follow the steps below to update your core files.

1. Run `composer update mautic/core-lib --with-dependencies` to update Mautic Core and its dependencies.
2. Run `git diff` in the folder  to determine if any of the scaffolding files have changed. Review the files for any changes and restore any customizations to .htaccess or others.
3. Commit everything all together in a single commit, so the public remains in sync with the core when checking out branches or running git bisect.
4. In the event that there are non-trivial conflicts in step 2, you may wish to perform these steps on a branch, and use git merge to combine the updated core files with your customized files. This facilitates the use of a three-way merge tool such as [kdiff3][kdiff3]. This setup isn't necessary if your changes are simple; keeping all of your modifications at the beginning or end of the file is a good strategy to keep merges easy.
5. Run the following commands to update your database with any changes from the release:

`bin/console cache:clear`
`bin/console mautic:update:apply --finish`
`bin/console doctrine:migration:migrate --no-interaction`
`bin/console cache:clear`

#### Enabling the Mautic Marketplace
Once you have installed using Composer, log into Mautic, and in your global settings, enable the switch to fully manage Mautic with Composer - this will also enable you to work with the Mautic Marketplace.

![Screenshot showing the switch to enable composer management](switch-enable-composer.png)
### Composer FAQs

#### Should you commit downloaded third party plugins?
Composer recommends no. They provide [arguments against but also workarounds if a project decides to do it anyway][composer-workarounds].

#### Should you commit the scaffolding files?
The [Mautic Composer Scaffold][scaffold-plugin] plugin can download the scaffold files - for example index.php, .htaccess - to the public/ directory of your project. 

If you haven't customized those files you could choose to not commit them in your version control system - for example, git. If that's the case for your project it might be convenient to automatically run the Mautic Scaffold plugin after every install or update of your project. 

You can achieve that by registering `@composer mautic:scaffold` as post-install and post-update command in your composer.json:

```json
"scripts": {
    "post-install-cmd": [
        "@composer mautic:scaffold",
        "..."
    ],
    "post-update-cmd": [
        "@composer mautic:scaffold",
        "..."
    ]
},
```

#### How can you apply patches to downloaded plugins?
If you need to apply patches - depending on the plugin, a pull request is often a better solution - you can do so with the composer-patches plugin.

To add a patch to Mautic plugin foobar insert the patches section in the extra section of composer.json:

```json
"extra": {
    "patches": {
        "mautic/foobar": {
            "Patch description": "URL or local path to patch"
        }
    }
}
```

#### How can you specify a PHP version?
This project supports PHP 7.4 as the minimum version, however, it's possible that a composer update may upgrade some package that could then require PHP 7+ or 8+.

To prevent this you can add this code to specify the PHP version you want to use in the config section of composer.json:
```json
"config": {
    "sort-packages": true,
    "platform": {
        "php": "7.4"
    }
},
```


[mautic-4]: <https://github.com/mautic/mautic/releases/tag/4.0>
[mautic-core]: <https://github.com/mautic/mautic>
[kdiff3]: <http://www.gitshah.com/2010/12/how-to-setup-kdiff-as-diff-tool-for-git.html>
[composer-workarounds]: <https://getcomposer.org/doc/faqs/should-i-commit-the-dependencies-in-my-vendor-directory.md>
[scaffold-plugin]: <https://github.com/mautic/core-composer-scaffold>
