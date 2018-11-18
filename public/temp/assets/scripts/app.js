/* -----------------
 * SETTINGS
 * -----------------*/

$.viewsDirectory = 'views/';
$.defaultView = 'dashboards/dashboard.html';
$.mainView = $('#main-view');
$.viewBreadcrumb = $('#view-breadcrumb');

'use strict';

/* -----------------
 * LOAD JS
 * -----------------*/

function loadJS(requiredJS) {
	$('script').not('.default-js').each(function() {
		$(this).remove();
	});

	for(var i = 0; i<requiredJS.length;i++){
		var body = document.getElementsByTagName('body')[0];
		var script = document.createElement('script');
		script.type = 'text/javascript';
		script.async = false;
		script.src = requiredJS[i];
		body.appendChild(script);
	}
}

/* -----------------
 * LOAD CSS
 * -----------------*/

function loadCSS(requiredCSS) {
	// clean any previous styles
	$('link[rel="stylesheet"]').not('.default-style').each(function() {
		$(this).remove();
	});

	$.each(requiredCSS, function(index, path) {
		var stylesheet = $('<link>', { 
			rel: 'stylesheet',
			type: 'text/css',
			href: path
		});

		stylesheet.insertBefore($('#main-style'));
	});
}


/* -----------------
 * VIEW LOAD
 * -----------------*/

var paceOptions = {
	elements: false,
	restartOnRequestAfter: false
}

if (window.location.href.indexOf("index-topnav.html") > -1) {
	loadView('dashboards/dashboard4.html');
} else if(window.location.href.indexOf("index-minified.html") > -1) {
	loadView('layouts/layout-minified.html');
} else if(window.location.href.indexOf("index-fullwidth.html") > -1) {
	loadView('layouts/layout-fullwidth.html');
} else {
	setTitleDescription($.defaultView);
	loadView($.defaultView);
}

$('#sidebar-nav-menu a[href*=".html"]').on('click', function(e) {
	e.preventDefault();

	setTitleDescription($(this).attr('href'));
	setupActiveMenu($(this));
	buildBreadcrumbs($(this));

	if($(this).attr('target') === '_blank') {
		window.location = $(this).attr('href');
	} else {
		loadView($(this).attr('href'));
	}
});

function setTitleDescription(viewUrl) {
	var menuObj = getMenuObj(arrMainNav, viewUrl);

	if(menuObj) {
		$('#view-title').html(menuObj.title);
		$('#view-description').html(menuObj.description);
	}
}

function setupActiveMenu(link) {
	$('#sidebar-nav-menu a').removeClass('active');
	link.addClass('active');
	link.parents('.panel').find('> a').addClass('active');
}

function buildBreadcrumbs(link) {
	var linkText;

	// reset breadcrumb first
	$.viewBreadcrumb.find('li').not('.home').remove();

	// if submenu
	if(link.parents('.submenu').hasClass('submenu')) {
		link.parents('.panel').find('> a').each(function() {
			$.viewBreadcrumb.append('<li><a href="' + $(this).attr('href') + '">' + $(this).text() + '</a></li>');
		});

		linkText = link.clone().children().remove().end().text();
	} else {
		linkText = link.find('.title').text();
	}

	$.viewBreadcrumb.append('<li class="active">' + linkText + '</li>');
}


var menuObj;
function getMenuObj(arrMenu, url) {
	$.each(arrMenu, function(index, value) {
		if(value.children !== undefined) {
			getMenuObj(value.children, url);
		} else {
			if(value.url === url) {
				menuObj = {
					url: value.url,
					title: value.title,
					description: value.description
				};
			}
		}
	});

	return menuObj;
}

