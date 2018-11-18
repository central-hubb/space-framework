$(function() {
	var options;

	var data = {
		labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		series: [
			[200, 380, 350, 320, 410, 450, 570, 400, 555, 620, 750, 900],
		]
	};

	// line chart
	options = {
		height: "300px",
		showPoint: true,
		axisX: {
			showGrid: false
		},
		lineSmooth: false,
	};

	new Chartist.Line('#demo-line-chart', data, options);

	// bar chart
	options = {
		height: "300px",
		axisX: {
			showGrid: false
		},
	};

	new Chartist.Bar('#demo-bar-chart', data, options);


	// area chart
	options = {
		height: "270px",
		showArea: true,
		showLine: false,
		showPoint: false,
		axisX: {
			showGrid: false
		},
		lineSmooth: false,
	};

	new Chartist.Line('#demo-area-chart', data, options);


	// multiple chart
	var data = {
		labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		series: [
			{
				name: 'series-real',
				data: [200, 380, 350, 320, 410, 450, 570, 400, 555, 620, 750, 900],
			},
			{
				name: 'series-projection',
				data: [240, 350, 360, 380, 400, 450, 480, 523, 555, 600, 700, 800],
			}
		]
	};

	var options = {
		fullWidth: true,
		lineSmooth: false,
		height: "270px",
		low: 0,
		high: 'auto',
		series: {
			'series-projection': {
				showArea: true,
				showPoint: false,
				showLine: false
			},
		},
		axisX: {
			showGrid: false,

		},
		axisY: {
			showGrid: false,
			onlyInteger: true,
			offset: 0,
		},
		chartPadding: {
			left: 20,
			right: 20
		}
	};

	new Chartist.Line('#multiple-chart', data, options);

});