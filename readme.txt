== Rudimentary Information ==
Contributors: benlumia007
Donate link: https://www.benjlu.com
Tags: api
Requires at least: 4.8.3
Tested up to: 4.9
Stable tag: 0.0.5
Requires PHP: 7.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Rudimentary Information allows you to grab information specifically for an individual theme and plugin by using the WordPress Themes API and Plugins API.

== Description ==
Rudimentary Information allows you to grab information specifically for an individual theme or plugin by fetching data from the WordPress Themes API and Plugins API. This plugin is very simple yet easy to use by providing a valid slug and field to display a specific information. This plugin uses shortcode to display information.  

= Working with Themes =
To display a specific theme, please use the following shortcode

[theme-info slug='theme-slug' field='version']

The slug is the name of the theme that you want to display. The field is an array of choices that you can use to display a piece of information such as version or last_updated information.

The following fields that are currently supported are as follow:

* name
* homepage
* screenshot_url
* preview_url
* download_link
* downloaded
* last_updated
- version

= Working with Plugins =
To display a specific plugin, please use the following shortcode

[plugin-info slug='plugin-slug' field='version']

The slug is the name of the plugin that you want to display. The field is an array of choices that you can use to display a piece of information such as version or last_updated information.

The following fields that are currently supported are as follow:

* name
* homepage
* screenshot_url
* preview_url
* download_link
* downloaded
* last_updated
- version

== Installation ==

1.0 - In your admin panel, go to Appearance -> Plugins and click the Add New button.
2.0 - Click Upload and Choose File, then select the theme's ZIP file. Click Install Now.
3.0 - Click Activate to use your new plugin right away.

or 

1.0 - Upload rudimentary-information.zip to the `/wp-content/plugins/` directory.
2.0 - Activate the plugin through the `Plugins` menu in WordPress Dashboard

== Frequently Asked Questions ==
= How to use this plugin =
To use this plugin simply create a new post or page, and add the following shortcode 

[theme-info slug='theme-slug' field='name'] for themes

[plugin-info slug='plugin-slug' field='name'] for plugins

== Changelog ==
= 0.0.5 =
*Release Date - December 16, 2017*

* Add Widget Support for Themes
* Add Metabox to suppor Widget (JetPack Portfolio Only)
* Bump Version to 0.0.5

= 0.0.4 =
*Release Date - December 1, 2017*

* Fixed naming inside of classes for plugin-info.php
* Bump Vesion Number to 0.0.4

= 0.0.3 =
*Release Date - November 30, 2017*

* Bump Version to 0.0.3 for readme.txt and rudimentary-information.php
* Changed shortcode from theme-info to plugin-info 

= 0.0.2 = 
*Release Date - November 30, 2017*

* Removed Whitespace (readme.txt)
* Replace Classes for either Themes or Plugins
* Add plugin-info.php

= 0.0.1 =
*Release Date - November 30, 2017*

* Initial Release

== Upgrade Notice ==
= 0.0.1 =
*Release Date - November 30, 2017*

* Initial Release