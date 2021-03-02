# Simple Cookie Plugin

The **Simple Cookie** Plugin is an extension for [Grav CMS](http://github.com/getgrav/grav). The plugin is based on the popular **[CookieConsent](https://cookieconsent.osano.com/) JS-library**. For Advanced Opt-In/Opt-Out configurations you can use the 'Custom configuration' option.

## Installation

Installing the **Simple Cookie** plugin can be done in one of three ways: The GPM (Grav Package Manager) installation method lets you quickly install the plugin with a simple terminal command, the manual method lets you do so via a zip file, and the admin method lets you do so via the Admin Plugin.

### GPM Installation (Preferred)

To install the plugin via the [GPM](http://learn.getgrav.org/advanced/grav-gpm), through your system's terminal (also called the command line), navigate to the root of your Grav-installation, and enter:

    bin/gpm install simple-cookie

This will install the Simple Cookie plugin into your `/user/plugins`-directory within Grav. Its files can be found under `/your/site/grav/user/plugins/simple-cookie`.

### Manual Installation

To install the plugin manually, download the zip-version of this repository and unzip it under `/your/site/grav/user/plugins`. Then rename the folder to `simple-cookie`. You can find these files on [GitHub](https://github.com/tomschwarz/grav-plugin-simple-cookie) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/simple-cookie


### Admin Plugin

If you use the Admin Plugin, you can install the plugin directly by browsing the `Plugins`-menu and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/simple-cookie/simple-cookie.yaml` to `user/config/plugins/simple-cookie.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
custom: false
position: bottom-right
compliance: info
palette: gray
```

Note that if you use the Admin Plugin, a file with your configuration named simple-cookie.yaml will be saved in the `user/config/plugins/`-folder once the configuration is saved in the Admin.

## Advanced configuration

You have the following options to customize texts, colors, styles positions and advanced configurations for Opt-In/Opt-Out:

```yaml
# Indicates where the cookie banner is placed on the website.
# - bottom: Banner is on the bottom of the page, full width
# - top: Banner is on the top of the page, full width
# - bottom-left: Banner is floating on the left side, auto width
# - bottom-right (default): Banner is floating on the right side, auto width
position: bottom-right

# Indicates which mode the popup should have.
# - info: Standard mode of the banner, show's only one button
# - opt-in: Opt-In mode, shows two buttons (you have to use some custom configurations for opt-in)
# - opt-out: Opt-Out mode, shows two buttons (you have to use some custom configurations for opt-out)
compliance: info

# Indicates which style the cookie banner has.
# - block: Got a block style, filled button and no border radius
# - classic: Filled and wide button with a border radius
# - edgeless (default): Button got no spacing to the box
layout: edgeless

# Standard themes for the cookie banner.
# - black: Black and yellow
# - white: White and turquoise
# - gray (default): Gray and blue
palette: gray

# The Link with more informations to the usage of cookies.
informations: 'https://cookiesandyou.'

# The Message on the cookie banner.
banner_message: ''

# The text on the dismiss button.
banner_dismiss: ''

# The text on the accept button.
banner_accept: ''

# The text for the policy link.
banner_policy: ''

# Enable/Disable the custom configuration.
# - Should be used for advanced Opt-In/Opt-Out configurations.
# - If enabled, the custom config will be merged with the default options.
custom: false

# Insert custom code for the cookieconsent plugin.
# - Can be used for advanced Opt-In/Opt-Out configurations.
# - Depends on the default config 'custom'.
custom_config: ''
```


## Credits

The plugin is based on the [CookieConsent](https://cookieconsent.osano.com/) JS-libary which is developed by [Osano](https://www.osano.com/).

## Contributing

If you want to contribute create an issue or an pull request.  
I appreciate every single help!

## Other

If you got some problems, improvements or changes let me know.  
