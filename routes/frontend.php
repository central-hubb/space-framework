<?php

return [
	[
		'uri' => '/',
		'controller' => 'Frontend\IndexController',
		'action' => 'index',
	],


	[
		'uri' => '/example/page1',
		'controller' => 'Frontend\ExampleController',
		'action' => 'page1',
	],

	[
		'uri' => '/example/page2',
		'controller' => 'Frontend\ExampleController',
		'action' => 'page2',
	],
];
