$(function() {
	//defaults
	$.fn.editable.defaults.url = '/post';

	$('#username').editable();
	$('#lastname').editable({
		validate: function(value) {
			if($.trim(value) === '') return 'This field is required';
		}
	});

	$('#sex').editable({
		prepend: "not selected",
		source: [
			{value: 1, text: 'Male'},
			{value: 2, text: 'Female'}
		],
		display: function(value, sourceData) {
			 var colors = {"": "gray", 1: "orange", 2: "red"},
				 elem = $.grep(sourceData, function(o){return o.value == value;});
				 
			 if(elem.length) {
				 $(this).text(elem[0].text).css("color", colors[value]);
			 } else {
				 $(this).empty();
			 }
		}
	});

	$('#group').editable({
		showbuttons: false
	});

	$('#status').editable();

	$('#dob').editable({
		format: 'yyyy-mm-dd',
			viewformat: 'dd/mm/yyyy',
			datepicker: {
				weekStart: 1
			}
	});

	$('#combodate').editable();

	$('#event').editable({
		placement: 'right',
		combodate: {
			firstItem: 'name'
		}
	});

	$('#comments').editable({
		showbuttons: 'bottom'
	});

	$('#state2').editable({
		value: 'California',
		typeahead: {
			name: 'state',
			local: ["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]
		}
	});

	$('#fruits').editable({
		pk: 1,
		limit: 3,
		source: [
			{value: 1, text: 'banana'},
			{value: 2, text: 'peach'},
			{value: 3, text: 'apple'},
			{value: 4, text: 'watermelon'},
			{value: 5, text: 'orange'}
		]
	});

	var mode = getURLParameter('mode');
	if(mode === undefined) mode = 'Popup';

	$('input[name=mode]').val([mode]);
	checkEditableMode(mode);

	$('#editable-options').on('change', function() {
		var selectedMode = $('input[name=mode]:checked').val();
		window.location.href="?mode=" + selectedMode;
	});

	$('#state').click(function() {
		$('#editable-demo .editable').editable('toggleDisabled');
	});

	$('#address').editable({
		url: '/post',
		value: {
			city: "Moscow",
			street: "Lenina",
			building: "12"
		},
		validate: function(value) {
			if(value.city === '') return 'city is required!'; 
		},
		display: function(value) {
			if(!value) {
				$(this).empty();
				return; 
			}
			var html = '<b>' + $('<div>').text(value.city).html() + '</b>, ' + $('<div>').text(value.street).html() + ' st., bld. ' + $('<div>').text(value.building).html();
			$(this).html(html); 
		}
	});

	function checkEditableMode(selectedMode) {
		if(selectedMode == 'Inline') {
			$('#editable-demo .editable').editable('option', 'mode', 'inline');
		} else {
			$('#editable-demo .editable').editable('option', 'mode', 'popup');
		}
	}

	function getURLParameter(sParam) {
		var sPageURL = window.location.search.substring(1);
		var sURLVariables = sPageURL.split('&');

		for (var i = 0; i < sURLVariables.length; i++) {
			var sParameterName = sURLVariables[i].split('=');
			if (sParameterName[0] == sParam) {
				return sParameterName[1];
			}
		}
	}
});