function loadView(viewUrl) {
	$.ajax({
		type: 'GET',
		url: $.viewsDirectory + viewUrl,
		dataType: 'html',
		cache: false,
		async: false,
		beforeSend: function() {
			$('body > div').not('#wrapper, .pace').remove();
			$.mainView.css({ opacity: 0 });
		},
		success: function() {
			$.mainView.load($.viewsDirectory + viewUrl, null, function(responseText) {
				window.location.hash = viewUrl;

				// if main content is shorter than sidebar
				if($('.main').innerHeight() < $('#sidebar-nav').innerHeight()) {
					$('.main').css('min-height', $('#sidebar-nav').innerHeight());
					$navbarHeight = $('.navbar').innerHeight();
					$('.main-content').css('height', 'calc(100vh - ' + $navbarHeight + 'px)');
					$('footer').css('position', 'absolute');
				} else {
					$('.main').css('min-height', '');
					$('.main-content').css('height', '');
					$('footer').css('position', '');
				}

				// make full height for layout top navigation
				if($('body').hasClass('layout-topnav')) {
					
					$footerHeight = $('footer').innerHeight();
					$('.main').css('min-height', 'calc(100vh - ' + $footerHeight + 'px)');
				}

			}).delay(250).animate({ opacity: 1 });
		},
		error: function() {
		}
	});
}


/* -----------------
 * COMMONS
 * -----------------*/

