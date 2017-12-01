    == Rudimentary Information ==
    Contributors: benlumia007
    Donate link: https://www.benjlu.com
    Tags: api
    Requires at least: 4.8.3
    Tested up to: 4.9
    Stable tag: 0.0.1
    Requires PHP: 7.0
    License: GPLv2 or later
    License URI: http://www.gnu.org/licenses/gpl-2.0.html

    Rudimentary Information allows you to grab information specifically for individual themes b using
    the WordPress Themes API.

    == Description ==

    Rudimentary Information currently displays themes information using the WordPress.org theme's API
    and it uses shortcodes to display the information in either the post or page.

    1. Uses shortcode such as [theme-info slug='theme-slug' field='field-name']

    The slug is the name of the theme that you want to display. The field is what you want to use such as
    `version` to display the version number of the theme or `last_updated` to display the last date the
    theme was uploaded. 

    The following fields that are supported as followed

    - name
    - rating
    - downloadeda
    - download_link
    - last_updated
    - homepage
    - tags
    - template
    - version
    - screenshot_url
    - preview_url

    == Installation ==

    1.0 - In your admin panel, go to Appearance -> Plugins and click the Add New button.
    2.0 - Click Upload and Choose File, then select the theme's ZIP file. Click Install Now.
    3.0 - Click Activate to use your new plugin right away.

    or 

    1.0 - Upload rudimentary-information.zip to the `/wp-content/plugins/` directory.
    2.0 - Activate the plugin through the `Plugins` menu in WordPress Dashboard

    == Frequently Asked Questions ==
    = How to use this plugin =
    To use this plugin simply create a new post or page, and add the following shortcode [theme-info slug='theme-slug' field='name']. 

    == Changelog ==
    = 0.0.1 =
    Initial Release

    == Upgrade Notice ==
    = 0.0.1 =
    Initial Release