$(function() {

	Dropzone.autoDiscover = false;
	
	$('#panel-upload').dropzone({
		url: "php/dropzone-upload.php",
		addRemoveLinks : true,
		maxFilesize: 0.5,
		maxFiles: 5,
		acceptedFiles: 'image/*, application/pdf, .txt',
		dictResponseError: 'File Upload Error.'
	});

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
	/*	PANEL QUICK NOTE
	/*----------------------------------*/

	if($('.quick-note-create').length > 0) {
		$('.quick-note-create textarea, .quick-note-create input').on( 'focusin', function() {
			$(this).attr('rows', 7);
			$('.panel-quick-note').find('.panel-footer').show();
		});

		$('.quick-note-create').on( 'focusout', function() {
			$(this).find('textarea').attr('rows', 1);
			$(this).find('.panel-footer').hide();
		});
	}

	if($('.quick-note').length > 0) {
		$('.quick-note').on( 'click', function() {
			$('#quick-note-modal').modal();
		});
	}

	if($('.quick-note-edit').length > 0) {
		$('.quick-note-edit .btn-save').on( 'click', function() {
			$('#quick-note-modal').modal('hide');
		});
	}

});