<span>Enable/Disable: </span>&nbsp;&nbsp;
<label class="fancy-checkbox custom-bgcolor-green"><input type="checkbox" id="state" checked><span>Enable</span></label>

<form id="editable-options" class="margin-bottom-30">
	<span>Mode: </span>&nbsp;&nbsp;
	<label class="fancy-radio custom-color-green"><input name="mode" value="Popup" type="radio" checked><span><i></i>Popup</span></label>
	<label class="fancy-radio custom-color-green"><input name="mode" value="Inline" type="radio"><span><i></i>Inline</span></label>
</form>

<table id="editable-demo" class="table table-bordered table-striped" style="width: 800px;">
	<tbody>
	<tr>
		<td>Simple text field</td>
		<td><a href="#" id="username" data-type="text" data-pk="1" data-title="Enter username">superuser</a></td>
	</tr>
	<tr>
		<td>Required, client-side error message</td>
		<td><a href="#" id="lastname" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-title="Enter your last name">mylastname</a></td>
	</tr>
	<tr>
		<td>Select, local array, custom display</td>
		<td><a href="#" id="sex" data-type="select" data-pk="1" data-value="" data-title="Select sex"></a></td>
	</tr>
	<tr>
		<td>Select, remote array, no buttons</td>
		<td><a href="#" id="group" data-type="select" data-pk="1" data-value="5" data-source="/groups" data-title="Select group">Admin</a></td>
	</tr>
	<tr>
		<td>Select, error while loading</td>
		<td><a href="#" id="status" data-type="select" data-pk="1" data-value="0" data-source="/status" data-title="Select status">Active</a></td>
	</tr>
	<tr>
		<td>Datepicker</td>
		<td><a href="#" id="dob" data-type="date" data-pk="1" data-url="/post" data-title="Select date">15/05/1984</a></td>
	</tr>
	<tr>
		<td>Combodate (date)</td>
		<td><a href="#" id="combodate" data-type="combodate" data-value="1984-05-23" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="1"  data-title="Select Date of birth"></a></td>
	</tr>
	<tr>
		<td>Combodate (datetime)</td>
		<td><a href="#" id="event" data-type="combodate" data-template="D MMM YYYY  HH:mm" data-format="YYYY-MM-DD HH:mm" data-viewformat="MMM D, YYYY, HH:mm" data-pk="1"  data-title="Setup event date and time"></a></td>
	</tr>
	<tr>
		<td>Textarea, buttons below. Submit by <i>ctrl+enter</i></td>
		<td><a href="#" id="comments" data-type="textarea" data-pk="1" data-placeholder="Your comments here..." data-title="Enter comments">awesome user!</a></td>
	</tr>
	<tr>
		<td>Twitter typeahead.js</td>
		<td><a href="#" id="state2" data-type="typeaheadjs" data-pk="1" data-placement="right" data-title="Start typing State.."></a></td>
	</tr>
	<tr>
		<td>Checklist</td>
		<td><a href="#" id="fruits" data-type="checklist" data-value="2,3" data-title="Select fruits"></a></td>
	</tr>
	<tr>
		<td>Custom input, several fields</td>
		<td><a href="#" id="address" data-type="address" data-pk="1" data-title="Please, fill address"></a></td>
	</tr>
	</tbody>
</table>