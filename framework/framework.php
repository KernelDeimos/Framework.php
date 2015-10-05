<?php

// === IMPORTANT DEFINITIONS ===

// Framework path
define ('FRAMEWORK_PATH', realpath(dirname(__FILE__)) );
// SITE_PATH constant is just a shortcut for the working directory
define('SITE_PATH',getcwd());
define('ROOT_PATH',getcwd());
// The WEB_PATH constant
/* This took a while to figure out, but at this point
it's working perfectly. WEB_PATH offers a constant for
the root of this website as seen by the browser.
For instance, http://website.com if this is on website.com,
or http://website.com/sub if this is in a subdirectory.
*/
$pattern = '/^'.preg_quote($_SERVER['DOCUMENT_ROOT'],'/').'/';
$webpath = "http://".$_SERVER['HTTP_HOST'].preg_replace($pattern,'',getcwd());
define('WEB_PATH',$webpath);


if (!defined('DEV_MODE')) {
	define('DEV_MODE', false);
}
$_FRAMEWORK = array();

require_once("framework_utils.php");

class IncludePathHandler {
	static function add_include_path ($path) {
		foreach (func_get_args() AS $path)
		{
			if (!file_exists($path) OR (file_exists($path) && filetype($path) !== 'dir'))
			{
				throw new FrameworkException (
					"Include path '{$path}' does not exist",
					FrameworkException::PATH_HANDLER_INEXISTANT_PATH_INCLUSION
					);
				continue;
			}
			
			$paths = explode(PATH_SEPARATOR, get_include_path());
			
			if (array_search($path, $paths) === false)
				// formerly array_push
				array_unshift($paths, $path);
			
			set_include_path(implode(PATH_SEPARATOR, $paths));
		}
	}

	static function remove_include_path ($path) {
		foreach (func_get_args() AS $path)
		{
			$paths = explode(PATH_SEPARATOR, get_include_path());
			
			if (($k = array_search($path, $paths)) !== false)
				unset($paths[$k]);
			else
				continue;
			
			if (!count($paths))
			{
				throw new FrameworkException (
					"Include path '{$path}' can not be removed because it is the only",
					FrameworkException::PATH_HANDLER_ONLY_PATH_REMOVAL
					);
				continue;
			}
			
			set_include_path(implode(PATH_SEPARATOR, $paths));
		}
	}
}

// AUTOLOAD
function __autoload($className) {
	$possibleLocations = array();
	$possibleLocations[] = $className . '.class.php';
	$possibleLocations[] = $className.".class/main.php";
	$possibleLocations[] = $className."/".$className.".php";
	$possibleLocations[] = $className.".php";
	foreach ($possibleLocations as $location) {
		@include($location);
		if (class_exists($className)) return;
	}
	if (!class_exists($className)) {
		throw new FrameworkException (
			"Autoload failed; no file or folder with the given classname (".$className.") was readable",
			FrameworkException::AUTOLOAD
		);
	}
}

function framework_load_paths() { // throws FrameworkException
	IncludePathHandler::add_include_path(FRAMEWORK_PATH.DIRECTORY_SEPARATOR."lib");
	IncludePathHandler::add_include_path(FRAMEWORK_PATH.DIRECTORY_SEPARATOR."internal");
	IncludePathHandler::add_include_path(FRAMEWORK_PATH.DIRECTORY_SEPARATOR."types");
}


$_FRAMEWORK['error_log'] = array();
function exception_error_handler($errno, $errstr, $errfile, $errline ) {
	if (DEV_MODE) echo "de errno:".$errno.";errstr:".$errstr.";errfile:".$errfile.";errline:".$errline;
	/*if (DEV_MODE && $errno==8) {
		var_dump(debug_backtrace());
	}*/
	switch ($errno) {
		case E_RECOVERABLE_ERROR:
		case E_USER_ERROR:
			throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
			break;
		case E_WARNING:
		case E_USER_WARNING:
			break;
		case E_NOTICE:
		case E_USER_NOTICE:
			break;
		default:
			
			break;
	}
	$notice = array();
	$notice['errno'] = $errno;
	$notice['errstr'] = $errstr;
	$notice['errfile'] = $errfile;
	$notice['errline'] = $errline;
	$_FRAMEWORK['error_log'][] = $notice;
}
function framework_shutdown_function() {
	$var = error_get_last();
	if ($var) {
		echo "Oops; an error occured to such an extent that the operation had to stop, and a web page could not be sent to you.";
		if (DEV_MODE) {
			echo "<br /><br />DEV MODE IS ON:<br /><pre>";
				print_r($var);
			}
			echo "</pre>";
		}
}
set_error_handler("exception_error_handler");
register_shutdown_function('framework_shutdown_function');
framework_load_paths();
/*
// TODO IF BORED
// -> Load paths from config into $_FRAMEWORK['path'];
// -> Set framework_load_paths to load from $_FRAMEWORK['path'];
*/
return 0;