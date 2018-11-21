<script>
	var requiredCSS = [
		'assets/vendor/jqvmap/jqvmap.min.css',
	];

	loadCSS(requiredCSS);

	var requiredJS = [
		'assets/vendor/jqvmap/jquery.vmap.min.js',
		'assets/vendor/jqvmap/maps/jquery.vmap.world.js',
		'assets/vendor/jqvmap/maps/jquery.vmap.usa.js',
		'assets/vendor/jqvmap/maps/jquery.vmap.europe.js',
		'assets/vendor/jqvmap/maps/jquery.vmap.russia.js',
		'assets/scripts/jquery.vmap.sampledata.js',
		'assets/scripts/maps/maps-jqvmap.js'
	];

	loadJS(requiredJS);

</script>


<div class="row">
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading">
				<h2 class="panel-title">World Map</h2>
				<div class="right">
					<span class="panel-info">With sample data</span>
				</div>
			</div>
			<div class="panel-body">
				<div id="world-map" style="height: 400px;"></div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading">
				<h2 class="panel-title">USA Map</h2>
				<div class="right">
					<span class="panel-info">With pre-selected regions and click event</span>
				</div>
			</div>
			<div class="panel-body">
				<div id="usa-map" style="height: 400px;"></div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading">
				<h2 class="panel-title">Europe Map</h2>
				<div class="right">
					<span class="panel-info">With different styles</span>
				</div>
			</div>
			<div class="panel-body">
				<div id="europe-map" style="height: 400px;"></div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading">
				<h2 class="panel-title">Russia Map</h2>
				<div class="right">
					<span class="panel-info">With background color</span>
				</div>
			</div>
			<div class="panel-body">
				<div id="russia-map" style="height: 460px;"></div>
			</div>
		</div>
	</div>
</div>