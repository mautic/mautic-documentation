php-yui-compressor
==================

A modern PHP wrapper for the YUI compressor.

Installation
------------

Run `composer install` (install Composer if you haven't done so already). You will also need to have Java installed and available in your path (on Debian/Ubuntu-based systems you can install it using `sudo apt-get install default-jre`)

Usage
-----

The following snippet assumes you've included the Composer-generated autoloader.

```php
<?php

$yui = new \YUI\Compressor();

// Read the uncompressed contents
$css = file_get_contents('styles.css');
$script = file_get_contents('script.js');

// Compress the CSS
$yui->setType(\YUI\Compressor::TYPE_CSS);
$optimizedCss = $yui->compress($css);

// Compress the JavaScript
$yui->setType(\YUI\Compressor::TYPE_JS);
$optimizedScript = $yui->compress($script);
```

```php
<?php

// javaPath defauls to "java" which means it has to be in the path. If that's 
// not the case we can override it like this.
$yui = new \YUI\Compressor(array(
	'javaPath'=>'/usr/bin/java',
	'line-break'=>80,
	'disable-optimizations'=>true,
));

// Read the uncompressed contents
$css = file_get_contents('styles.css');
$script = file_get_contents('script.js');

// The "disable-optimizations" option is JavaScript-specific so it won't apply 
// here...
$yui->setType(\YUI\Compressor::TYPE_CSS);
$optimizedCss = $yui->compress($css);

// ...but here it will
$yui->setType(\YUI\Compressor::TYPE_JS);
$optimizedScript = $yui->compress($script);
```

Credits
-------

Inspired by the work of gpbmike (https://github.com/gpbmike/PHP-YUI-Compressor)
