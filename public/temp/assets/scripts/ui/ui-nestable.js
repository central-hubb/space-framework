$(function() {

	// nestable
	$('#nestable1').nestable()
	.on('change', function() {
		$('#outputDD1').text(window.JSON.stringify($('#nestable1').nestable('serialize')));
	});

	$('#outputDD1').text(window.JSON.stringify($('#nestable1').nestable('serialize')));

	$('#nestable2').nestable()
	.on('change', function() {
		$('#outputDD2').text(window.JSON.stringify($('#nestable2').nestable('serialize')));
	});

	$('#outputDD2').text(window.JSON.stringify($('#nestable2').nestable('serialize')));

	// button actions
	$('#btn-expand').on('click', function() {
		$('.dd').nestable('expandAll');
	});

	$('#btn-collapse').on('click', function() {
		$('.dd').nestable('collapseAll');
	});
});