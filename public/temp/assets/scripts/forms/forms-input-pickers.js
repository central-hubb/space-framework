$(function() {
	/*-----------------------------------/
	/*	DATE PICKER
	/*----------------------------------*/

	$('.inline-datepicker').datepicker({
		todayHighlight: true
	});


	/*-----------------------------------/
	/*	COLOR PICKER
	/*----------------------------------*/

	$('#demo-colorpicker1').colorpicker({
		align: 'left'
	});

	$('#demo-colorpicker2').colorpicker({
		align: 'left',
		format: 'rgba'
	});

	$('#demo-colorpicker3').colorpicker();

	$('#demo-colorpicker4').colorpicker({
		colorSelectors: {
			'#000000': '#000000',
			'#00AAFF': '#00AAFF',
			'#41B314': '#41B314',
			'#e4cb10': '#e4cb10',
			'#F9354C': '#F9354C',
			'#5bc0de': '#5bc0de',
			'#777777': '#777777'
		}
	});

	$('#colorpicker-inline').colorpicker({
		color: '#41B314',
		container: true,
		inline: true
	});

	$('#demo-colorpicker5').colorpicker().on('changeColor', function(e) { 
		$('#demo-colorpicker5').css('background-color', e.color.toString( 'rgba')); 
	});


	/*-----------------------------------/
	/*	BOOTSTRAP CLOCK PICKER
	/*----------------------------------*/

	$('.basic-clockpicker').clockpicker({
		donetext: 'DONE',
	});

	var input = $('#single-input').clockpicker({
		placement: 'top',
		autoclose: true,
		'default': 'now'
	});

	$('#check-minutes').click(function(e){
		// Have to stop propagation here
		e.stopPropagation();
		input.clockpicker('show').clockpicker('toggleView', 'minutes');
	});
});