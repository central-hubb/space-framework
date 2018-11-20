<?php
    if(!empty($_POST['email'])) {
        ?>
        <p class="alert alert-success">Thank you, You have successfully been added to our contributors list!</p>
        <?php
    }
?>

<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title">Subscribe to our Code Contributors List</h3>
	</div>
	<div class="panel-body">

        <p style="font-size:14px;color:#555;">
            Please Subscribe to our code contributors list if you would like to join our development team and help us work on this project.
            We will send developers beginners, mid weight and advanced tutorials, guides, videos, and more. We aim to bring everybody up to scratch with modern professional
            php programming we don't aim to leave anybody behind we can work with developers of all levels from first timers to advanced pro league developers.
        </p>

        <p style="font-size:14px;color:#555;">
            We will teach and work with you to create innovative features and create specific set tasks whilst learning helping you to learn and work on this framework for your own projects.
            We will allow you to participate in working on real tasks we work on as a team daily and we hope with the help you and we receive everybody can be more successful going forward into the future :)
        </p>

        <p style="font-size:14px;color:#555;">As a code contributor you will be able to view and choose from task lists we will provide and you can save your changes to our projects master source code.</p>
        <p style="font-size:14px;color:#555;">We will also list every contributors photos on this page in future so everybody can see who has contributed so far and beyond.</p>

        <p style="font-size:14px;color:#555;">We will inform everybody via email of how to work with our team and how to learn to code like a professional.</p>

        <p style="font-size:14px;color:#555;">Thanks for reading and your interests.</p>

        <p style="font-size:14px;color:#555;">Space MVC</p>

        <br />

		<form class="form-horizontal" role="form" method="post">

			<div style="width:500px;margin:auto;">
				<div class="form-group" style="margin:auto;">
					<label for="ticket-subject" class="control-label">Email Address</label>
					<div>
						<input type="email" class="form-control" name="email" placeholder="your-email@example.com">
					</div>
				</div>
				<br />
				<div class="form-group" style="text-align:right;">
					<button type="submit" class="btn btn-success" style="margin:auto;width:140px;">Subscribe</button>
				</div>
			</div>

		</form>
	</div>
</div>
