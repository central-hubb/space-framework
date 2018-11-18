$(function() {

	/* -----------------------
	 * PROJECT DETAILS
	 * ----------------------*/

	// project progress
	if($('#project-progress .progress-bar').length) {
		$('#project-progress .progress-bar').progressbar({
			display_text: 'fill'
		});

		// accordion toggle collapse
		$('.project-accordion [data-toggle="collapse"]').on('click', function() {
			$(this).find('.toggle-icon').toggleClass('fa-minus-circle fa-plus-circle');
		});
	}

});



