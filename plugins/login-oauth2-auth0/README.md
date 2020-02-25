# Login OAuth2 Auth0 Plugin

The **Login OAuth2 Auth0** Plugin is for [Grav CMS](http://github.com/getgrav/grav). OAuth2 Provider for Auth0

## Installation

Installing the Login OAuth2 Auth0 plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install login-oauth2-auth0

This will install the Login OAuth2 Auth0 plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/login-oauth2-auth0`.

Known issue with gpm installation - https://github.com/getgrav/grav/issues/2833

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `login-oauth2-auth0`. You can find these files on [GitHub](https://github.com/trilbymedia/grav-plugin-login-oauth2-auth0) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/login-oauth2-auth0
	
> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) to operate.

### Admin Plugin

If you use the admin plugin, you can install directly through the admin plugin by browsing the `Plugins` tab and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/login-oauth2-auth0/login-oauth2-auth0.yaml` to `user/config/plugins/login-oauth2-auth0.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
client_id: ''
client_secret: ''
domain: ''
scope: ['openid','profile','email']
```
Module is disabled by default. Client Id, Client Secret and Domain can be procured from your Auth0 Dashboard. Scope - don't change this unless you know what you are changing.

Note that if you use the admin plugin, a file with your configuration, and named login-oauth2-auth0.yaml will be saved in the `user/config/plugins/` folder once the configuration is saved in the admin.

## Usage

**Enable the plugin and follow on-screen instructions.**

## Credits
This module wasn't written entirely from scratch. This is largely based on https://github.com/trilbymedia/grav-plugin-login-oauth2-slack . All credits to the original authors.

## To Do

- [ ] Nothing yet.

