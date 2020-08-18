<?php

define('IRISNET_API_PLUGIN_VERSION', '1.0.1');

/**
 * @package IrisnetAPIPlugin
 */
/*
Plugin Name: Irisnet API Plugin
Plugin URI: https://github.com/irisnet-ai/irisnet-api-plugin
Description: Irisnet is a new tech startup, that specializes in the development of Artificial Intelligence (AI) systems based on neural networks for image-processing in realtime. This plugin facilitates the usage of the irisnet API. 
Author: Irisnet
Author URI: https://www.irisnet.de/
Version: 1.0.1
License: GPLv3 or later
*/

/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see http://www.gnu.org/licenses.
*/

defined('ABSPATH') or die('Not much to do here O_o');

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

/**
 * The code that runs during plugin activation
 */
function activate_irisnet_api_plugin()
{
    Inc\Base\Activate::activate();
}
register_activation_hook(__FILE__, 'activate_irisnet_api_plugin');

/**
 * The code that runs during plugin deactivation
 */
function deactivate_irisnet_api_plugin()
{
    Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook(__FILE__, 'deactivate_irisnet_api_plugin');

if (class_exists('Inc\\Init')) {
    Inc\Init::register_services();
}

require_once(plugin_dir_path(__FILE__) . 'inc/IrisnetException.php');
require_once(plugin_dir_path(__FILE__) . 'inc/IrisnetAPIConnector.php');
