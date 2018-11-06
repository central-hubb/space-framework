<?php

return [

	// introduction
	[
		'uri' => '/docs/introduction/what-is-space',
		'controller' => 'Docs\IntroductionController',
		'action' => 'whatIsSpace',
	],

	// getting started
	[
		'uri' => '/docs/getting-started/installation',
		'controller' => 'Docs\IndexController',
		'action' => 'installation',
	],
	[
		'uri' => '/docs/getting-started/environments',
		'controller' => 'Docs\IndexController',
		'action' => 'environments',
	],
	[
		'uri' => '/docs/getting-started/configuration',
		'controller' => 'Docs\IndexController',
		'action' => 'configuration',
	],
	[
		'uri' => '/docs/getting-started/directory-structure',
		'controller' => 'Docs\IndexController',
		'action' => 'directoryStructure',
	],

	// the basics
	[
		'uri' => '/docs/basics/routing',
		'controller' => 'Docs\BasicsController',
		'action' => 'routing',
	],
	[
		'uri' => '/docs/basics/middleware',
		'controller' => 'Docs\BasicsController',
		'action' => 'middleware',
	],
	[
		'uri' => '/docs/basics/csrf',
		'controller' => 'Docs\BasicsController',
		'action' => 'csrf',
	],
	[
		'uri' => '/docs/basics/controllers',
		'controller' => 'Docs\BasicsController',
		'action' => 'controllers',
	],
	[
		'uri' => '/docs/basics/requests',
		'controller' => 'Docs\BasicsController',
		'action' => 'requests',
	],
	[
		'uri' => '/docs/basics/responses',
		'controller' => 'Docs\BasicsController',
		'action' => 'responses',
	],
	[
		'uri' => '/docs/basics/views',
		'controller' => 'Docs\BasicsController',
		'action' => 'views',
	],
	[
		'uri' => '/docs/basics/session',
		'controller' => 'Docs\BasicsController',
		'action' => 'session',
	],
	[
		'uri' => '/docs/basics/validation',
		'controller' => 'Docs\BasicsController',
		'action' => 'validation',
	],
	[
		'uri' => '/docs/basics/error-handling',
		'controller' => 'Docs\BasicsController',
		'action' => 'errorHandling',
	],
	[
		'uri' => '/docs/basics/logging',
		'controller' => 'Docs\BasicsController',
		'action' => 'logging',
	],

	// database
	[
		'uri' => '/docs/database/getting-started',
		'controller' => 'Docs\DatabaseController',
		'action' => 'gettingStarted',
	],
	[
		'uri' => '/docs/database/query-builder',
		'controller' => 'Docs\DatabaseController',
		'action' => 'queryBuilder',
	],
	[
		'uri' => '/docs/database/pagination',
		'controller' => 'Docs\DatabaseController',
		'action' => 'pagination',
	],
	[
		'uri' => '/docs/database/relationships',
		'controller' => 'Docs\DatabaseController',
		'action' => 'relationships',
	],
	[
		'uri' => '/docs/database/migrations',
		'controller' => 'Docs\DatabaseController',
		'action' => 'migrations',
	],
	[
		'uri' => '/docs/database/seeding',
		'controller' => 'Docs\DatabaseController',
		'action' => 'seeding',
	],
	[
		'uri' => '/docs/database/redis',
		'controller' => 'Docs\DatabaseController',
		'action' => 'redis',
	],

	// advanced
	[
		'uri' => '/docs/advanced/broadcasting',
		'controller' => 'Docs\AdvancedController',
		'action' => 'broadcasting',
	],
	[
		'uri' => '/docs/advanced/cache',
		'controller' => 'Docs\AdvancedController',
		'action' => 'cache',
	],
	[
		'uri' => '/docs/advanced/events',
		'controller' => 'Docs\AdvancedController',
		'action' => 'events',
	],
	[
		'uri' => '/docs/advanced/file-storage',
		'controller' => 'Docs\AdvancedController',
		'action' => 'fileStorage',
	],
	[
		'uri' => '/docs/advanced/helpers',
		'controller' => 'Docs\AdvancedController',
		'action' => 'helpers',
	],
	[
		'uri' => '/docs/advanced/mail',
		'controller' => 'Docs\AdvancedController',
		'action' => 'mail',
	],
	[
		'uri' => '/docs/advanced/notifications',
		'controller' => 'Docs\AdvancedController',
		'action' => 'notifications',
	],
	[
		'uri' => '/docs/advanced/package-development',
		'controller' => 'Docs\AdvancedController',
		'action' => 'packageDevelopment',
	],
	[
		'uri' => '/docs/advanced/queues',
		'controller' => 'Docs\AdvancedController',
		'action' => 'queues',
	],
	[
		'uri' => '/docs/advanced/task-scheduling',
		'controller' => 'Docs\AdvancedController',
		'action' => 'taskScheduling',
	],
];
