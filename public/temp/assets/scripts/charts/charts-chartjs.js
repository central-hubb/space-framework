$(function() {
	
	// general config and options
	Chart.defaults.global.defaultFontColor = '#a0aeba';
	var chartLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
	var chartData = [123, 129, 124, 130, 132, 139, 140];
	var chartData2 = [125, 127, 123, 132, 129, 138, 144];
	var chartData3 = [-90, -70, -40, 35, 50, 70, 90];
	var chartData4 = [-20, -50, -20, 15, 30, 50, 70];

	var scalesOptions = {
		xAxes: [{
			gridLines: { display: false }
		}],
		yAxes: [{
			gridLines: { 
				color: '#eff3f6', 
				drawBorder: false,
			},
		}]
	};

	// line chart
	var ctxLineChart = document.getElementById("line-chart").getContext("2d");
	var lineChart = new Chart(ctxLineChart, {
		type: 'line',
		data: {
			labels: chartLabels,
			datasets: [
				{
					data: chartData,
					label: 'Data 1',
					fill: false,
					borderWidth: 2,
					pointRadius: 3,
					pointHoverRadius: 5,
					borderColor: '#45aeef',
					backgroundColor: '#fff',
				},
				{
					data: chartData2,
					label: 'Data 2',
					fill: false,
					borderWidth: 2,
					borderDash: [5, 5],
					pointRadius: 3,
					pointHoverRadius: 5,
					borderColor: '#f89b03',
					backgroundColor: '#fff'
				}
			]
		},
		options: {
			responsive: true,
			scales: scalesOptions,
		}
	});

	$('#straightLine').on('change', function() {
		lineChart.options.elements.line.tension = $(this).is(':checked') ? 0.000001 : 0.4;
		lineChart.update();
	});

	$('#diamondPoint').on('change', function() {
		lineChart.options.elements.point.pointStyle = $(this).is(':checked') ? 'rectRot' : 'circle';
		lineChart.update();
	});

	$('#stepped').on('change', function() {
		lineChart.options.elements.line.stepped = $(this).is(':checked') ? true : false;;
		lineChart.update();
	});

	// bar chart
	var ctxBarChart = document.getElementById("bar-chart").getContext("2d");
	var barChart = new Chart(ctxBarChart, {
		type: 'bar',
		data: {
			labels: chartLabels,
			datasets: [
				{
					data: chartData3,
					label: 'Data',
					borderColor: 'transparent',
					backgroundColor: 'rgba(1,153,248,.50)'
				}
			]
		},
		options: {
			responsive: true,
			scales: scalesOptions,
		}
	});

	$('#addRemoveBarDataset').on('change', function() {
		// console.log('adding');
		var newBarDataset = {
			data: chartData4,
			label: 'Newly Added Data',
			borderColor: 'transparent',
			backgroundColor: 'rgba(248,155,2,0.50)',
		};

		if( $(this).is(':checked') ) {
			console.log('checked');
			barChart.data.datasets.push(newBarDataset);
		} else {
			barChart.data.datasets.pop();
		}

		barChart.update();
	});

	// area chart
	var ctxAreaChart = document.getElementById("area-chart").getContext("2d");
	var areaChart = new Chart(ctxAreaChart, {
		type: 'line',
		data: {
			labels: chartLabels,
			datasets: [
				{
					data: chartData2,
					label: 'Data 1',
					backgroundColor: 'rgba(0, 183, 253, .25)',
					borderColor: 'rgb(0, 183, 253)',
					borderWidth: 2,
				},
			],
		},
		options: {
			responsive: true,
			scales: scalesOptions,
			elements: {
				point: {
					radius: 2,
				},
			},
			legend: {
				position: 'right'
			}
		}
	});

	$('#straightArea').on('change', function() {
		areaChart.options.elements.line.tension = $(this).is(':checked') ? 0.000001 : 0.4;
		areaChart.update();
	});

	$('#addRemoveAreaDataset').on('change', function() {
		var newDataset = {
			data: chartData,
			label: 'Data 2',
			backgroundColor: 'rgba(248,155,2,0.50)',
			borderColor: 'rgb(248,155,2)',
			borderWidth: 2,
		};

		if( $(this).is(':checked') ) {
			areaChart.data.datasets.push(newDataset);
		} else {
			areaChart.data.datasets.pop();
		}

		areaChart.options.scales.yAxes.stacked = true;
		areaChart.update();
	});

	
	// donut chart
	var ctxDonutChart = document.getElementById("donut-chart").getContext("2d");
	var donutChart = new Chart(ctxDonutChart, {
		type: 'doughnut',
		data: {
			labels: chartLabels,
			datasets: [
				{
					data: chartData,
					backgroundColor: ['#4A90E2', '#7CAC25', '#FF4402', '#AB7DF6', '#F3BB23', '#20B2AA', '#1DBB8E'],
				}
				
			]
		},
		options: {
			responsive: true,
			legend: {
				position: 'right',
			},
		}
	});

	$('#addRemoveDonutDataset').on('change', function() {
		var newDataset = {
			data: chartData2,
			backgroundColor: ['#4A90E2', '#7CAC25', '#FF4402', '#AB7DF6', '#F3BB23', '#20B2AA', '#1DBB8E'],
		};

		if( $(this).is(':checked') ) {
			donutChart.data.datasets.push(newDataset);
		} else {
			donutChart.data.datasets.pop();
		}

		donutChart.update();
	});

	
	// pie chart
	var ctxPieChart = document.getElementById("pie-chart").getContext("2d");
	var pieChart = new Chart(ctxPieChart, {
		type: 'pie',
		data: {
			labels: chartLabels,
			datasets: [
				{
					data: chartData,
					backgroundColor: ['#4A90E2', '#7CAC25', '#FF4402', '#AB7DF6', '#F3BB23', '#20B2AA', '#1DBB8E'],
				}
			]
		},
		options: {
			responsive: true,
			legend: {
				position: 'left',
			},
		}
	});

	$('#addRemovePieDataset').on('change', function() {
		var newDataset = {
			data: chartData2,
			backgroundColor: ['#4A90E2', '#7CAC25', '#FF4402', '#AB7DF6', '#F3BB23', '#20B2AA', '#1DBB8E'],
		};

		if( $(this).is(':checked') ) {
			pieChart.data.datasets.push(newDataset);
		} else {
			pieChart.data.datasets.pop();
		}

		pieChart.update();
	});


	// radar chart
	var ctxRadarChart = document.getElementById("radar-chart").getContext("2d");
	var radarChart = new Chart(ctxRadarChart, {
		type: 'radar',
		data: {
			labels: ['HTML', 'CSS', 'Javascript', 'Angular', 'ReactJS'],
			datasets: [
				{
					label: 'Skills',
					data: [90, 65, 75, 90, 75],
					backgroundColor: 'rgba(248,155,2,0.50)',
					borderColor: 'rgb(248,155,2)',
					pointBackgroundColor: 'rgb(248,155,2)',
					borderWidth: 2
				}
			]
		},
		options: {
			legend: {
				position: 'top'
			},
			scale: {
				ticks: {
					beginAtZero: true
				}
			},
		}
	});
	
	$('#addRemoveRadarDataset').on('change', function() {
		var newDataset = {
			label: 'Average',
			data: [85, 75, 70, 80, 90],
			backgroundColor: 'rgba(0, 183, 253, .25)',
			borderColor: 'rgb(0, 183, 253)',
			borderWidth: 2
		};

		if( $(this).is(':checked') ) {
			radarChart.data.datasets.push(newDataset);
		} else {
			radarChart.data.datasets.pop();
		}

		radarChart.update();
	});


	// polar chart
	var ctxPolarChart = document.getElementById("polar-chart").getContext("2d");
	var polarChart = Chart.PolarArea(ctxPolarChart, {
		data: {
			labels: chartLabels,
			datasets: [
				{
					data: [10, 20, 40, 60, 80, 90, 50],
					backgroundColor: [
						'rgba(73,143,226,.5)',
						'rgba(124,172,37,.5)',
						'rgba(255,68,2,.5)',
						'rgba(171,125,246,.5)',
						'rgba(243,187,36,.5)',
						'rgba(32,178,170,.5)',
						'rgba(29,187,142,.5)',
					],
				}
			]
		},
		options: {
			responsive: true,
			legend: {
				position: 'right'
			},
			scale: {
				ticks: {
					beginAtZero: true
				},
				reverse: false
			},
		}
	});


	// horizontal bar chart
	var ctxHorizontalBarChart = document.getElementById("horizontalbar-chart").getContext("2d");
	var horizontalBarChart = new Chart(ctxHorizontalBarChart, {
		type: 'horizontalBar',
		data: {
			labels: chartLabels,
			datasets: [
				{
					data: chartData3,
					label: 'Data',
					borderColor: 'transparent',
					backgroundColor: 'rgba(29,187,142,.5)'
				}
			]
		},
		options: {
			responsive: true,
		}
	});

});