$(document).ready(function() {
	/*-----------------------------------/
	/*	TOP NAVIGATION AND LAYOUT
	/*----------------------------------*/

	// toggle fullwidth
	$('.btn-toggle-fullwidth').on('click', function() {
		if(!$('body').hasClass('layout-fullwidth')) {
			$('body').addClass('layout-fullwidth');

		} else {
			$('body').removeClass('layout-fullwidth');
			$('body').removeClass('layout-default'); // also remove default behaviour if set
		}

		$(this).find('i').toggleClass('ti-arrow-circle-left ti-arrow-circle-right');

		if($(window).innerWidth() < 1025) {
			if(!$('body').hasClass('offcanvas-active')) {
				$('body').addClass('offcanvas-active');
			} else {
				$('body').removeClass('offcanvas-active');
			}
		}
	});

	$('.btn-toggle-minified').on('click', function() {
		$('body').toggleClass('sidebar-minified');

		// toggle collapse functionality
		if($('body').hasClass('sidebar-minified')) {
			$('.sidebar a[data-toggle]').attr('data-toggle', "");
		} else {
			$('.sidebar a[data-toggle]').attr('data-toggle', "collapse");
		}
	});

	// needed to stop resize event propagated to jquery.flot.resize.js
	$('body').on('resize', function(e) {
		e.stopPropagation();
	});

	// toggle right sidebar
	$('.btn-toggle-rightsidebar').on('click', function() {
		if(!$('.right-sidebar').hasClass('active')) {
			$('.right-sidebar').addClass('active');
		} else {
			$('.right-sidebar').removeClass('active');
		}
	});

	var defaultLayout = '';
	
	// check if layout origin/default is minified
	if($('body').hasClass('sidebar-minified')) {
		defaultLayout = 'minified';
		$('.sidebar a[data-toggle="collapse"]').attr('data-toggle', "");
	}

	$(window).on('load', function() {
		if($(window).innerWidth() < 1025) {
			$('.btn-toggle-fullwidth').find('i')
			.removeClass('ti-arrow-circle-left')
			.addClass('ti-arrow-circle-right');
		}

		// adjust right sidebar top position
		$('.right-sidebar').css('top', $('.navbar').innerHeight());

		// if page has content-menu, set top padding of main-content
		if($('.has-content-menu').length > 0) {
			$('.navbar + .main-content').css('padding-top', $('.navbar').innerHeight());
		}

	});

	$(window).on('load resize', function() {
		if($(this).innerWidth() < 1025) {

			if(defaultLayout === 'minified'){
				// remove minified sidebar mode
				$('body').removeClass('sidebar-minified'); 
				$('.brand img.logo').attr('src', 'assets/img/logo-white.png');
				$('.sidebar a[data-toggle=""]').attr('data-toggle', "collapse");
			}
		} else if(!$('body').hasClass('layout-default')){
			$('body').removeClass('layout-fullwidth');

			if(defaultLayout === 'minified') {
				// set back to minified sidebar mode
				$('body').addClass('sidebar-minified');
				$('.sidebar a[data-toggle="collapse"]').attr('data-toggle', "");
			}
		}

		// handle navbar dropdown submenu on mobile view
		$('.navbar-nav .dropdown-sub [data-toggle="dropdown"]').on('click', function(e) {
			$(this).parent().toggleClass('open');
			e.preventDefault();
			e.stopPropagation();
		});
	});

	// search form
	$('.navbar-form.search-form input[type="text"]')
	.on('focus', function() {
		$(this).animate({
			width: '+=50px'
		}, 300);
	})
	.on('focusout', function() {
		$(this).animate({
			width: '-=50px'
		}, 300);
	});


	/*-----------------------------------/
	/*	SIDEBAR NAVIGATION
	/*----------------------------------*/

	$('.sidebar a[data-toggle="collapse"]').on('click', function(e) {
		e.preventDefault();
	});


	/*-----------------------------------/
	/*	CONTENT MENU
	/*----------------------------------*/
	
	if( $('.content-menu').length > 0 ) {
		$('.btn-open-content-menu').on('click', function() {
			$('.content-menu-left').css('left', 0);
		});

		$('.btn-close-content-menu').on('click', function() {
			$('.content-menu-left').css('left', -300);
		});

		$('.inbox-list-message > li').on('click', function() {
			$('.content-right').show('medium');
		});

		$('.btn-close-content-right').on('click', function() {
			$('.content-right').hide('medium');
		});
	}

	
	/*-----------------------------------/
	/*	PANEL FUNCTIONS
	/*----------------------------------*/

	// panel remove
	$('.panel .btn-remove').click(function(e){

		e.preventDefault();
		$(this).parents('.panel').fadeOut(300, function(){
			$(this).remove();
		});
	});

	// panel collapse/expand
	var affectedElement = $('.panel-body');

	$('.panel .btn-toggle-collapse').clickToggle(
		function(e) {
			e.preventDefault();

			// if has scroll
			if( $(this).parents('.panel').find('.slimScrollDiv').length > 0 ) {
				affectedElement = $('.slimScrollDiv');
			}

			$(this).parents('.panel').find(affectedElement).slideUp(300);
			$(this).find('i').toggleClass('fa-minus fa-plus');
		},
		function(e) {
			e.preventDefault();

			// if has scroll
			if( $(this).parents('.panel').find('.slimScrollDiv').length > 0 ) {
				affectedElement = $('.slimScrollDiv');
			}

			$(this).parents('.panel').find(affectedElement).slideDown(300);
			$(this).find('i').toggleClass('fa-minus fa-plus');
		}
	);

	// panel refresh
	if( $('.btn-panel-refresh').length > 0 ) {
		$('.btn-panel-refresh').on('click', function() {
			$('.overlay-refresh').fadeIn(300);

			setTimeout( function() {
				$('.overlay-refresh').fadeOut(300);
			}, 1500);
		});
	}


	/*-----------------------------------/
	/*	PANEL SCROLLING
	/*----------------------------------*/

	if( $('.panel-scrolling').length > 0) {
		$('.panel-scrolling .panel-body').slimScroll({
			height: '430px',
			wheelStep: 2,
			color: 'rgba(160, 174, 186, .4)'
		});
	}

	if( $('#panel-scrolling-demo').length > 0) {
		$('#panel-scrolling-demo .panel-body').slimScroll({
			height: '150px',
			wheelStep: 2,
			color: 'rgba(160, 174, 186, .4)'
		});
	}


	/*-----------------------------------/
	/* BOOTSTRAP TOOLTIP INIT
	/*----------------------------------*/

	if($('[data-toggle="tooltip"]').length > 0) {
		$('[data-toggle="tooltip"]').tooltip();
	}
});

// toggle function
$.fn.clickToggle = function( f1, f2 ) {
	return this.each( function() {
		var clicked = false;
		$(this).bind('click', function() {
			if(clicked) {
				clicked = false;
				return f2.apply(this, arguments);
			}

			clicked = true;
			return f1.apply(this, arguments);
		});
	});

};



