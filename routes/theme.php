<?php

return [

	// dashboards
	[
		'uri' => '/theme',
		'controller' => 'Theme\DashboardController',
		'action' => 'dashboardV1',
	],
	[
		'uri' => '/theme/dashboards/dashboard-v1',
		'controller' => 'Theme\DashboardController',
		'action' => 'dashboardV1',
	],
	[
		'uri' => '/theme/dashboards/dashboard-v2',
		'controller' => 'Theme\DashboardController',
		'action' => 'dashboardV2',
	],
	[
		'uri' => '/theme/dashboards/dashboard-v3',
		'controller' => 'Theme\DashboardController',
		'action' => 'dashboardV3',
	],
	[
		'uri' => '/theme/dashboards/dashboard-v4',
		'controller' => 'Theme\DashboardController',
		'action' => 'dashboardV4',
	],

	// forms
	[
		'uri' => '/theme/forms/inputs',
		'controller' => 'Theme\FormController',
		'action' => 'inputs',
	],
	[
		'uri' => '/theme/forms/multi-select',
		'controller' => 'Theme\FormController',
		'action' => 'multiSelect',
	],
	[
		'uri' => '/theme/forms/input-pickers',
		'controller' => 'Theme\FormController',
		'action' => 'inputPickers',
	],
	[
		'uri' => '/theme/forms/input-sliders',
		'controller' => 'Theme\FormController',
		'action' => 'inputSliders',
	],
	[
		'uri' => '/theme/forms/select2',
		'controller' => 'Theme\FormController',
		'action' => 'select2',
	],
	[
		'uri' => '/theme/forms/x-editable',
		'controller' => 'Theme\FormController',
		'action' => 'xEditable',
	],
	[
		'uri' => '/theme/forms/drag-drop-upload',
		'controller' => 'Theme\FormController',
		'action' => 'dragDropUpload',
	],
	[
		'uri' => '/theme/forms/layouts',
		'controller' => 'Theme\FormController',
		'action' => 'layouts',
	],
	[
		'uri' => '/theme/forms/validation',
		'controller' => 'Theme\FormController',
		'action' => 'validation',
	],
	[
		'uri' => '/theme/forms/text-editor',
		'controller' => 'Theme\FormController',
		'action' => 'textEditor',
	],

	// extras
	[
		'uri' => '/theme/extras/typography',
		'controller' => 'Theme\ExtrasController',
		'action' => 'typography',
	],

	// pages
	[
		'uri' => '/theme/pages/profile',
		'controller' => 'Theme\PagesController',
		'action' => 'profile',
	],
	[
		'uri' => '/theme/pages/login',
		'controller' => 'Theme\PagesController',
		'action' => 'login',
	],
	[
		'uri' => '/theme/pages/register',
		'controller' => 'Theme\PagesController',
		'action' => 'register',
	],
	[
		'uri' => '/theme/pages/lock-screen',
		'controller' => 'Theme\PagesController',
		'action' => 'lockScreen',
	],
	[
		'uri' => '/theme/pages/forgot-password',
		'controller' => 'Theme\PagesController',
		'action' => 'forgotPassword',
	],
	[
		'uri' => '/theme/pages/page-404',
		'controller' => 'Theme\PagesController',
		'action' => 'page404',
	],
	[
		'uri' => '/theme/pages/page-500',
		'controller' => 'Theme\PagesController',
		'action' => 'page500',
	],

	[
		'uri' => '/theme/components',
		'controller' => 'Theme\ComponentsController',
		'action' => 'index',
	],

	[
		'uri' => '/theme/app-views/product-detail',
		'controller' => 'Theme\AppViewsController',
		'action' => 'productDetail',
	],


];
