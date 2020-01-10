# grava11y

An accessibility testing plugin for your Grav theme

# Installation

Installing the Grava11y plugin can be done in one of two ways. Our GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

## GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's Terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install grava11y

This will install the Grava11y plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/grava11y`.

## Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `grava11y`. You can find these files either on [GitHub](https://github.com/getgrav/grav-plugin-error) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/grava11y

>> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav), and a theme to be installed in order to operate.

# Usage

The `grava11y` plugin doesn't require any configuration. The moment you install it, it is ready to use. It does allow you to switch between a local copy & Github edition of the accessibility toolkit.

### Used Libs:
- http://github.com/Khan/tota11y
