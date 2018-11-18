$(function() {
	new JustGage({
		id: "size-default",
		value: getRandomInt(0, 100),
	});

	new JustGage({
		id: "donut",
		value: getRandomInt(0, 100),
		donut: true,
	});

	new JustGage({
		id: "size-custom",
		value: getRandomInt(0, 100),
	});

	new JustGage({
		id: "size-custom2",
		value: getRandomInt(0, 100),
	});

	new JustGage({
		id: "has-pointer",
		value: getRandomInt(0, 100),
		pointer: true,
		pointerOptions: {
			color: '#5E6773'
		}
	});

	new JustGage({
		id: "custom-scale-width",
		value: getRandomInt(0, 100),
		gaugeWidthScale: 0.3
	});

	new JustGage({
		id: "custom-color",
		value: getRandomInt(0, 100),
		gaugeColor: '#4d4d4d'
	});

	new JustGage({
		id: "no-label",
		value: getRandomInt(0, 100),
		hideMinMax: true
	});

	new JustGage({
		id: "value-label",
		value: getRandomInt(0, 100),
		label: "system load",
	});

	new JustGage({
		id: "minimal",
		value: getRandomInt(0, 100),
		hideMinMax: true,
		hideValue: true,
		gaugeColor: 'transparent'
	});

	new JustGage({
		id: "format-percentage",
		value: getRandomInt(0, 100),
		symbol: '%',
		minTxt: '0%',
		maxTxt: '100%',
	});

	var temperature = new JustGage({
		id: "format-minmax",
		value: getRandomInt(0, 100),
		minTxt: "Cold",
		maxTxt: "Hot",
		symbol: "°",
		levelColors: ["#3C9CEF", "#F5A623", "#D0021B"],
		noGradient: true,
		pointer: true,
		pointerOptions: {
			color: '#5E6773'
		}
	});

	var humanFriendlyGauge = new JustGage({
		id: "friendly-value",
		value: getRandomInt(0, 100000),
		min: 0,
		max: 1000000,
		humanFriendly: true,
		counter: true
	});

	var counterGauge = new JustGage({
		id: "custom-interval",
		value: getRandomInt(350, 950),
		min: 350,
		max: 950,
		counter: true
	});

	setInterval(function() {
		temperature.refresh(getRandomInt(0, 100));
		humanFriendlyGauge.refresh(getRandomInt(100000, 1000000));
		counterGauge.refresh(getRandomInt(350, 950));
	}, 2000);


});