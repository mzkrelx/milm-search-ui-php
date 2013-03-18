<?php
/**
 * MilmSearch UI-PHP is a part of mailing list searching system,
 * user interface on the WEB.
 *
 * Copyright (C) 2013 MilmSearch Project.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public
 * License along with this program.
 * If not, see <http://www.gnu.org/licenses/>.
 *
 * You can contact MilmSearch Project at mailing list
 * milm-search-public@lists.sourceforge.jp.
 *
 * @package    Milm
 * @version    0.1
 * @author     MilmSearch Project
 * @license    GPLv3 or later License
 * @copyright  Copyright (C) 2013 MilmSearch Project
 */

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

function get_or($string, $else = "") {
	if (!is_null($string)) {
		return $string;
	}
	else {
		return $else;
	}
}

function get_bigger($one, $other) {
	if ($one > $other) {
		return $one;
	}
	return $other;
}

/**
 * Echo string. But if string is null, then echo else.
 *
 * @param string $string echo when not null
 * @param string $else   echo when string is null
 */
function echo_or($string, $else = "") {
	echo get_or($string, $else);
}

/**
 * Returns value in array has key.
 * But returns else when isset($array($key)) return false or $array($key) is null.
 *
 * @param array  $array
 * @param string $key
 * @param mixed  $else
 */
function array_get_or(array $array, $key, $else = "") {
	if (isset($array[$key])) {
		return get_or($array[$key], $else);
	}
	else {
		return $else;
	}
}

/**
 * Returns string of array.
 *
 * The String is result of var_dump().
 *
 * @param  array $array
 * @return string
 */
function array_to_string(array $array) {
	ob_start();
	var_dump($array);
	$string = ob_get_contents();
	ob_end_clean();

	return $string;
}

/**
 * キャメルケースなどの文字列をスネークケースに変換します。
 *
 * @param  string $string もとになる文字列
 * @return string
 */
function snake_case($string)
{
	$string = preg_replace('/([A-Z])/', '_$1', $string);
	$string = strtolower($string);
	return ltrim($string, '_');
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
