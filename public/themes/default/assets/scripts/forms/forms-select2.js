$(function() {

	$('.select-basic').select2();
	
	$('.select-multiple-basic').select2();
	
	$('#select-placeholder-single').select2({
		placeholder: 'Select a state',
		allowClear: true
	});
	
	$('#select-placeholder-multiple').select2({
		placeholder: 'Select a state'
	});

	$('#select-tag').select2({
		tags: true
	});

	$('#select-tag-token').select2({
		tags: true,
		tokenSeparators: [',', ' ']
	});

});