# Admin Addon Revisions Plugin

The **Admin Addon Revisions** Plugin is for [Grav CMS](http://github.com/getgrav/grav). An extension for Admin plugin which adds revisions for pages.

## Installation

Installing the Admin Addon Revisions plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install admin-addon-revisions

This will install the Admin Addon Revisions plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/admin-addon-revisions`.

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `admin-addon-revisions`. You can find these files on [GitHub](https://github.com/todo/grav-plugin-admin-addon-revisions) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/admin-addon-revisions

> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav), [Admin](https://github.com/getgrav/grav-plugin-admin), [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) to operate.

## WARNING

Please make a backup before you install the plugin. This is advised to do before installing any new plugin!

## Configuration

Before configuring this plugin, you should copy the `user/plugins/admin-addon-revisions/admin-addon-revisions.yaml` to `user/config/plugins/admin-addon-revisions.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
directory: .revs
limit:
  maximum: 10
  older: 1 month
ignore_files: []
```

* `directory` - revisions will be stored in this folder inside the page's folder

* `limit.maximum` - limits the number of revisions per page (use `0` to disable)

* `limit.older` - limits the number of revisions per page by checking the creation date of the revision, works with any `strtotime` compatible string. (1 month, 2 months, 1 day, 30 days, etc.)  (use `0` to disable)

* `ignore_files` - an array of regular expressions to ignore files when looking for changes between revisions

  In this example we ignore all `png` and `jpg` files in the `test` page's folder.
  ```
  /pages\/test\/(.*).png$/
  /pages\/test\/(.*).jpg$/
  ```
  If you want to ignore `png` files in all pages' folders then you can use something like this:
  ```
  /png$/
  ```

## Usage

A **Revisions** link will appear in the **Admin** navigation sidebar. By navigating to the **Revisions** you can check the differences and delete/revert a specific revision.

## To Do

- [ ] Translation support

