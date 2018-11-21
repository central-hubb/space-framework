<script>
	var requiredCSS = [
		'assets/vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css',
		'assets/vendor/x-editable/bootstrap3-editable/css/bootstrap-editable.css'
	];

	loadCSS(requiredCSS);

	var requiredJS = [
		'assets/vendor/jquery-sparkline/js/jquery.sparkline.min.js',
		'assets/vendor/Flot/jquery.flot.js',
		'assets/vendor/Flot/jquery.flot.resize.js',
		'assets/vendor/bootstrap-progressbar/js/bootstrap-progressbar.min.js',
		'assets/vendor/x-editable/bootstrap3-editable/js/bootstrap-editable.min.js',
		'assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js',
		'assets/vendor/jquery-appear/jquery.appear.min.js',
		'assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js',
		'assets/scripts/widgets.js'
	];

	loadJS(requiredJS);

</script>


<div class="row">
	<div class="col-sm-3">
		<div class="widget widget-metric_1 animate">
			<span class="icon-wrapper custom-bg-orange"><i class="fa fa-area-chart"></i></span>
			<div class="right">
				<span class="value">$3642 <i class="change-icon change-up fa fa-sort-up text-indicator-green"></i></span>
				<span class="title">PROFIT <span class="change text-indicator-green">(+ $254)</span></span>
			</div>
		</div>

		<div class="widget widget-metric_4">
			<span class="title text-muted">Sales Performance</span>
			<span class="chart inlinesparkline" id="sales-performance">20,70,100,55,80,40,64,90,150</span>
			<span class="note"><span class="text-indicator-red">-3.74%</span> comp. to last month</span>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="widget widget-mini-bar">
			<div id="mini-bar-chart" class="mini-bar-chart">22,42,65,53,77,44,80</div>
			<span>20K SUBSCRIBERS</span>
		</div>

		<div class="widget widget-metric_5">
			<span class="title text-muted">Customer Satisfaction</span>
			<ul class="list-inline list-value">
				<li>
					<i class="fa fa-frown-o"></i>
					<span class="percentage text-indicator-red">10%</span>
				</li>
				<li>
					<i class="fa fa-meh-o"></i>
					<span class="percentage">13%</span>
				</li>
				<li>
					<i class="fa fa-smile-o"></i>
					<span class="percentage text-indicator-green">77%</span>
				</li>
			</ul>
			<span class="note">See detailed scoring <a href="#">here</a></span>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="widget widget-metric_2 animate">
			<i class="fa fa-envelope-open-o icon"></i>
			<div class="right">
				<span class="title">OPENED EMAIL</span>
				<span class="value">28652</span>
				<span class="percentage custom-text-orange2">44.15%</span>
			</div>
		</div>

		<div class="widget widget-metric_3">
			<span class="title text-muted">Avg. Handle Time</span>
			<span class="value">1m:24s</span>
			<span class="note">Min: 30s &nbsp; Max: 2m:15s</span>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="widget widget-metric_3">
			<span class="title text-muted">Your Performance Index</span>
			<span class="value">8.73</span>
			<span class="note"><span class="text-indicator-green">+13.42%</span> comp. to last month</span>
		</div>

		<div class="widget widget-stat">
			<div class="media">
				<div class="media-left media-middle">
					<i class="fa fa-shopping-bag icon-transparent-area custom-color-purple"></i>
				</div>
				<div class="media-body">
					<span class="title">SALES</span>
					<span class="value">734</span>
				</div>
			</div>
			<p class="footer text-success"><i class="fa fa-caret-up"></i> 18% <span>comp. to last week</span></p>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		<div class="widget widget-task-progress">
			<div class="top clearfix">
				<span class="title">Review Final Design</span> <span class="percentage">85%</span>
			</div>
			<div class="progress progress-sm task-progress progress-transparent custom-color-blue3">
				<div class="progress-bar" data-transitiongoal="85" aria-valuenow="85" style="width: 85%;"></div>
			</div>
			<div class="bottom clearfix">
				<i class="fa fa-check text-success"></i> <a href="#">Mark complete</a>
				<span class="note">12 days remaining</span>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="widget widget-mini-realtime-usage">
			<div class="chart" id="real-time-usage"></div>
			<div class="usage-info clearfix">
				<div class="left">
					<span class="title">MEMORY AVAILABLE</span>
					<span class="value">512 GB</span>
				</div>
				<div class="right">
					<span class="title">MEMORY USED</span>
					<span class="value"><span class="number">19.30</span> GB</span>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="widget widget-metric_6">
			<span class="icon-wrapper custom-bg-yellow"><i class="fa fa-download"></i></span>
			<div class="right">
				<span class="value">1252</span>
				<span class="title">Downloads</span>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-5">
		<div class="widget">
			<div id="progress-share" class="progress-semicircle" data-max="500">
				<div class="bar-overflow">
					<div class="bar"></div>
				</div>
				<span class="content">
					<i class="fa fa-share-alt icon"></i>
					<span class="value">380</span>

					<h4 class="heading">Share more products!</h4>
					<p class="text-muted">Get free product if you reach 500 shares goal</p>
					<button type="button" class="btn btn-primary">Share Now</button>
				</span>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="widget completeness-meter">
			<p class="complete-info">Your profile is almost awesome</p>
			<div class="progress margin-bottom-30">
				<div class="progress-bar progress-bar-primary completeness-progress" data-transitiongoal="50"></div>
			</div>
			<p>Please provide information below:</p>
			<ul class="list-unstyled fa-ul list-complete-profile">
				<li class="done"><i class="fa-li fa fa-check-circle"></i> Confirm your email</li>
				<li class="done"><i class="fa-li fa fa-check-circle"></i> Setup two-way authentication</li>
				<li>
					<i class="fa-li fa fa-circle-o"></i> <a href="#" id="complete-phone-number" data-type="text" data-pk="1" data-title="Phone number">Add your phone number</a>
				</li>
				<li>
					<i class="fa-li fa fa-circle-o"></i> <a href="#" id="complete-nickname" data-type="text" data-pk="1" data-title="Nickname" data-placeholder="your nickname">Add your nickname</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="col-md-3">
		<div class="file-item">
			<a href="#">
				<span class="file-preview pdf">
					<i class="fa fa-file-pdf-o"></i> <span class="file-extension">.pdf</span>
				</span>
			</a>
			<div class="file-info">
				<a href="#"><span class="file-name">Proposal_FINAL.pdf</span></a>
				<span class="file-date">Added 11 Jun 2017</span>
				<div class="dropdown">
					<a href="#" class="toggle-dropdown" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="#"><i class="fa fa-cloud-download"></i> Download</a></li>
						<li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
						<li><a href="#"><i class="fa fa-trash"></i> Delete</a></li>
					</ul>
				</div>
				
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="widget widget-system-load">
			<div id="load-chart" class="chart easy-pie-chart" data-percent="70">
				<span class="percent">70</span>
			</div>
			<div class="info">
				<h4 class="heading-title">System Load</h4>
				<div class="row">
					<div class="col-xs-4">
						<span class="title">LOW</span>
						<span class="value"><span class="number">45</span>%</span>
					</div>
					<div class="col-xs-4">
						<span class="title">AVERAGE</span>
						<span class="value"><span class="number">73</span>%</span>
					</div>
					<div class="col-xs-4">
						<span class="title">HIGH</span>
						<span class="value"><span class="number">95</span>%</span>
					</div>
				</div>
				<div class="controls">
					<a href="#" class="btn btn-primary btn-sm"><i class="fa fa-cog"></i> MANAGE</a>
					<a href="#" class="btn btn-default btn-sm"><i class="fa fa-file-text-o"></i> VIEW SYS DOC</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="widget">
			<ul class="list-unstyled list-widget-horizontal no-border row">
				<li class="col-md-6">
					<div class="widget-metric_2">
						<i class="fa fa-calendar-o icon"></i>
						<div class="right">
							<span class="title">WEEKLY REVENUE</span>
							<span class="value">$738</span>
							<span class="percentage text-indicator-red"><i class="fa fa-level-down"></i> 2.67%</span>
						</div>
					</div>
				</li>
				<li class="col-md-6">
					<div class="widget-metric_2">
						<i class="fa fa-shopping-basket icon"></i>
						<div class="right">
							<span class="title">WEEKLY SALES</span>
							<span class="value">236</span>
							<span class="percentage text-indicator-green"><i class="fa fa-level-up"></i> 14.86%</span>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>