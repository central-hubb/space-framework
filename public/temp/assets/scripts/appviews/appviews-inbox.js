$(function() {
	/* -----------------------
	 * INBOX
	 * ----------------------*/

	$('body').addClass('sidebar-minified has-content-menu page-inbox');

	if($('#list-message-scrollable').length) {
		$('#list-message-scrollable').slimScroll({
			height: '550px',
			wheelStep: 1,
			color: '#cecece'
		});
	}

});