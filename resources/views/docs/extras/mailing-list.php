<?php
    if(!empty($_POST['email'])) {
        ?>
        <p class="alert alert-success">Thank you, You have successfully been added to our mailing list!</p>
        <?php
    }
?>

<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title">Subscribe to our Mailing List</h3>
	</div>
	<div class="panel-body">

        <p  style="font-size:16px;color:grey;">Please Subscribe to our mailing list to receive updates on our frameworks new features
            as we create them and for lots of video tutorials and documentation to go with it.</p>
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
