$(function() {

	// default tree view
	var treeviewDefault = $('#treeview-default');

	treeviewDefault.jstree({
		'core' : {
			'data' : {
				'url' : 'assets/scripts/tree/tree-default.json',
			},
			'check_callback' : true,
		},
		'plugins' : ['types', 'contextmenu']

	}).on('loaded.jstree', function() {
		treeviewDefault.jstree('open_all');
	});

	// tree view with custom icon
	var treeviewCustomIcon = $('#treeview-custom-icon');

	treeviewCustomIcon.jstree({
		'core' : {
			'data' : {
				'url' : 'assets/scripts/tree/tree-filesystem.json',
			},
			'check_callback' : true,
		},
		'plugins' : ['checkbox', 'contextmenu', 'types'],
		'checkbox' : {
			'keep_selected_style' : false
		},
		'types' : {
			'root' : {
				'icon' : 'fa fa-desktop text-primary'
			},
			'default' : {
				'icon' : 'fa fa-folder'
			},
			'text' : {
				'icon' : 'fa fa-file-text-o'
			},
			'pdf' : {
				'icon' : 'fa fa-file-pdf-o'
			},
			'word' : {
				'icon' : 'fa fa-file-word-o'
			},
			'excel' : {
				'icon' : 'fa fa-file-excel-o'
			},
			'ppt' : {
				'icon' : 'fa fa-file-powerpoint-o'
			},
			'img' : {
				'icon' : 'fa fa-file-image-o'
			},
			'zip' : {
				'icon' : 'fa fa-file-zip-o'
			}
		}

	}).on('loaded.jstree', function() {
		treeviewCustomIcon.jstree('open_all');
	});

	// tree view for application
	var treeviewApp = $('#treeview-application');

	treeviewApp.jstree({
		'core' : {
			'data' : {
				'url' : 'assets/scripts/tree/tree-application.json',
			},
			'check_callback' : true,
		},
		'plugins' : ['contextmenu', 'types'],
		'types' : {
			'root' : {
				'icon' : 'fa fa-desktop'
			},
			'default' : {
				'icon' : 'fa fa-folder text-warning'
			},
			'database' : {
				'icon' : 'fa fa-database text-warning'
			},
			'table' : {
				'icon' : 'fa fa-table text-success'
			},
			'view' : {
				'icon' : 'fa fa-search text-primary'
			},
			'procedure' : {
				'icon' : 'fa fa-play-circle text-success'
			},
			'key' : {
				'icon' : 'fa fa-key text-primary'
			},
		}

	}).on('loaded.jstree', function() {
		treeviewApp.jstree('open_all');
	});
});