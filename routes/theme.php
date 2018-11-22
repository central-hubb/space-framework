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

	// app-views
	[
		'uri' => '/theme/app-views/project-detail',
		'controller' => 'Theme\AppViewsController',
		'action' => 'projectDetail',
	],
	[
		'uri' => '/theme/app-views/projects',
		'controller' => 'Theme\AppViewsController',
		'action' => 'projects',
	],
	[
		'uri' => '/theme/app-views/inbox',
		'controller' => 'Theme\AppViewsController',
		'action' => 'inbox',
	],
	[
		'uri' => '/theme/app-views/file-manager',
		'controller' => 'Theme\AppViewsController',
		'action' => 'fileManager',
	],

	// tables
	[
		'uri' => '/theme/tables/static',
		'controller' => 'Theme\TablesController',
		'action' => 'staticTable',
	],
	[
		'uri' => '/theme/tables/dynamic',
		'controller' => 'Theme\TablesController',
		'action' => 'dynamic',
	],

	// charts
	[
		'uri' => '/theme/charts/chartjs',
		'controller' => 'Theme\ChartsController',
		'action' => 'chartjs',
	],
	[
		'uri' => '/theme/charts/chartist',
		'controller' => 'Theme\ChartsController',
		'action' => 'chartist',
	],
	[
		'uri' => '/theme/charts/flot',
		'controller' => 'Theme\ChartsController',
		'action' => 'flot',
	],
	[
		'uri' => '/theme/charts/sparkline',
		'controller' => 'Theme\ChartsController',
		'action' => 'sparkline',
	],

	// layouts
	[
		'uri' => '/theme/layouts/topnav',
		'controller' => 'Theme\LayoutsController',
		'action' => 'topnav',
	],
	[
		'uri' => '/theme/layouts/minified',
		'controller' => 'Theme\LayoutsController',
		'action' => 'minified',
	],
	[
		'uri' => '/theme/layouts/grid',
		'controller' => 'Theme\LayoutsController',
		'action' => 'grid',
	],

	// maps
	[
		'uri' => '/theme/maps/jqvmap',
		'controller' => 'Theme\MapsController',
		'action' => 'jqvmap',
	],
	[
		'uri' => '/theme/maps/mapael',
		'controller' => 'Theme\MapsController',
		'action' => 'mapael',
	],

	// ui
	[
		'uri' => '/theme/ui/sweetalert',
		'controller' => 'Theme\UIController',
		'action' => 'sweetalert',
	],
	[
		'uri' => '/theme/ui/treeview',
		'controller' => 'Theme\UIController',
		'action' => 'treeview',
	],
	[
		'uri' => '/theme/ui/wizard',
		'controller' => 'Theme\UIController',
		'action' => 'wizard',
	],
	[
		'uri' => '/theme/ui/drag-drop-panel',
		'controller' => 'Theme\UIController',
		'action' => 'dragDropPanel',
	],
	[
		'uri' => '/theme/ui/nestable',
		'controller' => 'Theme\UIController',
		'action' => 'nestable',
	],
	[
		'uri' => '/theme/ui/gauge',
		'controller' => 'Theme\UIController',
		'action' => 'gauge',
	],
	[
		'uri' => '/theme/ui/panels',
		'controller' => 'Theme\UIController',
		'action' => 'panels',
	],
	[
		'uri' => '/theme/ui/progressbars',
		'controller' => 'Theme\UIController',
		'action' => 'progressbars',
	],
	[
		'uri' => '/theme/ui/tabs',
		'controller' => 'Theme\UIController',
		'action' => 'tabs',
	],
	[
		'uri' => '/theme/ui/buttons',
		'controller' => 'Theme\UIController',
		'action' => 'buttons',
	],
	[
		'uri' => '/theme/ui/bootstrap',
		'controller' => 'Theme\UIController',
		'action' => 'bootstrap',
	],
	[
		'uri' => '/theme/ui/social-buttons',
		'controller' => 'Theme\UIController',
		'action' => 'socialButtons',
	],
	[
		'uri' => '/theme/ui/icons',
		'controller' => 'Theme\UIController',
		'action' => 'icons',
	],	

	// notifications
	[
		'uri' => '/theme/notifications',
		'controller' => 'Theme\NotificationsController',
		'action' => 'notifications',
	],

	// submenu
	[
		'uri' => '/theme/submenu',
		'controller' => 'Theme\SubmenuController',
		'action' => 'submenu',
	],

	// widgets
	[
		'uri' => '/theme/widgets',
		'controller' => 'Theme\WidgetsController',
		'action' => 'widgets',
	],

];
