<div class="main-content">
	<div class="content-heading clearfix">
		<div class="heading-left">
			<h1 class="page-title" id="view-title"><?php echo viewData($data, 'page_title', 'Page Title'); ?></h1>
			<p class="page-subtitle" id="view-description"><?php echo viewData($data, 'page_description', 'Page Description'); ?></p>
		</div>
		<ul class="breadcrumb" id="view-breadcrumb">
			<li class="home"><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="#dashboards"> Dashboards </a></li>
			<li class="active"> Dashboard v1 </li>
		</ul>
	</div>
	<div id="main-content">
		<div>
			<?php echo $content; ?>
		</div>
        <div style="clear:both;"></div>
	</div>
</div>