$(function() {
	var plot, visit, val;

	visit = [
		[gt(2013, 1, 1), 200], [gt(2013, 2, 1), 300], [gt(2013, 3, 1), 360], [gt(2013, 4, 1), 340], [gt(2013, 5, 1), 440], [gt(2013, 6, 1), 600], [gt(2013, 7, 1), 1050],
		[gt(2013, 8, 1), 1700], [gt(2013, 9, 1), 1100], [gt(2013, 10, 1), 1200], [gt(2013, 11, 1), 1300], [gt(2013, 12, 1), 1500]
	];

	val = [
		[gt(2013, 1, 1), 100], [gt(2013, 2, 1), 155], [gt(2013, 3, 1), 180], [gt(2013, 4, 1), 172], [gt(2013, 5, 1), 222], [gt(2013, 6, 1), 300], [gt(2013, 7, 1), 550],
		[gt(2013, 8, 1), 452], [gt(2013, 9, 1), 552], [gt(2013, 10, 1), 600], [gt(2013, 11, 1), 680], [gt(2013, 12, 1), 750]
	];

	// Line Chart
	plot = $.plot($('#demo-flot-line-chart'), 
		[
			{
				data: visit,
				label: "Visits"
			},
			{
				data: val,
				label: "Sales"

			}
		], 

		{
			series: {
				lines: {
					show: true,
					lineWidth: 2, 
					fill: false
				},
				points: {
					show: true, 
					lineWidth: 3,
					fill: true,
					fillColor: "#fafafa"
				},
				shadowSize: 0
			},
			grid: {
				hoverable: true, 
				clickable: true,
				borderWidth: 0,
				tickColor: "#f4f4f4",
				
			},
			colors: ["#d9d9d9", "#5399D6"],
			xaxis: {
				mode: "time",
				timezone: "browser",
				minTickSize: [1, "month"],
				font: { color: "#676a6d" },
				tickColor: "transparent",
				autoscaleMargin: 0.02
			},
			yaxis: {
				font: { color: "#676a6d" },
				ticks: 8,
			},
			legend: {
				labelBoxBorderColor: "transparent",
				backgroundColor: "transparent"
			},
			tooltip: true,
			tooltipOpts: {
				content: '%s: %y'
			}
		}
	);

	// Area Chart
	plot = $.plot($('#demo-flot-area-chart'), 
		[
			{
				data: visit,
				label: "Visits",
				lines: {
					show: true,
					lineWidth: 2,
					fill: true,
				},
				points: {
					show: true, 
					lineWidth: 3,
					fill: true,
					fillColor: "#fafafa"
				}
			},
			{
				data: val,
				label: "Sales",
				lines: {
					show: true,
					fill: true
				},
				points: {
					show: true, 
					fill: true,
					fillColor: "#fafafa"
				},
			}
		], 

		{
		series: {
			lines: {
				lineWidth: 2,
				fillColor: { colors: [ { opacity: 0.1 }, { opacity: 0.1 } ] }
			},
			points: {
				lineWidth: 3,
			},

			shadowSize: 0
		},
		grid: {
			hoverable: true, 
			clickable: true,
			borderWidth: 0,
			tickColor: "#f4f4f4"
		},
		colors: ["#7d939a", "#1D92AF"],
		xaxis: {
			mode: "time",
			timezone: "browser",
			minTickSize: [1, "day"],
			timeformat: "%a",
			font: { color: "#676a6d" },
			tickColor: "transparent",
			autoscaleMargin: 0.02
		},
		yaxis: {
			font: { color: "#676a6d" },
			tickColor: "transparent",
			ticks: 8
		},
		legend: {
			labelBoxBorderColor: "transparent",
			backgroundColor: "transparent"
		},
		tooltip: true,
		tooltipOpts: {
			content: '%s: %y'
		}

	});


	// Vertical Bar Chart
	var basic = [
		[gt(2013, 10, 21), 188], [gt(2013, 10, 22), 205], [gt(2013, 10, 23), 250], [gt(2013, 10, 24), 230], [gt(2013, 10, 25), 245], [gt(2013, 10, 26), 260], [gt(2013, 10, 27), 290]
	];

	var gold = [
		[gt(2013, 10, 21), 100], [gt(2013, 10, 22), 110], [gt(2013, 10, 23), 155], [gt(2013, 10, 24), 120], [gt(2013, 10, 25), 135], [gt(2013, 10, 26), 150], [gt(2013, 10, 27), 175]
	];

	var platinum = [
		[gt(2013, 10, 21), 75], [gt(2013, 10, 22), 65], [gt(2013, 10, 23), 80], [gt(2013, 10, 24), 60], [gt(2013, 10, 25), 65], [gt(2013, 10, 26), 80], [gt(2013, 10, 27), 110]
	];

	plot = $.plot($('#demo-flot-vertical-bar-chart'), 
		[
			{
				data: basic,
				label: "Basic"
			},
			{
				data: gold,
				label: "Gold"
			},
			{
				data: platinum,
				label: "Platinum"
			}
		], 
		{
			bars: {
				show: true,
				barWidth: 15*60*60*300,
				align: "center",
				fill: true,
				order: true,
				lineWidth: 0,
				fillColor: { colors: [ { opacity: 1 }, { opacity: 1 } ] }
			},
			grid: {
				hoverable: true, 
				clickable: true,
				borderWidth: 0,
				tickColor: "#f4f4f4",
			},
			colors: ["#d9d9d9", "#5399D6", "#d7ea2b"],
			xaxis: {
				mode: "time",
				timezone: "browser",
				minTickSize: [1, "day"],
				timeformat: "%a",
				font: { color: "#676a6d" },
				tickColor: "transparent",
				autoscaleMargin: 0.2
			},
			yaxis: {
				font: { color: "#676a6d" },
				tickColor: "#f4f4f4",
				ticks: 8,
			},
			legend: {
				labelBoxBorderColor: "transparent",
				backgroundColor: "transparent"
			},
			tooltip: true,
			tooltipOpts: {
				content: '%s: %y'
			}
		}
	);

	// Horizontal Bar Chart
	var productA = [
		[220, 1], [180, 2], [225, 3], [240, 4], [250, 5]
	];

	var productB = [
		[190, 1], [160, 2], [180, 3], [200, 4], [210, 5]
	];

	var productC = [
		[100, 1], [90, 2], [150, 3], [120, 4], [145, 5]
	];

	plot = $.plot($('#demo-flot-horizontal-bar-chart'), 
		[
			{
				data: productA,
				label: "Product A"
			},
			{
				data: productB,
				label: "Product B"
			},
			{
				data: productC,
				label: "Product C"
			}
		], 
		{
			bars: {
				show: true,
				horizontal: true,
				barWidth: 0.2,
				align: "center",
				fill: true,
				order: true,
				fillColor: { colors: [ { opacity: 1 }, { opacity: 1 } ] }
			},
			grid: {
				hoverable: true, 
				clickable: true,
				borderWidth: 0,
				tickColor: "#f4f4f4",
			},
			colors: ["#d9d9d9", "#5399D6", "#d7ea2b"],
			xaxis: {
				autoscaleMargin: 0.2,
				font: { color: "#676a6d" }
			},
			yaxis: {
				font: { color: "#676a6d" },
			},
			legend: {
				labelBoxBorderColor: "transparent",
				backgroundColor: "transparent"
			},
			tooltip: true,
			tooltipOpts: {
				content: '%s: %x'
			}
		}
	);

	// Multiple Charts
	visit = [
		[gt(2013, 10, 1), 100], [gt(2013, 10, 2), 140], [gt(2013, 10, 3), 160], [gt(2013, 10, 4),190], [gt(2013, 10, 5),170], [gt(2013, 10, 6), 200], [gt(2013, 10, 7), 220],
		[gt(2013, 10, 8), 250], [gt(2013, 10, 9),280], [gt(2013, 10, 10), 240], [gt(2013, 10, 11), 250], [gt(2013, 10, 12), 260], [gt(2013, 10, 13), 220], [gt(2013, 10, 14), 280],
		[gt(2013, 10, 15), 300]
	];

	val = [
		[gt(2013, 10, 1), 20], [gt(2013, 10, 2), 28], [gt(2013, 10, 3), 32], [gt(2013, 10, 4), 40], [gt(2013, 10, 5), 35], [gt(2013, 10, 6), 40], [gt(2013, 10, 7), 45],
		[gt(2013, 10, 8), 25], [gt(2013, 10, 9), 60], [gt(2013, 10, 10), 48], [gt(2013, 10, 11), 53], [gt(2013, 10, 12), 58], [gt(2013, 10, 13), 60], [gt(2013, 10, 14), 65],
		[gt(2013, 10, 15), 66]
	];

	plot = $.plot($('#demo-flot-multi-types-chart'), 
		[
			{
				data: visit,
				label: "Visits",
				bars: {
					show: true,
					fill: false,
					barWidth: 0.1,
					align: "center",
					lineWidth: 18
				}
			},
			{
				data: val,
				label: "Sales"
			}
		], 

		{
			series: {
				lines: {
					show: true,
					lineWidth: 2, 
					fill: false
				},
				points: {
					show: true, 
					lineWidth: 3,
					fill: true,
					fillColor: "#fafafa"
				},
				shadowSize: 0
			},
			grid: {
				hoverable: true, 
				clickable: true,
				borderWidth: 0,
				tickColor: "#f4f4f4",
			},
			colors: ["rgba(14, 155, 226, 0.2)", "#5399D6"],
			xaxis: {
				mode: "time",
				timezone: "browser",
				minTickSize: [1, "day"],
				font: { color: "#676a6d" },
				tickColor: "transparent",
				autoscaleMargin: 0.02
			},
			yaxis: {
				font: { color: "#676a6d" },
				ticks: 8,
			},
			legend: {
				labelBoxBorderColor: "transparent",
				backgroundColor: "transparent"
			},
			tooltip: true,
			tooltipOpts: {
				content: '%s: %y'
			}
		}
	); 

	// Donut Chart
	var data = [
		{ label: "Direct",  data: 65},
		{ label: "Referral",  data: 20},
		{ label: "Others", data: 15}
	];

	$.plot('#demo-flot-donut-chart', data, {
		series: {
			pie: {
				show: true,
				innerRadius: 0.4,
				stroke: {
					width: 4,
					color: "#F9F9F9"
				},
				label: {
					show: true,
					radius: 3/4,
					formatter: donutLabelFormatter
				}
			},
		},
		legend: {
			show: false
		},
		grid: {
			hoverable: true
		},
		colors: ["#7d939a", "#5399D6", "#d7ea2b"],
	});

	// get day function
	function gt(y, m, d) {
		return new Date(y, m-1, d).getTime();
	}

	function donutLabelFormatter(label, series) {
		return "<div class=\"flot-donut-label\">" + label + "<br/>" + Math.round(series.percent) + "%</div>";
	}

});