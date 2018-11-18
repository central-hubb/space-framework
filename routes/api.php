<?php

return [
	[
		'uri' => '/api',
		'controller' => 'Api\IndexController',
		'action' => 'index',
	],
	[
		'uri' => '/api/component/auto-complete/demo1',
		'controller' => 'Api\Component\AutoCompleteController',
		'action' => 'demo1',
	],
	[
		'uri' => '/api/component/auto-complete/demo2',
		'controller' => 'Api\Component\AutoCompleteController',
		'action' => 'demo2',
	]
];
