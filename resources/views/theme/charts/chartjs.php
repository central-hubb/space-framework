<script>

	var requiredJS = [
		'assets/vendor/chart-js/Chart.min.js',
		'assets/scripts/charts/charts-chartjs.js'
	];

	loadJS(requiredJS);

</script>

<div class="row">
	<div class="col-md-6">
		<!-- line chart -->
		<div class="panel">
			<div class="panel-heading">
				<h2 class="panel-title">Line Chart</h2>
			</div>
			<div class="panel-body">
				<canvas id="line-chart" height="150"></canvas>
				<form class="margin-top-30">
					<p class="text-muted">Play with controls below to see other chart options demo</p>
					<span class="fancy-checkbox custom-bgcolor-blue">
						<label><input type="checkbox" id="straightLine"><span>Straight Lines</span></label>
					</span>
					<span class="fancy-checkbox custom-bgcolor-blue">
						<label><input type="checkbox" id="diamondPoint"><span>Diamond Points</span></label>
					</span>
					<span class="fancy-checkbox custom-bgcolor-blue">
						<label><input type="checkbox" id="stepped"><span>Stepped Line</span></label>
					</span>
				</form>
			</div>
		</div>
		<!-- end line chart -->

		<!-- area chart -->
		<div class="panel">
			<div class="panel-heading">
				<h2 class="panel-title">Area Chart</h2>
			</div>
			<div class="panel-body">
				<canvas id="area-chart" height="150"></canvas>
				<form class="margin-top-30">
					<p class="text-muted">Play with controls below to see other chart options demo</p>
					<span class="fancy-checkbox custom-bgcolor-blue">
						<label><input type="checkbox" id="straightArea"><span>Straight Area</span></label>
					</span>
					<span class="fancy-checkbox custom-bgcolor-blue">
						<label><input type="checkbox" id="addRemoveAreaDataset"><span>Add/Remove Dataset</span></label>
					</span>
				</form>
			</div>
		</div>
		<!-- end area chart -->

		<!-- donut chart -->
		<div class="panel">
			<div class="panel-heading">
				<h2 class="panel-title">Pie Chart</h2>
			</div>
			<div class="panel-body">
				<canvas id="pie-chart" height="150"></canvas>
				<form class="margin-top-30">
					<p class="text-muted">Play with controls below to see other chart options demo</p>
					<span class="fancy-checkbox custom-bgcolor-blue">
						<label><input type="checkbox" id="addRemovePieDataset"><span>Add/Remove Dataset</span></label>
					</span>
				</form>
			</div>
		</div>
		<!-- end donut chart -->

		<!-- polar chart -->
		<div class="panel">
			<div class="panel-heading">
				<h2 class="panel-title">Radar Chart</h2>
			</div>
			<div class="panel-body">
				<canvas id="polar-chart"></canvas>
			</div>
		</div>
		<!-- end polar chart -->
	</div>
	<div class="col-md-6">
		<!-- bar chart -->
		<div class="panel">
			<div class="panel-heading">
				<h2 class="panel-title">Bar Chart</h2>
			</div>
			<div class="panel-body">
				<canvas id="bar-chart" height="150"></canvas>
				<form class="margin-top-30">
					<p class="text-muted">Play with controls below to see other chart options demo</p>
					<span class="fancy-checkbox custom-bgcolor-blue">
						<label><input type="checkbox" id="addRemoveBarDataset"><span>Add/Remove Dataset</span></label>
					</span>
				</form>
			</div>
		</div>
		<!-- end bar chart -->

		<!-- donut chart -->
		<div class="panel">
			<div class="panel-heading">
				<h2 class="panel-title">Doughnut Chart</h2>
			</div>
			<div class="panel-body">
				<canvas id="donut-chart" height="150"></canvas>
				<form class="margin-top-30">
					<p class="text-muted">Play with controls below to see other chart options demo</p>
					<span class="fancy-checkbox custom-bgcolor-blue">
						<label><input type="checkbox" id="addRemoveDonutDataset"><span>Add/Remove Dataset</span></label>
					</span>
				</form>
			</div>
		</div>
		<!-- end donut chart -->

		<!-- radar chart -->
		<div class="panel">
			<div class="panel-heading">
				<h2 class="panel-title">Radar Chart</h2>
			</div>
			<div class="panel-body">
				<canvas id="radar-chart" height="150"></canvas>
				<form class="margin-top-30">
					<p class="text-muted">Play with controls below to see other chart options demo</p>
					<span class="fancy-checkbox custom-bgcolor-blue">
						<label><input type="checkbox" id="addRemoveRadarDataset"><span>Add/Remove Dataset</span></label>
					</span>
				</form>
			</div>
		</div>
		<!-- end radar chart -->

		<!-- horizontal bar chart -->
		<div class="panel">
			<div class="panel-heading">
				<h2 class="panel-title">Horizontal Bar Chart</h2>
			</div>
			<div class="panel-body">
				<canvas id="horizontalbar-chart" height="150"></canvas>
			</div>
		</div>
		<!-- end horizontal bar chart -->
	</div>
</div>