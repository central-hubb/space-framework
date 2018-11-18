$(function() {

	/*-----------------------------------/
	/*	SLIDER INPUTS (Bootstrap Slider)
	/*----------------------------------*/

	var sliderChanged = function() {
		$('.label-slider').text( theSlider.getValue() );
	};

	var theSlider = $('.bootstrap-slider')
		.slider({
			min: 0,
			max: 500,
			value: 120,
			tooltip: 'hide',
			handle: 'square'
		}).on('slide', sliderChanged).data('slider');

	$('.label-slider').text( theSlider.getValue() );

	var theStepSlider = $('.bootstrap-slider-step')
	.slider({
		min: 0,
		max: 500,
		value: 150,
		step: 50,
		handle: 'square'
	});


	/*-----------------------------------/
	/*	SLIDER INPUTS (noUiSlider)
	/*----------------------------------*/

	// default slider
	var nouislider1 = $('#nouislider1')[0]; // same as document.getElementById('nouislider1');
	noUiSlider.create(nouislider1, {
		start: [100],
		connect: [true, false],
		range: {
			'min': 0,
			'max': 1000
		},
		format: wNumb({
			decimals: 0
		})
	});

	var input1 = $('#input-nouislider1');
	nouislider1.noUiSlider.on('update', function(values, handle) {
		input1.val(values[handle]);
	});

	input1.on('change', function() {
		nouislider1.noUiSlider.set(this.value);
	});

	// slider with custom format
	var nouislider2 = $('#nouislider2')[0];
	noUiSlider.create(nouislider2, {
		start: [10000],
		connect: [true, false],
		range: {
			'min': [2000],
			'max': [50000]
		},
		format: wNumb({
			thousand: '.',
			prefix: '$ '
		})
	});

	var input2 = $('#input-nouislider2');
	nouislider2.noUiSlider.on('update', function(values, handle) {
		input2.val(values[handle]);
	});

	input2.on('change', function() {
		nouislider2.noUiSlider.set(this.value);
	});

	// range slider
	var nouislider3 = $('#nouislider3')[0];
	noUiSlider.create(nouislider3, {
		start: [4000, 8000],
		connect: true,
		tooltips: [wNumb({decimals: 0}), wNumb({decimals: 0})],
		range: {
			'min': [2000],
			'max': [10000]
		}
	});

	// slider with step
	var nouislider4 = $('#nouislider4')[0];
	noUiSlider.create(nouislider4, {
		start: [100],
		step: 100,
		connect: [true, false],
		range: {
			'min': 0,
			'max': 1000
		}
	});

	// draggable slider
	var nouislider5 = $('#nouislider5')[0];
	noUiSlider.create(nouislider5, {
		start: [4000, 6000],
		connect: true,
		behaviour: 'drag',
		range: {
			'min': [2000],
			'max': [10000]
		}
	});

	// draggable slider with fixed handles
	var nouislider6 = $('#nouislider6')[0];
	noUiSlider.create(nouislider6, {
		start: [6000, 8000],
		connect: true,
		behaviour: 'drag-fixed',
		range: {
			'min': [2000],
			'max': [10000]
		}
	});

	// default slider
	var nouislider7 = $('#nouislider7')[0];
	noUiSlider.create(nouislider7, {
		start: [300],
		range: {
			'min': 0,
			'max': 1000
		}
	});
});