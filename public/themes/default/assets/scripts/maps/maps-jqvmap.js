$(function() {

	// world map with sample data
	$('#world-map').vectorMap({
		map: 'world_en',
		values: sample_data,
		backgroundColor: 'transparent',
		color: '#f2f4f6',
		borderColor: '#D1D4D7',
		borderOpacity: 0.5,
		scaleColors: ["#E7F5FF", "#9AA9B4"],
		normalizeFunction: 'polynomial',
		onLabelShow: function(event, label, code) {
			if(sample_data[code] !== undefined) {
				label.text(code.toUpperCase() + ': ' + sample_data[code]);
			}
		},
	});

	// USA map with selected regions
	$('#usa-map').vectorMap({
		map: 'usa_en',
		backgroundColor: 'transparent',
		color: '#f2f4f6',
		colors: {
			mo: '#45AEEF',
			fl: '#1DBB8E',
			or: '#F89B03'
		},
		borderColor: '#D1D4D7',
		borderOpacity: 0.5,
		onRegionClick: function(event, code, region){
			alert('You clicked region code ' + code.toUpperCase() + ' (' + region + ')');
		}
	});

	// Europe map with different styles
	$('#europe-map').vectorMap({
		map: 'europe_en',
		backgroundColor: 'transparent',
		color: 'rgba(224,232,216,0.5)',
		borderColor: '#B0C49D',
		borderOpacity: 0.7,
		hoverColor: '#FFEF8E'
	});

	// Russia map
	$('#russia-map').vectorMap({
		map: 'russia_en',
		color: '#fff',
		backgroundColor: '#a5bfdd',
		borderColor: '#647A94',
		borderOpacity: 0.5,
		hoverColor: '#FFF2DD',
		onLoad: function() {
			// set panel body with the same background color
			$(this).parent().css('background-color', '#a5bfdd');
		}
	});

});