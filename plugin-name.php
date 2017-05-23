<?php

/*
Plugin Name: My Plugin Name
Plugin URI: http://plugin.com.au
Description: A description of this plugin
Version: 0.0
Author: My Name
Author URI: http://myname.com.au
*/

/*
 * If this file is called directly, abort.
 */
if ( ! defined( 'WPINC' ) ) {
    die;
}

/*
 * Include dependencies
 */
require (__DIR__ . "/vendor/autoload.php");

/*
 *  Boot Plugin
 */
$plugin = new \Vendor\PluginName\Plugin(__FILE__);
$plugin->boot();
