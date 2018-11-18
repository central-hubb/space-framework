$(function() {
	$('#demo-wizard').wizard()
	.on('actionclicked.fu.wizard', function(e, data) {
		//validation
		if( $('#form'+data.step).length ) {
			var parsleyForm = $('#form'+data.step).parsley();
			parsleyForm.validate();

			if( !parsleyForm.isValid() )
				return false;
		}

		//last step button
		$btnNext = $(this).parents('.wizard-wrapper').find('.btn-next');

		if(data.step === 3 && data.direction == 'next') {
			$btnNext.text(' Create My Account')
			.prepend('<i class="fa fa-check-circle"></i>')
			.removeClass('btn-primary').addClass('btn-success');
		}else{
			$btnNext.text('Next ')
			.append('<i class="fa fa-arrow-right"></i>')
			.removeClass('btn-success').addClass('btn-primary');
		}

	}).on('finished.fu.wizard', function(){
		swal(
			'Awesome!',
			'Your account has been created',
			'success'
		).catch(swal.noop);
	});

});