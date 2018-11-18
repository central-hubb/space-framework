$(function() {

	// donut chart
	var data = [
		{ label: "Social",  data: 45},
		{ label: "Referral",  data: 26},
		{ label: "Organic", data: 14},
		{ label: "Others", data: 15}
	];

	$.plot('#traffic-sources-chart', data, {
		series: {
			pie: {
				show: true,
				innerRadius: 0.5,
				stroke: {
					width: 4,
					color: "#F9F9F9"
				},
				label: {
					show: true,
					radius: 3/4,
					formatter: donutLabelFormatter,
				},
			},
		},
		legend: {
			backgroundOpacity: 0
		},
		colors: ["#FF4402", "#AB7DF6", "#F3BB23", "#20B2AA"],
	});

	function donutLabelFormatter(label, series) {
		return "<div class=\"flot-donut-label\">" + Math.round(series.percent) + "%</div>";
	}


	// sales performance chart
	var puzzle = [
		[gt(2013, 10, 21), 188], [gt(2013, 10, 22), 205], [gt(2013, 10, 23), 250], [gt(2013, 10, 24), 230], [gt(2013, 10, 25), 245], [gt(2013, 10, 26), 260], [gt(2013, 10, 27), 290]
	];

	var qrcode = [
		[gt(2013, 10, 21), 100], [gt(2013, 10, 22), 110], [gt(2013, 10, 23), 155], [gt(2013, 10, 24), 120], [gt(2013, 10, 25), 135], [gt(2013, 10, 26), 150], [gt(2013, 10, 27), 175]
	];

	var easypolls = [
		[gt(2013, 10, 21), 75], [gt(2013, 10, 22), 65], [gt(2013, 10, 23), 80], [gt(2013, 10, 24), 60], [gt(2013, 10, 25), 65], [gt(2013, 10, 26), 80], [gt(2013, 10, 27), 110]
	];

	plot = $.plot($('#sales-performance-chart'), 
		[
			{
				data: puzzle,
				label: "Puzzle"
			},
			{
				data: qrcode,
				label: "QRCode"
			},
			{
				data: easypolls,
				label: "EasyPolls"
			}
		], 
		{
			bars: {
				show: true,
				barWidth: 28*60*60*300,
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
				tickColor: "#E4E4E4",
			},
			colors: ["#56B9B7", "#5666B9", "#FF4402"],
			xaxis: {
				mode: "time",
				timezone: "browser",
				minTickSize: [1, "day"],
				timeformat: "%a",
				font: { color: "#676a6d" },
				tickColor: "#fafafa",
				autoscaleMargin: 0.2
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

	function gt(y, m, d) {
		return new Date(y, m-1, d).getTime();
	}


	// project progress bars
	$('.progress .progress-bar').progressbar({
		display_text: 'fill'
	});


});