---
title: 'Marketplace'
slug: marketplace
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

*Mautic 4.0 comes with new Marketplace. The initial release provided a read-only interface. In [Mautic 4.2][mautic-4.2], The features to install and update plugins is available for Mautic installations using Composer. Read more in [this article][mautic-marketplace-blog].*

**Warning**

*The first Marketplace version doesn't verify Mautic version compatibility yet, as this requires a change in each existing plugin.

Please don't blindly manually install plugins you see there as they may not work with your version of Mautic. Always verify if they support your Mautic version before installing. Developers can refer to the [Developer Documentation][dev-docs] for how to make your plugin compatible with the Mautic Marketplace.*

## Enabling the Mautic Marketplace
 From Mautic 4.2, a setting in the Mautic Configuration specifies that the instance uses Composer, which allows the installation, update, and removal of plugins in the Mautic Marketplace. This is a requirement due to the technology which underpins the Mautic Marketplace.

 ![Enable Mautic Marketplace](switch-enable-composer.png)

 Once configured, you can search the marketplace using the filter, and install plugins by selecting the option from the dropdown.

  ![Composer Enabled](composer-enabled.png)

If you haven’t correctly set the Composer setting, Mautic displays a warning that the Mautic Marketplace is available in read-only mode, with a link which explains how to transition to a [Composer-managed installation][switch-to-composer].

  ![Need to enable Composer](need-to-enable-composer.png)

### List of plugins

The list of Plugins available in the Marketplace is accessible from your Mautic administration menu. Click the cog icon in the top right hand corner to display the menu.

The list view allows you to search for specific keywords. It displays quick stats including Plugin downloads and how many stars it has in [Packagist][packagist]. It also shows the vendor who has developed the plugin. Sadly, the sorting by columns isn't available at the moment because it's not supported by the Packagist API. It's planned to add this in a future release.

Click a Plugin name to view details.

![Marketplace list](marketplace-list.png)

### Plugin detail page

The detail page gives you enough information together with links to additional resources to decide whether you want to install the Plugin or not.

#### Latest stable version

The first information you see is the latest stable version. *From Mautic 4.2, this includes the currently installed (if any) version and the ability to upgrade.*

All Plugins should follow [semantic versioning][semver] so you can see from the first glance whether it's a breaking change version, feature version or bug fix (patch) version. In short, it's more risky to install breaking change versions and less risky to install a bug fix version.

The license should be GPLv3 mostly as Mautic uses this license, and it's a viral license. This means anything using Mautic's code base should also use the same license.

Required packages are dependencies. The bigger is the list of dependencies, the bigger the size of the Plugin. More dependencies also means more security risks and incompatibility issues with future upgrades.

#### All versions

The next table shows the list of all versions. *In the future versions of the Marketplace it should be possible to select which version you want to install or upgrade to.*

From the list you can see Plugin versions, and the release cadence. When you click a specific version, a new window opens where the Plugin maintainers should provide a changelog. This tells you what's added or bugs fixed in the specific version.

#### Maintainers

In this section is a list of maintainers of the Plugin on Packagist. There may be more contributors in the GitHub repository. There is also a link to the maintainer's Packagist detail page where you can browse other PHP packages by the same maintainer.

#### GitHub information

[GitHub][github] is where many developers host their code. The majority of Mautic Plugins are available on GitHub. There are some stats available directly in this section, but you can find much more if you follow the link to the repository.

#### Packagist information

[Packagist][packagist] is a PHP package repository. It's not related specifically to the Mautic Community, but to the PHP community. 

All the PHP packages listed in Packagist are installable by [Composer][composer] which is a tool for dependency management used under the hood when you install a Mautic Plugin. The Packagist section shows download stats of Plugin installations in different time frames.

#### Context menu

The context menu shows actions you can take.
- Close takes you to the List View
- Install installs the Plugin
- Issue tracker opens a new window with the issue tracker for the Plugin. It shows only if the Plugin has this information available. Use this option to search for issues with the Plugin and to report new issues to the maintainers.

![Marketplace detail](marketplace-detail.png)

