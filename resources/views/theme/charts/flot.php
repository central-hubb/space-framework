<script>

	var requiredJS = [
		'assets/vendor/Flot/jquery.flot.js',
		'assets/vendor/Flot/jquery.flot.resize.js',
		'assets/vendor/Flot/jquery.flot.time.js',
		'assets/vendor/Flot/jquery.flot.pie.js',
		'assets/vendor/flot.tooltip/jquery.flot.tooltip.js',
		'assets/vendor/flot.orderbars/jquery.flot.orderBars.js',
		'assets/scripts/charts/charts-flot.js'
	];

	loadJS(requiredJS);

</script>


<div class="row">
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Flot Chart: Line Chart</h3>
			</div>
			<div class="panel-body">
				<div class="demo-flot-chart" id="demo-flot-line-chart"></div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Flot Chart: Area Chart</h3>
			</div>
			<div class="panel-body">
				<div class="demo-flot-chart sales-chart" id="demo-flot-area-chart"></div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Flot Chart: Vertical Bar Chart</h3>
			</div>
			<div class="panel-body">
				<div class="demo-flot-chart" id="demo-flot-vertical-bar-chart"></div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Flot Chart: Horizontal Bar Chart</h3>
			</div>
			<div class="panel-body">
				<div class="demo-flot-chart" id="demo-flot-horizontal-bar-chart"></div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Flot Chart: Combining Chart Types</h3>
			</div>
			<div class="panel-body">
				<div class="demo-flot-chart" id="demo-flot-multi-types-chart"></div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Flot Chart: Donut Chart</h3>
			</div>
			<div class="panel-body">
				<div class="demo-flot-chart" id="demo-flot-donut-chart"></div>
			</div>
		</div>
	</div>
</div>