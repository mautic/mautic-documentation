# Core Service Manager Plugin

The **Core Service Manager** Plugin is for [Grav CMS](http://github.com/getgrav/grav). It adds a service manager layer to the Grav API.  This plugin provides no end-user features on its own.  It extends the Grav core with services and features to be used by other plugins.

## Installation
Installing the Core Service Manager plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

### GPM Installation (Preferred)
The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install core-service-manager

This will install the Core Service Manager plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/core-service-manager`.

### Manual Installation
To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `core-service-manager`. You can find these files on [GitHub](https://github.com/twelve-tone-llc/grav-plugin-core-service-manager) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/core-service-manager
	
> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) to operate.

## Configuration
Before configuring this plugin, you should copy the `user/plugins/core-service-manager/core-service-manager.yaml` to `user/config/plugins/core-service-manager.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
override_admin_twigs: true
```

## Usage
This plugin provides services intended to be used by other plugins.  Disable it only if no other enabled plugins require it.  See the [official documentation](https://www.twelvetone.tv/docs/developer-tools/grav-plugins/grav-core-service-manager) for usage details. 

## To Do
[ ] Service reference counts
[ ] Require scope to be a property
