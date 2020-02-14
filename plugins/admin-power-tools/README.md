# Admin Power Tools Plugin

The **Admin Power Tools** Plugin is for [Grav CMS](http://github.com/getgrav/grav). Power tools for the Admin plugin including _Edit This Section_, _Add Page_ enhancements, _Reorder Child Pages_, and _Reports_.

## Installation

Installing the Admin Power Tools plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install admin-power-tools

This will install the Admin Power Tools plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/admin-power-tools`.

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `admin-power-tools`. You can find these files on [GitHub](https://github.com/twelve-tone-llc/grav-plugin-admin-power-tools) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/admin-power-tools
	
> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) to operate.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/admin-power-tools/admin-power-tools.yaml` to `user/config/plugins/admin-power-tools.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
```

## Usage

Set [Official Documentation](https://www.twelvetone.tv/docs/developer-tools/grav-plugins/grav-admin-power-tools)

## To Do

- [ ] Use webpack for external dependencies
- [ ] Security for API endpoints

