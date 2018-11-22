<div class="row">
	<div class="col-md-6">
		<!-- PANEL PROGRESS -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Panel Progress</h3>
				<div class="right">
					<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
					<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
				</div>
			</div>
			<div class="panel-body">
				<div class="text-center margin-bottom-30">
					<img src="/themes/default/assets/img/sync-illustration.png" alt="Sync"><br><br>
					<button type="button" class="btn btn-custom-orange">Sync my data</button>
				</div>
				
			</div>
			<div class="panel-footer">
				<span class="progress-state-name">Syncing your data...</span>
				<div class="progress-right-percentage">
					<div class="progress progress-xs progress-transparent custom-color-green">
						<div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%"></div>
					</div>
					<span class="percentage">20%</span>
				</div>
			</div>
		</div>
		<!-- END PANEL PROGRESS -->

		<!-- PANEL TAB -->
		<div class="panel panel-tab">
			<div class="panel-heading">
				<h3 class="panel-title">Panel Tab</h3>
				<ul class="nav nav-tabs pull-right">
					<li class="active"><a href="#tab1" data-toggle="tab"><i class="fa fa-user"></i> Tab 1</a></li>
					<li><a href="#tab2" data-toggle="tab"><i class="fa fa-feed"></i> Tab 2</a></li>
					<li><a href="#tab3" data-toggle="tab"><i class="fa fa-gear"></i> Tab 3</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<div class="tab-content no-padding">
					<div class="tab-pane fade in active" id="tab1">
						Objectively repurpose superior content for extensible outsourcing. Objectively underwhelm future-proof technology rather than diverse architectures. Conveniently simplify flexible models with open-source functionalities. Authoritatively formulate world-class outsourcing.
					</div>
					<div class="tab-pane fade" id="tab2">
						Professionally maximize unique portals whereas out-of-the-box interfaces. Monotonectally optimize B2C communities through high-payoff methods of empowerment. Enthusiastically transition intermandated value whereas multidisciplinary portals. Credibly recaptiualize ethical ROI without stand-alone deliverables. Progressively extend progressive networks for one-to-one process improvements. 
					</div>
					<div class="tab-pane fade" id="tab3">
						Distinctively underwhelm resource sucking products and market-driven meta-services. Uniquely target granular bandwidth through compelling customer service. Dramatically mesh parallel initiatives.
					</div>
				</div>
			</div>
		</div>
		<!-- END PANEL TAB -->

		<!-- PANEL QUICK NOTE -->
		<div class="panel panel-quick-note quick-note-create">
			<div class="panel-body">
				<form class="form-horizontal" role="form">
					<input type="text" class="form-control title" name="title" placeholder="Title">
					<textarea class="form-control" rows="1" cols="30" name="note-content" placeholder="Add quick note (click here)"></textarea>
				</form>
			</div>
			<div class="panel-footer">
				<div class="btn-group">
					<button type="button" class="btn btn-icon" title="Add Image"><i class="fa fa-image"></i> <span class="sr-only">Add Image</span></button>
					<button type="button" class="btn btn-icon" title="Remind Me"><i class="fa fa-bell"></i> <span class="sr-only">Remind Me</span></button>
					<button type="button" class="btn btn-icon" title="Share"><i class="fa fa-share-alt"></i> <span class="sr-only">Share</span></button>
				</div>
				<button type="button" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Save</button>
			</div>
		</div>
		<!-- END PANEL QUICK NOTE -->

		<!-- PANEL NO PADDING -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Panel No Padding</h3>
				<div class="right">
					<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
					<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
				</div>
			</div>
			<div class="panel-body no-padding bg-primary text-center">
				<div class="padding-top-30 padding-bottom-30">
					<i class="fa fa-thumbs-o-up fa-5x"></i>
					<h3>No Content Padding</h3>
				</div>
			</div>
		</div>
		<!-- END PANEL NO PADDING -->

	</div>
	<div class="col-md-6">
		<!-- PANEL UPLOAD -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Panel Upload</h3>
			</div>
			<div class="panel-body">
				<p><em>Working demo, please mind your file before uploading</em></p>
				<form id="panel-upload" class="dropzone" action="php/dropzone-upload.php" enctype="multipart/form-data">
					<div class="fallback">
						<input type="file" name="file" multiple>
					</div>
				</form>
			</div>
		</div>
		<!-- END PANEL UPLOAD -->

		<!-- PANEL REFRESH -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Panel Refresh</h3>
				<div class="right">
					<button type="button" class="btn btn-success btn-xs btn-panel-refresh"><i class="fa fa-refresh"></i> <span>Refresh</span></button>
				</div>
			</div>
			<div class="panel-body">
				<div class="overlay-refresh">
					<div class="vertical-align-wrap">
						<div class="vertical-align-middle">
							<i class="fa fa-refresh fa-spin"></i>
							<span>Refreshing...</span>
						</div>
					</div>
				</div>
				<div class="alert alert-info"><i class="fa fa-info-circle"></i> Click Refresh button above to simulate panel refresh event</div>
				<table class="table">
					<thead>
						<tr><th>#</th><th>First Name</th><th>Last Name</th><th>Username</th></tr>
					</thead>
					<tbody>
						<tr><td>1</td><td>Steve</td><td>Jobs</td><td>@steve</td></tr>
						<tr><td>2</td><td>Simon</td><td>Philips</td><td>@simon</td></tr>
						<tr><td>3</td><td>Jane</td><td>Doe</td><td>@jane</td></tr>
					</tbody>
				</table>
			</div>
		</div>
		<!-- END PANEL REFRESH -->

		<!-- SAVED NOTES -->
		<div class="quick-note">
			<div class="quick-note-header">
				<h3 class="quick-note-title">Saved Note Example (click)</h3>
			</div>
			<div class="quick-note-content">
				<p>Completely leverage existing customer directed ideas rather than multifunctional customer service. Uniquely formulate economically sound portals whereas professional web services. 
				Proactively productize team building materials without state of the art benefits. Collaboratively re-engineer progressive vortals.</p>
			</div>
		</div>

		<!-- quick note modal -->
		<div class="modal fade" id="quick-note-modal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<div class="panel panel-quick-note quick-note-edit">
							<div class="panel-body">
								<form class="form-horizontal" role="form">
									<input type="text" class="form-control title" name="title" value="Saved Note Example" placeholder="Title">
									<textarea class="form-control" rows="7" cols="30" name="note-content" placeholder="Add quick note">Completely leverage existing customer directed ideas rather than multifunctional customer service. Uniquely formulate economically sound portals whereas professional web services. Proactively productize team building materials without state of the art benefits. Collaboratively re-engineer progressive vortals.</textarea>
								</form>
							</div>
							<div class="panel-footer">
								<div class="btn-group">
									<button type="button" class="btn btn-icon" title="Add Image"><i class="fa fa-image"></i> <span class="sr-only">Add Image</span></button>
									<button type="button" class="btn btn-icon" title="Remind Me"><i class="fa fa-bell"></i> <span class="sr-only">Remind Me</span></button>
									<button type="button" class="btn btn-icon" title="Share"><i class="fa fa-share-alt"></i> <span class="sr-only">Share</span></button>
								</div>
								<button type="button" class="btn btn-primary btn-save pull-right"><i class="fa fa-save"></i> <span>Save</span></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end quick note modal -->

		<!-- END SAVED NOTES -->
	</div>
