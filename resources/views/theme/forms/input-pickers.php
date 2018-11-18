<div class="row">
	<div class="col-md-6">
		<!-- DATE PICKER -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Date Picker</h3>
			</div>
			<div class="panel-body">
				<label>Default</label><br>
				<input data-provide="datepicker" data-date-autoclose="true" class="form-control">
				<br><br>

				<label>Custom Format (dd/mm/yyyy)</label><br>
				<input data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="dd/mm/yyyy">
				<br><br>

				<label>With Component</label><br>
				<div class="input-group date" data-date-autoclose="true" data-provide="datepicker">
					<input type="text" class="form-control">
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
				<br><br>

				<label>Range</label><br>
				<div class="input-daterange input-group" data-provide="datepicker">
					<input type="text" class="input-sm form-control" name="start">
					<span class="input-group-addon">to</span>
					<input type="text" class="input-sm form-control" name="end">
				</div>
				<br><br>

				<label>Inline</label><br>
				<div class="inline-datepicker"></div>
			</div>
		</div>
		<!-- END DATE PICKER -->
	</div>
	<div class="col-md-6">
		<!-- COLOR PICKER -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Color Picker</h3>
			</div>
			<div class="panel-body">
				<label>Attached to Field</label><br>
				<input type="text" id="demo-colorpicker1" class="form-control" value="#5367ce">
				<br><br>

				<label>RGBA Format</label><br>
				<input type="text" id="demo-colorpicker2" class="form-control" value="rgba(182,225,12,0.49)">
				<br><br>

				<label>As a Component</label><br>
				<div id="demo-colorpicker3" class="input-group colorpicker-component">
					<input type="text" value="#0099aa" class="form-control">
					<span class="input-group-addon"><i></i></span>
				</div>
				<br><br>

				<label>Has Color Palette</label><br>
				<div id="demo-colorpicker4" class="input-group colorpicker-component">
					<input type="text" value="#337ab7" class="form-control">
					<span class="input-group-addon"><i></i></span>
				</div>
				<br><br>

				<label>Inline Mode</label><br>
				<div id="colorpicker-inline"></div>
				<br><br>

				<label>Working With Event</label><br>
				<a href="#" class="btn btn-default" id="demo-colorpicker5">Change button color</a>

			</div>
		</div>
		<!-- END COLOR PICKER -->
	</div>
</div>

<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title">Clock Picker</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-4">
				<p>Default</p>
				<div class="input-group basic-clockpicker">
					<input type="text" class="form-control" value="09:30">
					<span class="input-group-addon">
						<span class="fa fa-clock-o"></span>
					</span>
				</div>

				<br><br>

				<p>No Input Add-on</p>
				<input class="form-control basic-clockpicker" data-placement="right" value="9:30">

				<br><br>

				<p>Top Placement and Autoclose</p>
				<div class="input-group basic-clockpicker" data-placement="top" data-autoclose="true">
					<input type="text" class="form-control" value="09:30">
					<span class="input-group-addon">
						<span class="fa fa-clock-o"></span>
					</span>
				</div>

				<br><br>

				<p>Default to NOW and manual operation</p>
				<div class="input-group">
					<input class="form-control" id="single-input" value="" placeholder="Now">
					<span class="input-group-btn">
						<button class="btn btn-primary" type="button" id="check-minutes">Check the minutes</button>
					</span>
				</div>
			</div>
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>
		</div>

	</div>
</div>