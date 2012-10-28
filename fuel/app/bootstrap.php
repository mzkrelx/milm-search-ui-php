<?php

/**
 * Ensure vendor is on include_path.
 */
set_include_path(implode(PATH_SEPARATOR, array(
realpath(APPPATH.'/vendor/'),
get_include_path(),
)));

/**
 * Debug function.
 *
 * @param  mixed  $var   displaying
 * @param  string $label label also displaying
 * @return void
*/
require_once 'Zend/Debug.php';
function d($var, $label = null) {
    Zend_Debug::dump($var, $label);
}

// Load in the Autoloader
require COREPATH.'classes'.DIRECTORY_SEPARATOR.'autoloader.php';
class_alias('Fuel\\Core\\Autoloader', 'Autoloader');

// Bootstrap the framework DO NOT edit this
require COREPATH.'bootstrap.php';

Autoloader::add_classes(array(
	// Add classes you want to override here
	// Example: 'View' => APPPATH.'classes/view.php',
));

// Register the autoloader
Autoloader::register();

/**
 * Your environment.  Can be set to any of the following:
 *
 * Fuel::DEVELOPMENT
 * Fuel::TEST
 * Fuel::STAGE
 * Fuel::PRODUCTION
 */
Fuel::$env = (isset($_SERVER['FUEL_ENV']) ? $_SERVER['FUEL_ENV'] : Fuel::DEVELOPMENT);

// Initialize the framework with the config file.
Fuel::init('config.php');
