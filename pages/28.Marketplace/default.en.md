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

*Mautic 4 comes with new Marketplace. In the initial release there is just plugin browser. The install an update features will be added in the future feature releases as it depends on the new Composer v2 support and new file structure.*

**Warning**

*The first marketplace version does not check for Mautic version compatibility yet as it requires change in each existing plugin, so please do not blindly manually install plugins you see there. Always check youself if they support your Mautic version.*

### List of plugins

The list of plugins is accessible from your Mautic administration menu. Click the cog icon in the top right hand corner to display the admin menu.

The list view allows you to search for specific keywords. It displays quick stats of how many times a plugin was downloaded and how many stars it has in [Packagist](https://packagist.org). It also shows the vendor who has developed the plugin. Sadly, the sorting by columns is not available at the moment because it's not supported by the Packagist API.

Click a plugin name to view details.

![Marketplace list](marketplace-list.png)

### Plugin detail page

The detail page gives you enough information together with links to additional resources to decide whether you want to install the plugin or not.

#### Latest Stable Version

The first information you see is what is the latest stable version. *In the future you will also see what version is currently installed if any and will allow you to upgrade.*

All plugins should follow [semantic versioning](https://semver.org) so you can see from the first glance whether it is a breaking change version, feature version or bug fix (patch) version. In short, it is more risky to install fresh breaking change version and less risky to install a bug fix version.

The license should be GPL v3 mostly as Mautic is released under GPL v3 which is a viral license. Which means whatever is using Mautic's code base should also be released under the same license.

Required packages are dependencies. The bigger is the list of dependencies the bigger will be the size of the plugin. More dependencies also means more security risks and incompatibility issues with future upgrades.

#### All Versions

The next table shows the list of all versions. *In the future versions of the marketplace it should be possible to select which version you want to install or upgrade to.*

From the list you can see how many times the plugin has been released and what is the release cadence. When you click on a specific version it will open a new window where the plugin maintainers should write change log. Meaning what has been added or which bugs were fixed in the specific version.

#### Maintainers

In this section is a list of maintainers of the plugin on Packagist. There may be more contributors in the GitHub repository. There is also a link to the maintainer's Packagist detail page where you can browse other PHP packages of the same author.

#### GitHub Info

[GitHub](https://github.com) is a social network for developers. The majority of Mautic plugins is available on GitHub. There are some quick stats available directly in this section but you can find much more if you follow the link to the repository.

#### Packagist Info

[Packagist](https://packagist.org) is a PHP package repository. It's not related specifically to the Mautic community but to PHP community. All the PHP packages listed in Packagist are installable by [Composer](https://getcomposer.org) which is a tool for dependency management which is used under the hood when you install a Mautic plugin. Packagist section shows download stats of how many the plugin has been installed in different timeframes.

#### Context menu

The context menu shows actions you can take.
- Close will take you to the List View
- Install will install the plugin
- Issue Tracker will open a new window with the issue tracker. It will show up only if the plugin has this information available. Use this option to search for issues with the pluin and report new ones.

![Marketplace detail](marketplace-detail.png)

### Planned Features

The Marketplace is lacking some important features. In the text above there are mentions of several planned features in cursiva. Most of the features are waiting for Mautic 4 release and it's main features (Composer v2 support, new directory structure) and therefore can be developed when all these features will come together.

- Mautic version compatibility check. The Marketplace should tell you whether a plugin is compatible with your Mautic installation.
- Installation via CLI and UI. 
- Update of installed plugins.
- Automatic plugin updates. There will be configuration that will allow you to set globally whether you want to automatically upgrade plugins and also posibility to set that on per plugin bases. Automatic upgrades make sense only for bug fix releases. Other releases are too risky and should be handled manually. [API reference](https://packagist.org/apidoc#track-package-updates)
- List security advisories. [API reference](https://packagist.org/apidoc#list-security-advisories)
- Notifications about new versions and found security vulnerabilities.
- Support also theme installations and updates.