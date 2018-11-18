<div class="row">
	<div class="col-md-6">
		<!-- AUTOCOMPLETE -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Autocomplete</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-2 control-label" >Autocomplete</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="input-autocomplete" placeholder="Try to type 'a' or 'b'">
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- END AUTOCOMPLETE -->

		<!-- PASSWORD -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Password</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-4 control-label">Password Show/Hide</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" id="password-showhide">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label">Password Show/Hide</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" id="password-showhide2">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 control-label">Password Strength</label>
						<div class="col-sm-8">
							<div class="password-strength-container">
								<input type="password" class="form-control" id="password-strength">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label">Password Strength</label>
						<div class="col-sm-8">
							<div class="password-strength-container">
								<input type="password" class="form-control" id="password-strength2">
							</div>
						</div>
					</div>

					<p>Validation Rules:</p>
					<code>
						wordNotEmail: true,<br>
						wordMinLength: true,<br>
						wordMaxLength: false,<br>
						wordInvalidChar: true,<br>
						wordSimilarToUsername: true,<br>
						wordSequences: true,<br>
						wordTwoCharacterClasses: false,<br>
						wordRepetitions: false,<br>
						wordLowercase: true,<br>
						wordUppercase: true,<br>
						wordOneNumber: true,<br>
						wordThreeNumbers: true,<br>
						wordOneSpecialChar: true,<br>
						wordTwoSpecialChar: true,<br>
						wordUpperLowerCombo: true,<br>
						wordLetterNumberCombo: true,<br>
						wordLetterNumberCharCombo: true<br>
					</code>
				</form>
			</div>
		</div>
		<!-- END PASSWORD -->

		<!-- MASKED INPUT -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Masked Input</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal">
					<div class="form-group">
						<label for="phone" class="col-sm-2 control-label" >Phone</label>
						<div class="col-sm-10">
							<input type="text" id="phone" class="form-control">
							<span class="help-block">(999) 999-9999</span>
						</div>
					</div>
					<div class="form-group">
						<label for="phone-ex" class="col-sm-2 control-label" >Phone + Ext</label>
						<div class="col-sm-10">
							<input type="text" id="phone-ex" class="form-control">
							<span class="help-block">(999) 999-9999? x99999</span>
						</div>
					</div>
					<div class="form-group">
						<label for="tax-id" class="col-sm-2 control-label" >Tax ID</label>
						<div class="col-sm-10">
							<input type="text" id="tax-id" class="form-control">
							<span class="help-block">99-9999999</span>
						</div>
					</div>
					<div class="form-group">
						<label for="ssn" class="col-sm-2 control-label" >SSN</label>
						<div class="col-sm-10">
							<input type="text" id="ssn" class="form-control">
							<span class="help-block">999-99-9999</span>
						</div>
					</div>
					<div class="form-group">
						<label for="product-key" class="col-sm-2 control-label" >Product Key</label>
						<div class="col-sm-10">
							<input type="text" id="product-key" class="form-control">
							<span class="help-block">a*-999-a999</span>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- END MASKED INPUT -->

		<!-- BASIC INPUTS -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Basic Inputs</h3>
			</div>
			<div class="panel-body">
				<div class="form-horizontal">
					<div class="form-group">
						<label class="col-md-2 control-label">Text Field</label>
						<div class="col-md-10">
							<input type="text" class="form-control" placeholder="text field">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Password</label>
						<div class="col-md-10">
							<input type="password" class="form-control" value="asecret">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Textarea</label>
						<div class="col-md-10">
							<textarea class="form-control" placeholder="textarea" rows="4"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Select</label>
						<div class="col-md-10">
							<select class="form-control">
								<option value="cheese">Cheese</option>
								<option value="tomatoes">Tomatoes</option>
								<option value="mozarella">Mozzarella</option>
								<option value="mushrooms">Mushrooms</option>
								<option value="pepperoni">Pepperoni</option>
								<option value="onions">Onions</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Multiple</label>
						<div class="col-md-10">
							<select multiple class="form-control">
								<option value="cheese">Cheese</option>
								<option value="tomatoes">Tomatoes</option>
								<option value="mozarella">Mozzarella</option>
								<option value="mushrooms">Mushrooms</option>
								<option value="pepperoni">Pepperoni</option>
								<option value="onions">Onions</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Checkbox</label>
						<div class="col-md-10">
							<div class="checkbox">
								<label>
									<input type="checkbox" value="item1"> Item 1
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" value="item2"> Item 2
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" value="item3"> Item 3
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Inline</label>
						<div class="col-md-10">
							<label class="checkbox-inline">
								<input type="checkbox" value="item1"> Item 1
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" value="item2"> Item 2
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" value="item3"> Item 3
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Radio Button</label>
						<div class="col-md-10">
							<div class="radio">
								<label>
									<input type="radio" name="radio" value="radio1"> Radio Item 1
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="radio" value="radio2"> Radio Item 2
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="radio" value="radio3"> Radio Item 3
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Inline</label>
						<div class="col-md-10">
							<label class="radio radio-inline">
								<input type="radio" name="radioinline" value="radio1"> Radio Item 1
							</label>
							<label class="radio radio-inline">
								<input type="radio" name="radioinline" value="radio2"> Radio Item 2
							</label>
							<label class="radio radio-inline">
								<input type="radio" name="radioinline" value="radio3"> Radio Item 3
							</label>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleInputFile" class="col-md-2 control-label">File input</label>
						<div class="col-md-10">
							<input type="file" id="exampleInputFile">
							<p class="help-block"><em>Example block-level help text here.</em></p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Static Control</label>
						<div class="col-sm-10">
							<p class="form-control-static">email@example.com</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END BASIC INPUTS -->

		<!-- INPUT SIZINGS -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Input Sizing</h3>
			</div>
			<div class="panel-body">
				<input class="form-control input-lg" placeholder=".input-lg" type="text"><br>
				<input class="form-control" placeholder="Default input" type="text"><br>
				<input class="form-control input-sm" placeholder=".input-sm" type="text"><br>
				<select class="form-control input-lg">
					<option value="cheese">Cheese</option>
					<option value="tomatoes">Tomatoes</option>
					<option value="mozarella">Mozzarella</option>
					<option value="mushrooms">Mushrooms</option>
					<option value="pepperoni">Pepperoni</option>
					<option value="onions">Onions</option>
				</select><br>
				<select class="form-control">
					<option value="cheese">Cheese</option>
					<option value="tomatoes">Tomatoes</option>
					<option value="mozarella">Mozzarella</option>
					<option value="mushrooms">Mushrooms</option>
					<option value="pepperoni">Pepperoni</option>
					<option value="onions">Onions</option>
				</select><br>
				<select class="form-control input-sm">
					<option value="cheese">Cheese</option>
					<option value="tomatoes">Tomatoes</option>
					<option value="mozarella">Mozzarella</option>
					<option value="mushrooms">Mushrooms</option>
					<option value="pepperoni">Pepperoni</option>
					<option value="onions">Onions</option>
				</select>
			</div>
		</div>
		<!-- END INPUT SIZINGS -->
	</div>
	<div class="col-md-6">
		<!-- SWITCHES -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Switches</h3>
			</div>
			<div class="panel-body">
				<h4>Pure CSS Switches</h4>
				<form class="form-horizontal">
					<div class="row">
						<div class="col-md-4">
							<p>Using ON/OFF label text</p>
							<label class="switch-input">
								<input type="checkbox" name="switch-checkbox" checked>
								<i data-swon-text="ON" data-swoff-text="OFF"></i>
								Web Notification
							</label>
							<label class="switch-input">
								<input type="checkbox" name="switch-checkbox">
								<i data-swon-text="ON" data-swoff-text="OFF"></i>
								Mobile Notification
							</label>
							<label class="switch-input">
								<input type="checkbox" name="switch-checkbox" checked>
								<i data-swon-text="ON" data-swoff-text="OFF"></i>
								Email Subscription
							</label>
						</div>
						<div class="col-md-4">
							<p>Using YES/NO label text</p>
							<label class="switch-input">
								<input type="checkbox" name="switch-checkbox">
								<i data-swon-text="YES" data-swoff-text="NO"></i>
								Subscription
							</label>
							<label class="switch-input">
								<input type="checkbox" name="switch-checkbox" checked>
								<i data-swon-text="YES" data-swoff-text="NO"></i>
								Auto Renewal
							</label>
							<label class="switch-input">
								<input type="checkbox" name="switch-checkbox">
								<i data-swon-text="YES" data-swoff-text="NO"></i>
								Reminder
							</label>
						</div>
						<div class="col-md-4">
							<p>Radio button behaviour</p>
							<label class="switch-input">
								<input type="radio" name="switch-radio">
								<i data-swon-text="ON" data-swoff-text="OFF"></i>
								Daily
							</label>
							<label class="switch-input">
								<input type="radio" name="switch-radio" checked>
								<i data-swon-text="ON" data-swoff-text="OFF"></i>
								Weekly
							</label>
							<label class="switch-input">
								<input type="radio" name="switch-radio">
								<i data-swon-text="ON" data-swoff-text="OFF"></i>
								Monthly
							</label>
						</div>
					</div>
				</form>

				<br>

				<h4>Switches by Switchery</h4>
				<div class="row">
					<div class="col-md-6">
						<p>Default size</p>
						<input type="checkbox" class="js-switch" checked>
						<input type="checkbox" class="js-switch">

						<br><br>

						<p>Small size</p>
						<input type="checkbox" class="js-switch" checked data-size="small">
						<input type="checkbox" class="js-switch" data-size="small">

						<br><br>

						<p>Disabled</p>
						<input type="checkbox" class="js-switch" checked disabled="disabled">
						<input type="checkbox" class="js-switch" disabled="disabled">

						<br><br>

						<p>Checking state (On Click)</p>
						<input type="checkbox" class="js-switch" id="switch-check-click" checked>&nbsp;&nbsp;
						<button type="button" class="btn btn-default" id="btn-check-click">Click to check state</button>

						<br><br>

						<p>Checking state (On Change)</p>
						<input type="checkbox" class="js-switch" id="switch-check-change">&nbsp;&nbsp;
						<span class="label label-default" id="label-check-change"></span>
					</div>
					<div class="col-md-6">
						<p>Colors</p>
						<input type="checkbox" class="js-switch" checked data-color="orange"> <code>data-color="orange"</code>

						<br><br>

						<input type="checkbox" class="js-switch" checked data-color="purple"> <code>data-color="purple"</code>

						<br><br>

						<input type="checkbox" class="js-switch" checked data-color="yellow"> <code>data-color="yellow"</code>

						<br><br>

						<input type="checkbox" class="js-switch" checked data-color="red"> <code>data-color="red"</code>

						<br><br>

						<input type="checkbox" class="js-switch" checked data-color="blue"> <code>data-color="blue"</code>

						<br><br>

						<input type="checkbox" class="js-switch" checked data-color="#20B2AA"> <code>data-color="#20B2AA"</code>
					</div>
				</div>



			</div>
		</div>
		<!-- END SWITCHES -->

		<!-- STYLED INPUTS -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Styled Checkboxes and Radios</h3>
			</div>
			<div class="panel-body">
				<div class="fancy-checkbox">
					<label><input type="checkbox"><span>Fancy Checkbox 1</span></label>
				</div>
				<div class="fancy-checkbox custom-color-green">
					<label><input type="checkbox" checked><span>Fancy Checkbox 2</span></label>
				</div>
				<div class="fancy-checkbox custom-bgcolor-green">
					<label><input type="checkbox" checked><span>Fancy Checkbox 3</span></label>
				</div>
				<div class="fancy-checkbox custom-bgcolor-blue">
					<label><input type="checkbox" checked><span>Fancy Checkbox 4</span></label>
				</div>
				<div class="fancy-checkbox">
					<label><input type="checkbox" checked><span>Fancy Checkbox 5</span></label>
				</div>

				<br>

				<label class="fancy-checkbox custom-bgcolor-blue"><input type="checkbox"><span>Fancy Checkbox 1</span></label>
				<label class="fancy-checkbox custom-bgcolor-blue"><input type="checkbox" checked><span>Fancy Checkbox 2</span></label>
				<label class="fancy-checkbox custom-bgcolor-blue"><input type="checkbox"><span>Fancy Checkbox 3</span></label>

				<br><br>

				<div class="fancy-radio">
					<label><input name="gender" value="male" type="radio"><span><i></i>Male</span></label>
				</div>
				<div class="fancy-radio">
					<label><input name="gender" value="female" type="radio"><span><i></i>Female</span></label>
				</div>

				<br>

				<label class="fancy-radio"><input name="gender2" value="male" type="radio"><span><i></i>Male</span></label>
				<label class="fancy-radio"><input name="gender2" value="female" type="radio" checked><span><i></i>Female</span></label>

				<br>

				<label class="fancy-radio custom-bgcolor-green"><input name="gender3" value="male" type="radio" checked><span><i></i>Male</span></label>
				<label class="fancy-radio custom-bgcolor-green"><input name="gender3" value="female" type="radio"><span><i></i>Female</span></label>

				<br>

				<label class="fancy-radio custom-color-blue"><input name="gender4" value="male" type="radio"><span><i></i>Male</span></label>
				<label class="fancy-radio custom-color-blue"><input name="gender4" value="female" type="radio" checked><span><i></i>Female</span></label>
			</div>
		</div>
		<!-- END STYLED INPUTS -->

		<!-- INPUT GROUPS -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Input Groups</h3>
			</div>
			<div class="panel-body">
				<div class="input-group">
					<input class="form-control" type="text">
					<span class="input-group-btn"><button class="btn btn-primary" type="button">Go!</button></span>
				</div><br>
				<div class="input-group">
					<span class="input-group-btn">
						<button class="btn btn-primary" type="button">Go!</button>
					</span>
					<input class="form-control" type="text">
				</div><br>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
					<input class="form-control" placeholder="Username" type="text">
				</div><br>
				<div class="input-group">
					<input class="form-control" placeholder="Username" type="text">
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
				</div><br>
				<div class="input-group">
					<span class="input-group-addon">$</span>
					<input class="form-control" type="text">
					<span class="input-group-addon">.00</span>
				</div><br>
				<div class="input-group">
					<span class="input-group-addon">@</span>
					<input type="text" class="form-control" placeholder="Username">
				</div><br>
				<div class="input-group">
					<input type="text" class="form-control">
					<span class="input-group-addon">.00</span>
				</div><br>
				<div class="input-group">
					<span class="input-group-addon">$</span>
					<input type="text" class="form-control">
					<span class="input-group-addon">.00</span>
				</div><br>
				<div class="input-group">
					<input type="text" class="form-control">
					<span class="input-group-btn"><button class="btn btn-default" type="button">Go!</button></span>
				</div><br>

				<div class="input-group">
					<span class="input-group-addon">
						<label class="fancy-checkbox">
							<input type="checkbox">
							<span></span>
						</label>
					</span>
					<input type="text" class="form-control">
				</div><br>
				<div class="input-group">
					<span class="input-group-addon">
						<label class="fancy-checkbox custom-color-green">
							<input type="checkbox" checked>
							<span></span>
						</label>
					</span>
					<input type="text" class="form-control">
				</div><br>
				<div class="input-group">
					<span class="input-group-addon">
						<label class="fancy-checkbox custom-bgcolor-green">
							<input type="checkbox" checked>
							<span></span>
						</label>
					</span>
					<input type="text" class="form-control">
				</div><br>
				<div class="input-group">
					<span class="input-group-addon">
						<label class="control-inline fancy-radio">
							<input type="radio" name="inline-radio1" checked>
							<span><i></i></span>
						</label>
					</span>
					<input type="text" class="form-control">
				</div><br>
				<div class="input-group">
					<span class="input-group-addon">
						<label class="control-inline fancy-radio custom-color-green">
							<input type="radio" name="inline-radio2" checked>
							<span><i></i></span>
						</label>
					</span>
					<input type="text" class="form-control">
				</div><br>
				<div class="input-group">
					<span class="input-group-addon">
						<label class="control-inline fancy-radio custom-bgcolor-green">
							<input type="radio" name="inline-radio3" checked>
							<span><i></i></span>
						</label>
					</span>
					<input type="text" class="form-control">
				</div><br>
				<div class="input-group">
					<span class="input-group-addon">
						<label class="control-inline fancy-radio custom-color-blue">
							<input type="radio" name="inline-radio4" checked>
							<span><i></i></span>
						</label>
					</span>
					<input type="text" class="form-control">
				</div><br>
				<div class="input-group">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">Go!</button>
					</span>
					<input type="text" class="form-control">
				</div><br>
				<div class="input-group">
					<div class="input-group-btn">
						<button type="button" class="btn btn-default" tabindex="-1">Action</button>
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" tabindex="-1">
							<span class="caret"></span>
							<span class="sr-only">Toggle Dropdown</span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a></li>
						</ul>
					</div>
					<input type="text" class="form-control">
				</div><br>

				<div class="input-group">
					<input type="text" class="form-control">
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary" tabindex="-1">Action</button>
						<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" tabindex="-1">
							<span class="caret"></span>
							<span class="sr-only">Toggle Dropdown</span>
						</button>
						<ul class="dropdown-menu pull-right" role="menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- END INPUT GROUPS -->

		<!-- VALIDATION STATES -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Validation States</h3>
			</div>
			<div class="panel-body">
				<div class="widget-content">
					<h4>Plain</h4>
					<div class="form-group has-success has-feedback">
						<label class="control-label" for="inputSuccess2">Input with success</label>
						<input type="text" class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status">
						<span class="fa fa-check form-control-feedback" aria-hidden="true"></span>
						<span id="inputSuccess2Status" class="sr-only">(success)</span>
					</div>
					<div class="form-group has-warning has-feedback">
						<label class="control-label" for="inputWarning2">Input with warning</label>
						<input type="text" class="form-control" id="inputWarning2" aria-describedby="inputWarning2Status">
						<span class="fa fa-warning form-control-feedback" aria-hidden="true"></span>
						<span id="inputWarning2Status" class="sr-only">(warning)</span>
					</div>
					<div class="form-group has-error has-feedback">
						<label class="control-label" for="inputError2">Input with error</label>
						<input type="text" class="form-control" id="inputError2" aria-describedby="inputError2Status">
						<span class="fa fa-close form-control-feedback" aria-hidden="true"></span>
						<span id="inputError2Status" class="sr-only">(error)</span>
					</div>
					<div class="form-group has-success has-feedback">
						<label class="control-label" for="inputGroupSuccess1">Input group with success</label>
						<div class="input-group">
							<span class="input-group-addon">@</span>
							<input type="text" class="form-control" id="inputGroupSuccess1" aria-describedby="inputGroupSuccess1Status">
						</div>
						<span class="fa fa-check form-control-feedback" aria-hidden="true"></span>
						<span id="inputGroupSuccess1Status" class="sr-only">(success)</span>
					</div>
					<hr class="inner-separator" />
					<h4>On Horizontal Form</h4>
					<form class="form-horizontal">
						<div class="form-group has-success has-feedback">
							<label class="control-label col-sm-3" for="inputSuccess3">Input with success</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="inputSuccess3" aria-describedby="inputSuccess3Status">
								<span class="fa fa-check form-control-feedback" aria-hidden="true"></span>
								<span id="inputSuccess3Status" class="sr-only">(success)</span>
							</div>
						</div>
						<div class="form-group has-success has-feedback">
							<label class="control-label col-sm-3" for="inputGroupSuccess2">Input group with success</label>
							<div class="col-sm-9">
								<div class="input-group">
									<span class="input-group-addon">@</span>
									<input type="text" class="form-control" id="inputGroupSuccess2" aria-describedby="inputGroupSuccess2Status">
								</div>
								<span class="fa fa-check form-control-feedback" aria-hidden="true"></span>
								<span id="inputGroupSuccess2Status" class="sr-only">(success)</span>
							</div>
						</div>
					</form>
					<hr class="inner-separator" />
					<h4>On Inline Form</h4>
					<form class="form-inline">
						<div class="form-group has-success has-feedback">
							<label class="control-label" for="inputSuccess4">Input with success</label>
							<input type="text" class="form-control" id="inputSuccess4" aria-describedby="inputSuccess4Status">
							<span class="fa fa-check form-control-feedback" aria-hidden="true"></span>
							<span id="inputSuccess4Status" class="sr-only">(success)</span>
						</div>
					</form><br>
					<form class="form-inline">
						<div class="form-group has-success has-feedback">
							<label class="control-label" for="inputGroupSuccess3">Input group with success</label>
							<div class="input-group">
								<span class="input-group-addon">@</span>
								<input type="text" class="form-control" id="inputGroupSuccess3" aria-describedby="inputGroupSuccess3Status">
							</div>
							<span class="fa fa-check form-control-feedback" aria-hidden="true"></span>
							<span id="inputGroupSuccess3Status" class="sr-only">(success)</span>
						</div>
					</form>
					<hr class="inner-separator" />
					<h4>Optional icons with hidden <code>.sr-only</code> labels</h4>
					<div class="form-group has-success has-feedback">
						<label class="control-label sr-only" for="inputSuccess5">Hidden label</label>
						<input type="text" class="form-control" id="inputSuccess5" aria-describedby="inputSuccess5Status">
						<span class="fa fa-check form-control-feedback" aria-hidden="true"></span>
						<span id="inputSuccess5Status" class="sr-only">(success)</span>
					</div>
					<div class="form-group has-success has-feedback">
						<label class="control-label sr-only" for="inputGroupSuccess4">Input group with success</label>
						<div class="input-group">
							<span class="input-group-addon">@</span>
							<input type="text" class="form-control" id="inputGroupSuccess4" aria-describedby="inputGroupSuccess4Status">
						</div>
						<span class="fa fa-check form-control-feedback" aria-hidden="true"></span>
						<span id="inputGroupSuccess4Status" class="sr-only">(success)</span>
					</div>
				</div>
			</div>
		</div>
		<!-- END VALIDATION STATES -->
	</div>
</div>