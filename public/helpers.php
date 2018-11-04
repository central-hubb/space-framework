<?php

function dump($data = [], $exit = false)
{
	print '<pre>';
	print_r($data);
	print '</pre>';

	if($exit) {
		exit;
	}
}

function env($key = null)
{
	$environment = new App\Library\Framework\Environment();
	return $environment->get($key);
}

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