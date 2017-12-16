<?php
/*
Plugin Name: Rudimentary Information
Plugin URL: https://www.benjlu.com/portfolio/rudimentary-information/
Author: Benjamin Lu
Author URI: https://www.benjlu.com/
Description: Rudimentary Information currently displays themes information using the WordPress.org theme's API.
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: rudimentary-information
Version: 0.0.5

Rudimentary Information is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by the Free 
Software Foundation, either version 2 of the License, or any later version.
 
Rudimentary Information is distributed in the hope that it will be useful, but 
WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or 
FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more 
details.
 
You should have received a copy of the GNU General Public License along with 
Rudimentary Information. If not, see http://www.gnu.org/licenses/gpl-2.0.html.
*/

/*
================================================================================================
Table of Content
================================================================================================
 1.0 - Forbidden Access
 2.0 - Required Files
 3.0 - Initialization
 4.0 - Theme Info Widget
================================================================================================
*/

/*
================================================================================================
 1.0 - Forbidden Access
================================================================================================
*/
if (!defined('ABSPATH')) { 
    exit;
}

/*
================================================================================================
 2.0 - Required Files
================================================================================================
*/
require_once(plugin_dir_path(__FILE__) . 'includes/theme-info.php');
require_once(plugin_dir_path(__FILE__) . 'includes/plugin-info.php');
require_once(plugin_dir_path(__FILE__) . 'includes/theme-metabox.php');

/*
================================================================================================
 3.0 - Initialization
================================================================================================
*/
$theme_info = Rudimentary_Information_Themes::init();
$plugin_info = Rudimentary_Information_Plugins::init();

add_action( 'load-post.php',     'Rudimentary_Information_Themes_Metabox::init' ); // adds a metabox and save action on editor screen for editing posts.
add_action( 'load-post-new.php', 'Rudimentary_Information_Themes_Metabox::init' ); // adds a metabox and save action on editor for new posts.

/*
================================================================================================
 4.0 - Theme Info Widget
================================================================================================
*/
if ($theme_info instanceof Rudimentary_Information_Themes) {
    require_once(plugin_dir_path(__FILE__) . 'widgets/theme-widget.php');
    
    function rudimentary_information_theme_info_widget() {
        register_widget('Rudimentary_Information_Themes_Widget');
    }
    add_action('widgets_init', 'rudimentary_information_theme_info_widget');
}

function rudimentary_information_enqueue_styles() {
    wp_enqueue_style('rudimentary-information-style', plugin_dir_url(__FILE__) . 'css/style.css');
}
add_action('wp_enqueue_scripts', 'rudimentary_information_enqueue_styles');