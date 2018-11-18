$(function() {
	$('.sortable-grid .sortable-item').sortable({
		connectWith: '.sortable-grid .sortable-item',
		handle: '.panel-heading',
		forcePlaceholderSize: true,
	}).disableSelection();
});