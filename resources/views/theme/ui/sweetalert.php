<script>
	var requiredCSS = [
		'assets/vendor/sweetalert2/sweetalert2.css'
	];

	loadCSS(requiredCSS);

	var requiredJS = [
		'assets/vendor/sweetalert2/sweetalert2.js',
		'assets/scripts/ui/ui-sweetalert.js'
	];

	loadJS(requiredJS);

</script>

<div class="row">
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Contextual</h3>
			</div>
			<div class="panel-body">
				<table class="table">
					<tr>
						<td><button class="btn btn-success" id="btn-sw-success">Click me</button></td>
						<td>A success message</td>
					</tr>
					<tr>
						<td><button class="btn btn-danger" id="btn-sw-error">Click me</button></td>
						<td>An error message</td>
					</tr>
					<tr>
						<td><button class="btn btn-warning" id="btn-sw-warning">Click me</button></td>
						<td>A warning message</td>
					</tr>
					<tr>
						<td><button class="btn btn-info" id="btn-sw-info">Click me</button></td>
						<td>An info message</td>
					</tr>
					<tr>
						<td><button class="btn btn-default" id="btn-sw-question">Click me</button></td>
						<td>A question message</td>
					</tr>
				</table>
				
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Action</h3>
			</div>
			<div class="panel-body">
				<table class="table">
					<tr>
						<td><button class="btn btn-primary" id="btn-sw-confirmation">Click me</button></td>
						<td>Confirmation prior action</td>
					</tr>
					<tr>
						<td><button class="btn btn-primary" id="btn-sw-confirmation2">Click me</button></td>
						<td>Confirmation prior action, with function on Cancel</td>
					</tr>
					<tr>
						<td><button class="btn btn-primary" id="btn-sw-chaining">Click me</button></td>
						<td>Chaining modals (queue)</td>
					</tr>
					<tr>
						<td><button class="btn btn-primary" id="btn-sw-dynamic">Click me</button></td>
						<td>Dynamic queue</td>
					</tr>
					<tr>
						<td><button class="btn btn-primary" id="btn-sw-ajax">Click me</button></td>
						<td>Ajax request</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title">Input Types</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6">
				<table class="table">
					<tr>
						<td><button class="btn btn-default" id="btn-sw-text">Click me</button></td>
						<td>Text input</td>
					</tr>
					<tr>
						<td><button class="btn btn-default" id="btn-sw-email">Click me</button></td>
						<td>Email input</td>
					</tr>
					<tr>
						<td><button class="btn btn-default" id="btn-sw-url">Click me</button></td>
						<td>URL input</td>
					</tr>
					<tr>
						<td><button class="btn btn-default" id="btn-sw-password">Click me</button></td>
						<td>Password input</td>
					</tr>
					<tr>
						<td><button class="btn btn-default" id="btn-sw-textarea">Click me</button></td>
						<td>Textarea input</td>
					</tr>
				</table>
			</div>
			<div class="col-md-6">
				<table class="table">
					<tr>
						<td><button class="btn btn-default" id="btn-sw-select">Click me</button></td>
						<td>Select input</td>
					</tr>
					<tr>
						<td><button class="btn btn-default" id="btn-sw-radio">Click me</button></td>
						<td>Radio input</td>
					</tr>
					<tr>
						<td><button class="btn btn-default" id="btn-sw-checkbox">Click me</button></td>
						<td>Checkbox input</td>
					</tr>
					<tr>
						<td><button class="btn btn-default" id="btn-sw-file">Click me</button></td>
						<td>File input</td>
					</tr>
					<tr>
						<td><button class="btn btn-default" id="btn-sw-range">Click me</button></td>
						<td>Range input</td>
					</tr>
				</table>
			</div>
		</div>
		
	</div>
</div>