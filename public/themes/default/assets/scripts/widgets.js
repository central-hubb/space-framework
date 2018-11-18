$(function() {
	// mini bar chart
	$('#mini-bar-chart').sparkline('html', {
		type: 'bar',
		barWidth: 8,
		height: 45,
		barColor: '#72BB23',
		chartRangeMin: 0,
		chartRangeMax: 100
	});


	// mini line chart
	$('#sales-performance').sparkline('html', {
		width: '100%',
		height: '40px',
		lineWidth: '2',
		lineColor: '#00aaff',
		fillColor: false,
		spotRadius: '2',
		highlightLineColor: '#aedaff',
		highlightSpotColor: '#71aadb',
		spotColor: false,
		minSpotColor: false,
		maxSpotColor: false,
		disableInteraction: false
	});


	// real-time usage chart
	var usageData = [],
		totalPoints = 20;

	function getRandomData() {

		if (usageData.length > 0)
			usageData = usageData.slice(1);

		while (usageData.length < totalPoints) {
			var y = Math.random() * 100
			usageData.push(y);
		}

		var result = [];
		for (var i = 0; i < usageData.length; ++i) {
			result.push([i, usageData[i]])
		}

		return result;
	}


	var usageChart = $.plot($('#real-time-usage'), [getRandomData()], {
		series: {
			lines: {
				
				fill: true,
				fillColor: '#53c265'
			}
		},
		colors: ['#53c265'],
		grid: {
			show: false,
		},
	});

	var usageInterval = setInterval(function() {
		usageChart.setData([getRandomData()]);
		usageChart.draw();
		$('.widget-mini-realtime-usage').find('.number').text((Math.random() * 100).toFixed(2));
	}, 1000);

	$('.widget-mini-realtime-usage').on('remove', function() {
		window.clearInterval(usageInterval);
	});


	// profile completeness meter
	var cPbar = $('.completeness-progress');

	if( $('.progress-bar').length > 0 ) {
		cPbar.progressbar({
			display_text: 'fill',
			update: function(current_percentage) {

				if(current_percentage == 100) {
					$('.complete-info').addClass('text-success').html('<i class="fa fa-check-circle"></i> Hooray, it\'s done!');
					cPbar.removeClass('progress-bar-info').addClass('progress-bar-success');
					$('.completeness-meter .editable').editable('disable');
				}
			}
		});
	}

	$.fn.editable.defaults.mode = 'inline';

	$('#complete-phone-number').on('shown', function(e, editable) {
		editable.input.$input.mask('(999) 999-9999');
	}).on('hidden', function(e, reason) {
		if(reason == 'save') {
			$(this).parent().prepend('Phone: ');
			updateProfileMeter($(this), cPbar, 25);
		}
	});

	$('#complete-nickname').on('shown', function(e, editable) {
		editable.input.$input.val('');
	}).on('hidden', function(e, reason) {
		if(reason == 'save') {
			$(this).parent().prepend('Nickname: ');
			updateProfileMeter($(this), cPbar, 25);
		}
	});

	$('.completeness-meter #complete-phone-number').editable();
	$('#complete-nickname').editable();

	function updateProfileMeter(el, pbar, valueAdded) {
		// update progress bar
		pbar.attr('data-transitiongoal', parseInt(pbar.attr('data-transitiongoal'))+valueAdded).progressbar();

		// update element
		$(el).parent().find('i').removeClass('fa-circle-o').addClass('fa-check-circle');
		$(el).parent().addClass('done');
	}


	// progress shares goal
	var runProgressShareOnce = false;

	$('#progress-share').bind('appear', function(){
		if(runProgressShareOnce) return false;

		$(this).each(function() {
			var $bar = $(this).find(".bar");
			var $val = $(this).find(".value");
			var perc = parseInt( $val.text(), 10);
			var scale = 180/parseInt($(this).attr('data-max'));

			$({p:0}).animate({p:perc}, {
				duration: 3000,
				easing: "swing",
				step: function(p) {
					$bar.css({
					transform: "rotate("+ (45+(p*scale)) +"deg)",
				});
					$val.text(p|0);
				}
			});
		});

		runProgressShareOnce = true;
	});


	// real-time pie chart
	var sysLoad = $('#load-chart').easyPieChart({
		size: 130,
		barColor: function(percent) {
			return "rgb(" + Math.round(200 * percent / 100) + ", " + Math.round(200 * (1.1 - percent / 100)) + ", 0)";
		},
		trackColor: 'rgba(187, 202, 213, .2)',
		scaleColor: false,
		lineWidth: 8,
		lineCap: "round",
		animate: 800
	});

	var updateInterval = 3000; // in milliseconds

	var sysLoadInterval = setInterval( function() {
		var randomVal;
		randomVal = getRandomInt(0, 100);

		sysLoad.data('easyPieChart').update(randomVal);
		sysLoad.find('.percent .number').text(randomVal);

		$('.widget-system-load .info .number').each(function() {
			$(this).text(getRandomInt(0, 100))
		});
	}, updateInterval);


	$('#load-chart').on('remove', function() {
		window.clearInterval(sysLoadInterval);
	});

	function getRandomInt(min, max) {
		return Math.floor(Math.random() * (max - min + 1)) + min;
	}
});