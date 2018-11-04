<?php

// display all errors
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);

// set autoloader to require all class files automatically
spl_autoload_register(function ($class_name) {
	str_replace('app', 'App', $class_name);
	$filename = '../'.str_replace('\\', '/', $class_name) . '.php';
	if(file_exists($filename)) {
		include $filename;
	}
});

// start space framework application
$space = new App\Library\Framework\Space();
$space->init();
