<?php
date_default_timezone_set('Europe/Amsterdam');
ini_set("display_errors", "on");
ini_set('memory_limit', '40000M');
error_reporting(E_ALL ^ E_DEPRECATED);


/*** class Loader ***/
function myClassLoader($class) {
	// Build file path
	$file_path_ar[] = $_SERVER['DOCUMENT_ROOT'];
	$file_path_ar[] = 'ys';
	$file_path_ar[] = 'classes';
	$file_path_ar[] = str_replace('_', DIRECTORY_SEPARATOR, strtolower($class) . '.class.php');
	// Include file if it exists
	$file = implode(DIRECTORY_SEPARATOR, $file_path_ar);
	if (!file_exists($file)) { return false; }
	else { include_once($file); }
}

    // Autoload classes
    spl_autoload_register('myClassLoader');

?>