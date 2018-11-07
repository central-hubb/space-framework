<?php

//// set autoloader to require all class files automatically
//spl_autoload_register(function ($className) {
//	$className =str_replace('App', 'app', $className);
//	$filename = str_replace('\\', '/', $className) . '.php';
//
//	if(file_exists(path('app').'/../'.$filename)) {
//		require_once $filename;
//	}
//});

/**
 * dump.
 *
 * @param array $data
 * @param bool $exit
 */
function dump($data = [], $exit = false)
{
	print '<pre>';
	print_r($data);
	print '</pre>';

	if($exit) {
		exit;
	}
}

/**
 * env.
 *
 * @param null $key
 * @param null $default
 * @return array|mixed|null
 */
function env($key = null, $default = null)
{
	$environment = new App\Library\Framework\Environment();
	return $environment->get($key, $default);
}

/**
 * path.
 *
 * @param $type
 * @return bool|string
 */
function path($type)
{
	switch($type)
	{
		case 'base':
			return realpath(__DIR__.'/../');
			break;

		case 'app':
			return realpath(__DIR__.'/../app');
			break;

		case 'public':
			return realpath(__DIR__);
			break;
	}
}

