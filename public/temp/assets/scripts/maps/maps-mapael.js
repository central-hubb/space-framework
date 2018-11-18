$(function() {
	var data = {
		"areas" : {
			"US": {
				"value": 2200,
				"tooltip": {
					"content": "<span>United States</span><br />Sales: 2200"
				}
			},
			"CN": {
				"value": 1800,
				"tooltip": {
					"content": "<span>China</span><br />Sales: 1800"
				}
			},
			"JP": {
				"value": 1550,
				"tooltip": {
					"content": "<span>Japan</span><br />Sales: 1550"
				}
			},
			"IN": {
				"value": 1400,
				"tooltip": {
					"content": "<span>India</span><br />Sales: 1400"
				}
			},
			"DE": {
				"value": 1600,
				"tooltip": {
					"content": "<span>Germany</span><br />Sales: 1600"
				}
			},
			"RU": {
				"value": 900,
				"tooltip": {
					"content": "<span>Russia</span><br />Sales: 900"
				}
			},
			"GB": {
				"value": 1200,
				"tooltip": {
					"content": "<span>United Kingdom</span><br />Sales: 1200"
				}
			},
			"FR": {
				"value": 1100,
				"tooltip": {
					"content": "<span>France</span><br />Sales: 1100"
				}
			},
			"BR": {
				"value": 400,
				"tooltip": {
					"content": "<span>Brazil</span><br />Sales: 400"
				}
			},
			"IT": {
				"value": 700,
				"tooltip": {
					"content": "<span>Italy</span><br />Sales: 700"
				}
			},
			"MX": {
				"value": 1900,
				"tooltip": {
					"content": "<span>Mexico</span><br />Sales: 1900"
				}
			},
			"ES": {
				"value": 300,
				"tooltip": {
					"content": "<span>Spain</span><br />Sales: 300"
				}
			},
			"KR": {
				"value": 200,
				"tooltip": {
					"content": "<span>South Korea</span><br />Sales: 200"
				}
			},
			"CA": {
				"value": 2900,
				"tooltip": {
					"content": "<span>Canada</span><br />Sales: 2900"
				}
			},
			"ID": {
				"value": 1200,
				"tooltip": {
					"content": "<span>Indonesia</span><br />Sales: 1300"
				}
			},
			"TR": {
				"value": 90,
				"tooltip": {
					"content": "<span>Turkey</span><br />Sales: 90"
				}
			},
			"IR": {
				"value": 80,
				"tooltip": {
					"content": "<span>Iran</span><br />Sales: 80"
				}
			},
			"AU": {
				"value": 900,
				"tooltip": {
					"content": "<span>Australia</span><br />Sales: 1400"
				}
			},
			"ZA": {
				"value": 50,
				"tooltip": {
					"content": "<span>South Africa</span><br />Sales: 50"
				}
			},
			"EG": {
				"value": 20,
				"tooltip": {
					"content": "<span>Egypt</span><br />Sales: 20"
				}
			},
			"PK": {
				"value": 1300,
				"tooltip": {
					"content": "<span>Pakistan</span><br />Sales: 1300"
				}
			},
			"SG": {
				"value": 100,
				"tooltip": {
					"content": "<span>Singapore</span><br />Sales: 100"
				}
			},
		}
	}; // end data

	// map with sales data visualization
	var colors = ["#7a7a7a", "#5c5c5c", "#474747", "#333333", "#1f1f1f"];

	$('#data-visualization-map').mapael({
		map: {
			name: "world_countries",
			defaultArea: {
				attrs : {
					stroke : "#dedede", 
					"stroke-width" : 1,
					fill: "#efefef"
				}
			}
		},
		legend: {
			area: {
				display: true,
				title: "Sales",
				slices: [
					{
						max: 100,
						attrs: {
							fill: colors[0]
						},
						label: "Less than 100"
					},
					{
						min: 100,
						max: 500,
						attrs: {
							fill: colors[1]
						},
						label: "Between 100 and 500"
					},
					{
						min: 500,
						max: 1000,
						attrs: {
							fill: colors[2]
						},
						label: "Between 500 and 1000"
					},
					{
						min: 1000,
						max: 1500,
						attrs: {
							fill: colors[3]
						},
						label: "Between 1000 and 1500"
					},
					{
						min: 1500,
						attrs: {
							fill: colors[4]
						},
						label: "More than 1500"
					}
				]
			}
		},
		areas: data['areas']

	}); // end data visualization map


	// map with zoom features
	$mapZoom = $("#zoom-map");
	$mapZoom.mapael({
		map : {
			name: "france_departments",
			zoom: {
				enabled: true,
				maxLevel : 10
			}, 
			defaultPlot: {
				attrs: {
					opacity : 0.6
				}
			}
		},
		areas: {
			"department-56" : {
				text : {content : "56"}, 
				tooltip: {content : "Morbihan (56)"}
			}
		},
		plots : {
			'paris' : {
				latitude : 48.86, 
				longitude: 2.3444
			},
			'lyon' : {
				type: "circle",
				size:50,
				latitude :45.758888888889, 
				longitude: 4.8413888888889, 
				value : 700000, 
				href : "http://fr.wikipedia.org/wiki/Lyon",
				tooltip: {content : "<span style=\"font-weight:bold;\">City :</span> Lyon"},
				text : {content : "Lyon"}
			},
			'rennes' : {
				type :"square",
				size :20,
				latitude : 48.114166666667, 
				longitude: -1.6808333333333, 
				tooltip: {content : "<span style=\"font-weight:bold;\">City :</span> Rennes"},
				text : {content : "Rennes"},
				href : "http://fr.wikipedia.org/wiki/Rennes"
			}
		}
	});

	// Zoom on mousewheel with mousewheel jQuery plugin
	$mapZoom.on("mousewheel", function(e) {
		if (e.deltaY > 0)
			$mapZoom.trigger("zoom", $mapZoom.data("zoomLevel") + 1);
		else
			$mapZoom.trigger("zoom", $mapZoom.data("zoomLevel") - 1);
			
		return false;
	});


	// basic map
	$("#basic-map").mapael({
		map: {
			name: "world_countries",
			defaultArea: {
				attrs : {
					stroke : "#dedede", 
					"stroke-width" : 1,
					fill: "#efefef"
				}
			}
		}
	});

});