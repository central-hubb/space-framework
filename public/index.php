<?php

// display all errors
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);

// require helpers
require_once '../helpers.php';

// require composer autoloader
require_once '../vendor/autoload.php';

// start space framework application
$space = new \App\Library\Framework\Space();
$space->init();