</div>

<!-- PANEL HEADLINE -->
<div class="panel panel-headline">
	<div class="panel-heading">
		<h3 class="panel-title">Panel Headline</h3>
		<p class="panel-subtitle">Panel to display most important information</p>
	</div>
	<div class="panel-body">
		<p>Objectively network visionary methodologies via best-of-breed users. Phosfluorescently initiate go forward leadership skills before an expanded array of infomediaries. Monotonectally incubate web-enabled communities rather than process-centric.</p>
	</div>
</div>
<!-- END PANEL HEADLINE -->

<div class="row">
	<div class="col-md-6">
		<!-- PANEL DEFAULT -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Panel Default</h3>
			</div>
			<div class="panel-body">
				<p>Objectively network visionary methodologies via best-of-breed users. Phosfluorescently initiate go forward leadership skills before an expanded array of infomediaries. Monotonectally incubate web-enabled communities rather than process-centric.</p>
			</div>
		</div>
		<!-- END PANEL DEFAULT -->
	</div>
	
	<div class="col-md-6">
		<!-- PANEL WITH CONTROLS -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Panel Right Controls</h3>
				<div class="right">
					<button type="button" class="btn-toggle-collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn-remove"><i class="fa fa-close"></i></button>
				</div>
			</div>
			<div class="panel-body">
				<p>Objectively network visionary methodologies via best-of-breed users. Phosfluorescently initiate go forward leadership skills before an expanded array of infomediaries. Monotonectally incubate web-enabled communities rather than process-centric.</p>
			</div>
		</div>
		<!-- END PANEL WITH CONTROLS -->
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<!-- PANEL WITH CONTEXTUAL MENU -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Panel Contextual Menu</h3>
				<div class="right">
					<div class="dropdown">
						<a href="#" class="toggle-dropdown" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
						<ul class="dropdown-menu dropdown-menu-right">
							<li><a href="#"><i class="fa fa-fw fa-refresh"></i>Refresh</a></li>
							<li><a href="#"><i class="fa fa-fw fa-bell-slash-o"></i>Mute</a></li>
							<li><a href="#"><i class="fa fa-fw fa-cog"></i>Settings</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<p>Objectively network visionary methodologies via best-of-breed users. Phosfluorescently initiate go forward leadership skills before an expanded array of infomediaries. Monotonectally incubate web-enabled communities rather than process-centric.</p>
			</div>
		</div>
		<!-- END PANEL WITH LINK MENU -->
	</div>
	<div class="col-md-6">
		<!-- PANEL WITH LINK -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Panel Link</h3>
				<div class="right">
					<span class="link"><i class="fa fa-shopping-bag"></i> <a href="#">View all purchases (846)</a></span>
				</div>
			</div>
			<div class="panel-body">
				<p>Objectively network visionary methodologies via best-of-breed users. Phosfluorescently initiate go forward leadership skills before an expanded array of infomediaries. Monotonectally incubate web-enabled communities rather than process-centric.</p>
			</div>
		</div>
		<!-- END PANEL WITH LINK -->
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<!-- PANEL WITH BUTTON -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Panel Button</h3>
				<div class="right">
					<button type="button" class="btn btn-primary"><i class="fa fa-save"></i>Save</button>
				</div>
			</div>
			<div class="panel-body">
				<p>Objectively network visionary methodologies via best-of-breed users. Phosfluorescently initiate go forward leadership skills before an expanded array of infomediaries. Monotonectally incubate web-enabled communities rather than process-centric.</p>
			</div>
		</div>
		<!-- END PANEL WITH BUTTON -->
	</div>
	<div class="col-md-6">
		<!-- PANEL NO DIVIDER HEADING -->
		<div class="panel">
			<div class="panel-heading no-divider">
				<h3 class="panel-title">Panel No Divider Heading</h3>
				<div class="right">
					<div class="dropdown">
						<a href="#" class="toggle-dropdown" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
						<ul class="dropdown-menu dropdown-menu-right">
							<li><a href="#"><i class="fa fa-fw fa-refresh"></i>Refresh</a></li>
							<li><a href="#"><i class="fa fa-fw fa-bell-slash-o"></i>Mute</a></li>
							<li><a href="#"><i class="fa fa-fw fa-cog"></i>Settings</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<p>Objectively network visionary methodologies via best-of-breed users. Phosfluorescently initiate go forward leadership skills before an expanded array of infomediaries. Monotonectally incubate web-enabled communities rather than process-centric.</p>
			</div>
		</div>
		<!-- END PANEL NO DIVIDER HEADING -->
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<!-- PANEL WITH RIGHT TEXT -->
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Panel Right Text</h3>
				<div class="right">
					<span class="panel-info">Note: 12 hours data</span>
				</div>
			</div>
			<div class="panel-body">
				<p>Objectively network visionary methodologies via best-of-breed users. Phosfluorescently initiate go forward leadership skills before an expanded array of infomediaries. Monotonectally incubate web-enabled communities rather than process-centric.</p>
			</div>
		</div>
		<!-- END PANEL WITH RIGHT TEXT -->
	</div>
	<div class="col-md-6">
		<!-- PANEL SCROLLING -->
		<div id="panel-scrolling-demo" class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Panel Scrolling</h3>
			</div>
			<div class="panel-body">
				<div class="scroll-area">
					<p>Objectively network visionary methodologies via best-of-breed users. Phosfluorescently initiate go forward leadership skills before an expanded array of infomediaries. Monotonectally incubate web-enabled communities rather than process-centric.</p>
					<p>Objectively network visionary methodologies via best-of-breed users. Phosfluorescently initiate go forward leadership skills before an expanded array of infomediaries. Monotonectally incubate web-enabled communities rather than process-centric.</p>
					<p>Objectively network visionary methodologies via best-of-breed users. Phosfluorescently initiate go forward leadership skills before an expanded array of infomediaries. Monotonectally incubate web-enabled communities rather than process-centric.</p>
				</div>
			</div>
		</div>
		<!-- END PANEL SCROLLING -->
	</div>
</div>