### CLI command

The Marketplace has commands for those who prefer using the command line to the user interface, or for automation of processes.

#### List Plugins

`bin/console mautic:marketplace:list` lists first page of available Plugins like so:

```
+-------------------------------------------------------+-----------+--------+
| name                                                  | downloads | favers |
+-------------------------------------------------------+-----------+--------+
| mautic/mautic-saelos-bundle                           | 11623     | 11     |
| koco/mautic-recaptcha-bundle                          | 2662      | 24     |
|     This plugin brings reCAPTCHA integration to       |           |        |
|     mautic.                                           |           |        |
| thedmsgroup/mautic-extended-field-bundle              | 3069      | 25     |
|     Extends custom fields for scalability and         |           |        |
|     HIPAA/PCI compliance.                             |           |        |
| mtcextendee/mautic-sql-conditions-bundle              | 190       | 6      |
| maatoo/mautic-referrals-bundle                        | 1063      | 5      |
|     This plugin enables referrals in mautic.          |           |        |
| thedmsgroup/mautic-health-bundle                      | 2139      | 11     |
|     Checks the health of the Mautic instance.         |           |        |
| thedmsgroup/mautic-dashboard-warm-bundle              | 1921      | 12     |
|     Improves the performance of the dashboard by      |           |        |
|     sharing/extending/warming caches.                 |           |        |
| thedmsgroup/mautic-contact-source-bundle              | 2852      | 43     |
|     Creates API endpoints for receiving contacts from |           |        |
|     external sources.                                 |           |        |
| thedmsgroup/mautic-contact-client-bundle              | 4035      | 70     |
|     Create custom integrations without writing code.  |           |        |
| thedmsgroup/mautic-campaign-watch-bundle              | 1817      | 14     |
|     Visual improvements for campaigns.                |           |        |
| raow/mautic-rss-to-email-bundle                       | 971       | 69     |
| mtcextendee/mautic-random-smtp-bundle                 | 101       | 10     |
| kuzmany/mautic-recommender-bundle                     | 250       | 30     |
| kuzmany/mautic-custom-tags-bundle                     | 119       | 20     |
| dazzle/mautic-sendinblue-bundle                       | 73        | 5      |
|     Allows to send E-mails with Sendinblue            |           |        |
+-------------------------------------------------------+-----------+--------+
Total packages: 69
Execution time: 388 ms
```

There are options allowing you to filter or go to next pages. To display the full list, add `--help` after the command, as used in other Mautic commands.

```
  -p, --page[=PAGE]      Page number [default: 1]
  -l, --limit[=LIMIT]    Packages per page [default: 15]
  -f, --filter[=FILTER]  Filter the packages [default: ""]
  -h, --help             Display this help message
```

Example usage how to search for a Captcha Plugin: `bin/console mautic:marketplace:list --filter=captcha`

### Planned features

Watch out for more features in future releases including:

- Automatic Plugin updates - a configuration that allows you to set globally whether you want to automatically upgrade Plugins and also have the possibility of configuring this at the plugin level. Automatic upgrades make sense only for bug fix releases. Other releases are too risky and manual updates required. [API reference][track-updates]
- List security advisories [API reference][advisories],
- Notifications about new versions and security vulnerabilities that identified,
- Support also theme installations and updates.

## How to get your plugin listed on the Mautic Marketplace

Please review the resources on the [Developer Documentation][dev-docs] for more information.

[mautic-4.2]: <https://github.com/mautic/mautic/releases/tag/4.2.0>
[mautic-marketplace-blog]: <https://www.mautic.org/blog/community/feature-highlight-mautic-marketplace>
[dev-docs]: <https://developer.mautic.org/#marketplace>
[packagist]: <https://packagist.org>
[semver]: <https://semver.org>
[github]: <https://github.com>
[composer]: <https://getcomposer.org>
[track-updates]: <https://packagist.org/apidoc#track-package-updates>
[advisories]: <https://packagist.org/apidoc#track-package-updates>
[switch-to-composer]: </setup/switch-to-composer>
