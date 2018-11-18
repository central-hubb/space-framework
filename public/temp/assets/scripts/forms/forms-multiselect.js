$(function() {
	/*-----------------------------------/
	/*	MULTISELECT
	/*----------------------------------*/

	$('#multiselect1, #multiselect2, #single-selection, #multiselect5, #multiselect6').multiselect({
		maxHeight: 300
	});

	$('#multiselect3-all').multiselect({
		includeSelectAllOption: true,
	});

	$('#multiselect4-filter').multiselect({
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		maxHeight: 200
	});

	$('#multiselect-size').multiselect({
		buttonClass: 'btn btn-default btn-sm'
	});

	$('#multiselect-link').multiselect({
		buttonClass: 'btn btn-link'
	});

	$('#multiselect-color').multiselect({
		buttonClass: 'btn btn-primary'
	});

	$('#multiselect-color2').multiselect({
		buttonClass: 'btn btn-success'
	});

});