# v2.1.0
## 05/13/2021

1. [](#new)
   * Require **Grav 1.7.0**
   * Added configuration option to require existing Grav user
   * Assign OAuth2 to existing user [#35](https://github.com/trilbymedia/grav-plugin-login-oauth2/issues/35)
1. [](#improved)
   * Code improvements and updates
   * Only enable configured oauth2 providers
1. [](#bugfix)
    * Google: non-hosted google accounts cannot be used [#25](https://github.com/trilbymedia/grav-plugin-login-oauth2/issues/25)
    * Fixed missing translations in the template file [#37](https://github.com/trilbymedia/grav-plugin-login-oauth2/pull/37)
    * Fixed login buttons exceeding available width on mobile screens [#31](https://github.com/trilbymedia/grav-plugin-login-oauth2/pull/31)
    * Fixed login redirects in admin plugin

# v2.0.5
## 12/02/2020

1. [](#improved)   
    * Removed user scope from github by default [#36](https://github.com/trilbymedia/grav-plugin-login-oauth2/pull/36)

# v2.0.4
## 06/03/2020

1. [](#improved)    
    * If no provider is enabled for site connections, simply omit the template [#28](https://github.com/trilbymedia/grav-plugin-login-oauth2/pull/28)
    * Vendor updates
    * Use `UserLogin::defaultRedirectAfterLogin()` helper method

# v2.0.3
## 02/24/2019

1. [](#improved)
    * Added `copy-to-clipboard` support for Callback URIs
    * Added support for providers that callback via POST (ie, Apple)
    * Fixed issues with saving in Admin 1.7 with strict form validation

# v2.0.2
## 04/28/2019

1. [](#improved)
    * Removed configurable callback URL.

# v2.0.1
## 04/28/2019

1. [](#bugfix)
    * Fixed login version requirements (`~3.0`) [#17](https://github.com/trilbymedia/grav-plugin-login-oauth2/issues/17)

# v2.0.0
## 04/26/2019

1. [](#new)
    * Support for OAuth2 login via Admin plugin
    * Support for default groups
1. [](#improved)
    * Updated vendor libraries to use latest Google / LinkedIn providers
1. [](#bugfix)
    * Fix bad redirect on login error

# v1.0.1
## 06/07/2018

1. [](#new)
    * Added new Hosted Domain option for Google Provider that allows to limit the login per domain [#1](https://github.com/trilbymedia/grav-plugin-login-oauth2/issues/1)

# v1.0.0
##  05/18/2018

1. [](#new)
    * Plugin released
