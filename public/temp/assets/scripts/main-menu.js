/* -----------------
 * MAIN MENU
 * -----------------*/

var arrMainNav = [
	{
		url: "#dashboards",
		title: "Dashboards",
		children: [
			{
				url: "dashboards/dashboard.html",
				title: "Dashboard",
				description: "Bootstrap admin dashboard template with drag and drop panel"
			},
			{
				url: "dashboards/dashboard2.html",
				title: "Dashboard v2",
				description: "Growth monitor dashboard with colorful elements."
			},
			{
				url: "dashboards/dashboard3.html",
				title: "Dashboard v3",
				description: "Simple and minimal dashboard."
			},
			{
				url: "dashboards/dashboard4.html",
				title: "Dashboard v4",
				description: "Dashboard with top navigation layout and centered content."
			}
		]
	},
	{
		url: "#subLayouts",
		title: "Layouts",
		children: [
			{
				url: "layouts/layout-topnav.html",
				title: "Top Navigation",
				description: "Click the thumbnail to see other layouts."
			},
			{
				url: "layouts/layout-minified.html",
				title: "Layout Minified",
				description: "Click the thumbnail to see other layouts."
			},
			{
				url: "layouts/layout-grid.html",
				title: "Grid",
				description: "Grid systems are used for creating page layouts through a series of rows and columns that house your content."
			}
		]
	},
	{
		url: "#forms",
		title: "Forms",
		children: [
			{
				url: "forms/forms-inputs.html",
				title: "Input Elements",
				description: "General input elements"
			},
			{
				url: "forms/forms-multiselect.html",
				title: "Multiselect",
				description: "Intuitive user interface for using select inputs with the multiple attribute present"
			},
			{
				url: "forms/forms-input-pickers.html",
				title: "Input Pickers",
				description: "Datepicker, color picker, time picker"
			},
			{
				url: "forms/forms-input-sliders.html",
				title: "Input Sliders",
				description: "Input slider, range input slider, stepped input slider"
			},
			{
				url: "forms/forms-select2.html",
				title: "Select2",
				description: "The jQuery replacement for select boxes"
			},
			{
				url: "forms/forms-xeditable.html",
				title: "X-Editable In-place Editing",
				description: "In-place editing, allows you to create editable elements on your page."
			},
			{
				url: "forms/forms-dragdropupload.html",
				title: "Drag and Drop Upload",
				description: "Override your input files with style."
			},
			{
				url: "forms/forms-layouts.html",
				title: "Form Layouts",
				description: "Ready-to-use form layouts."
			},
			{
				url: "forms/forms-validation.html",
				title: "Form Validation",
				description: "Form validation with Parsley, validating forms frontend have never been so powerful and easy."
			},
			{
				url: "forms/forms-texteditor.html",
				title: "Text Editor",
				description: "WYSIWYG and markdown editor."
			},
		]
	},
	{
		url: '#appViews',
		title: 'App Views',
		children: [
			{
				url: "appviews/appviews-project-detail.html",
				title: "Project Detail",
				description: "A detailed view about project information"
			},
			{
				url: "appviews/appviews-project.html",
				title: "Projects",
				description: "List of project information summary"
			},
			{
				url: "appviews/appviews-inbox.html",
				title: "Inbox",
				description: "You have <strong>8 unread messages</strong>"
			},
			{
				url: "appviews/appviews-file-manager.html",
				title: "File Manager",
				description: "<span class=\"text-danger\">You nearly reached storage limit capacity!</span>&nbsp;&nbsp;&nbsp;<a href=\"#\"><i class=\"fa fa-plus-circle\"></i> Upgrade Now</a>"
			},
		]
	},
	{
		url: "#tables",
		title: "Tables",
		children: [
			{
				url: "tables/tables-static.html",
				title: "Tables",
				description: "Simple tables based on Bootstrap."
			},
			{
				url: "tables/tables-dynamic.html",
				title: "Dynamic Tables",
				description: "Tables with powerful features such as sorting, drag and drop column, filter and more."
			}
		]
	},
	{
		url: "#uiElements",
		title: "UI Elements",
		children: [
			{
				url: "ui/ui-sweetalert.html",
				title: "Sweet Alert",
				description: "A beautiful, responsive and customizable replacement for Javasript's popup boxes."
			},
			{
				url: "ui/ui-treeview.html",
				title: "Tree View",
				description: "Interactive trees, easily extendable, themable and configurable. Try to right click node item to see popup menu."
			},
			{
				url: "ui/ui-wizard.html",
				title: "Wizard",
				description: "A wizard divides a complex goal into multiple steps by separating sub-tasks or content into panes."
			},
			{
				url: "ui/ui-dragdrop-panel.html",
				title: "Drag & Drop Panel",
				description: "Reorder panels in layout with drag and drop feature"
			},
			{
				url: "ui/ui-nestable.html",
				title: "Nestable",
				description: "Drag & drop hierarchical list with mouse and touch compatibility"
			},
			{
				url: "ui/ui-gauge.html",
				title: "Gauge",
				description: "Nice and clean gauges based on Raphael library for vector drawing."
			},
			{
				url: "ui/ui-panels.html",
				title: "Panels",
				description: "Panel container for various requirements and use-case scenario."
			},
			{
				url: "ui/ui-progressbars.html",
				title: "Progress Bars",
				description: "Dynamic and static progress bars with various formats and styles."
			},
			{
				url: "ui/ui-tabs.html",
				title: "Tabs",
				description: "Quick, dynamic tab functionality to transition through panes of local content, even via dropdown menus."
			},
			{
				url: "ui/ui-buttons.html",
				title: "Buttons",
				description: "A collection of buttons with various styles and functions."
			},
			{
				url: "ui/ui-bootstrap.html",
				title: "Bootstrap UI",
				description: "Custom styled standard Bootstrap UI."
			},
			{
				url: "ui/ui-social-buttons.html",
				title: "Social Buttons",
				description: "Social Sign-In Buttons made in pure CSS based on Bootstrap and Font Awesome!"
			},
			{
				url: "ui/ui-icons.html",
				title: "Icons",
				description: "320+ icons from Themify and 650+ icons from Font Awesome."
			},
		]
	},
	{
		url: "#charts",
		title: "Charts",
		children: [
			{
				url: "charts/charts-chartjs.html",
				title: "Chart.js",
				description: "Simple yet flexible JavaScript charting for designers & developers"
			},
			{
				url: "charts/charts-chartist.html",
				title: "Chartist",
				description: "Highly customizable responsive simple charts."
			},
			{
				url: "charts/charts-flot.html",
				title: "Flot Charts",
				description: "Simple usage, attractive looks and interactive features."
			},
			{
				url: "charts/charts-sparkline.html",
				title: "Sparkline Charts",
				description: "Small inline charts"
			},
		]
	},
	{
		url: "widgets.html",
		title: "Widgets",
		description: "Reusable and flexible components serving specific functions"
	},
	{
		url: "notifications.html",
		title: "Notifications",
		description: "Customizable and stylish Gnome/Growl type non-blocking notifications."
	},
	{
		url: "#maps",
		title: "Maps",
		children: [
			{
				url: "maps/maps-jqvmap.html",
				title: "Maps by JQVMap",
				description: "Vector map that uses resizable Scalable Vector Graphics (SVG) for modern browsers"
			},
			{
				url: "maps/maps-mapael.html",
				title: "Maps by jQuery Mapael",
				description: "Ease the build of pretty data visualizations on dynamic vector maps."
			},
		]
	},
	{
		url: "typography.html",
		title: "Typography",
		description: "Text styles for heading, emphasize content and context."
	},
	{
		url: "#subPages",
		title: "Pages",
		children: [
			{
				url: "pages/page-profile.html",
				title: "Profile",
				description: "Your profile is <span class=\"text-success\">85%</span> complete. Please <a href=\"#\">complete your profile</a>."
			}
		]
	},
	{
		url: "#",
		title: "Multilevel Menu",
		children: [
			{
				url: "#",
				title: "Submenu 1",
				children: [
					{
						url: "submenu.html",
						title: "Another Menu Level",
						description: "Submenu page in multilevel menu demo" 
					},
					{
						url: "#",
						title: "Another Menu Level",
						description: "Submenu page in multilevel menu demo" 
					},
					{
						url: "#",
						title: "Another Menu Level",
						description: "Submenu page in multilevel menu demo" 
					}
				]
			},
			{
				url: "#",
				title: "Submenu 2"
			},
			{
				url: "#",
				title: "Submenu 3"
			}
		]
	}
];
