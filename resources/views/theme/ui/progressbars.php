<!-- BOOTSTRAP PROGRESS BARS -->
<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title">Progress Bars</h3>
		<div class="right">
			<span class="panel-info">Progress Bars based on Bootstrap-Progressbar plugin</span>
		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6">
				<h4>Percentage Format</h4>
				<div id="progress-format1" class="progress">
					<div class="progress-bar" data-transitiongoal="20"></div>
				</div>
				<h4>Number Format</h4>
				<div id="progress-format2" class="progress">
					<div class="progress-bar" data-transitiongoal="35"></div>
				</div>
				<h4>Custom Format</h4>
				<div id="progress-custom-format" class="progress">
					<div class="progress-bar" data-transitiongoal="65"></div>
				</div>
			</div>
			<div class="col-md-6">
				<h4>Other Styles</h4>
				<div id="progress-striped" class="progress progress-striped">
					<div class="progress-bar progress-bar-warning" data-transitiongoal="40"></div>
				</div>
				<div id="progress-striped-active" class="progress progress-striped active">
					<div class="progress-bar progress-bar-danger" data-transitiongoal="60"></div>
				</div>
				<h4>Vertical Progress Bars</h4>
				<div style="height: 200px;"> <!-- need predefined height -->
					<div class="progress vertical bottom">
						<div class="progress-bar" data-transitiongoal="80"></div>
					</div>
					<div class="progress vertical">
						<div class="progress-bar" data-transitiongoal="80"></div>
					</div>
					<div class="progress progress-striped vertical wide">
						<div class="progress-bar progress-bar-info" data-transitiongoal="50"></div>
					</div>
					<div class="progress progress-striped vertical bottom wide">
						<div class="progress-bar progress-bar-success" data-transitiongoal="30"></div>
					</div>
					<div class="progress progress-striped vertical bottom wide">
						<div class="progress-bar progress-bar-warning" data-transitiongoal="65"></div>
					</div>
					<div class="progress progress-striped vertical bottom wide">
						<div class="progress-bar progress-bar-danger" data-transitiongoal="90"></div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>
<!-- END BOOTSTRAP PROGRESS BARS -->

<!-- PROGRESS BARS -->
<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title">Default Progress Bars</h3>
		<div class="right">
			<span class="panel-info">Deafult Bootstrap Progress Bars</span>
		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6">
				<h4>Contextual</h4>
				<div class="progress">
					<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
						<span class="sr-only">60% Complete</span>
					</div>
				</div>
				<div class="progress">
					<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
						<span class="sr-only">60% Complete (warning)</span>
					</div>
				</div>
				<div class="progress">
					<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
						<span class="sr-only">60% Complete (success)</span>
					</div>
				</div>
				<div class="progress">
					<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
						<span class="sr-only">60% Complete (danger)</span>
					</div>
				</div>
				
				<div class="margin-bottom-30"></div>
				
				<h4>With Percentage Label</h4>
				<div class="progress">
					<div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
						75%
					</div>
				</div>

				<div class="margin-bottom-30"></div>

				<h4>Stacked Progress Bar</h4>
				<div class="progress">
					<div class="progress-bar progress-bar-success progress-bar-striped" style="width: 45%">
						<span class="sr-only">45% Complete (success)</span>
					</div>
					<div class="progress-bar progress-bar-warning" style="width: 20%">
						<span class="sr-only">20% Complete (warning)</span>
					</div>
					<div class="progress-bar progress-bar-danger" style="width: 10%">
						<span class="sr-only">10% Complete (danger)</span>
					</div>
				</div>

			</div>
			<div class="col-md-6">
				<h4>Sizes</h4>
				<div class="progress progress-xs">
					<div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
						<span class="sr-only">80% Complete</span>
					</div>
				</div>
				<div class="progress progress-sm">
					<div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
						<span class="sr-only">80% Complete</span>
					</div>
				</div>
				<div class="progress">
					<div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
						<span class="sr-only">80% Complete</span>
					</div>
				</div>
				<div class="progress progress-lg">
					<div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
						<span class="sr-only">80% Complete</span>
					</div>
				</div>

				<div class="margin-bottom-30"></div>

				<h4>Striped and Animated</h4>
				<div class="progress">
					<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
						<span class="sr-only">20% Complete</span>
					</div>
				</div>
				<div class="progress">
					<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
						<span class="sr-only">45% Complete</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END PROGRESS BARS -->