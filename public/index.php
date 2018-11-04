<?php

// display all errors
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);

// set autoloader to require all class files automatically
spl_autoload_register(function ($className) {
	$className =str_replace('App', 'app', $className);
	$filename = '../'.str_replace('\\', '/', $className) . '.php';
	if(file_exists($filename)) {
		include $filename;
	}
});

// require helpers
require_once 'helpers.php';

// start space framework application
$space = new App\Library\Framework\Space();
$space->init();
