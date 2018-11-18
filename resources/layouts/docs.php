<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">
    <title>Space MVC</title>
    <link type="text/css" rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900">
    <link type="text/css" rel="stylesheet" href="/docs/assets/css/main.css">
	<?php
        if (strpos($_SERVER['REQUEST_URI'], 'cover') !== false) {
            ?><link href="/frontend/assets/css/examples/cover.css" rel="stylesheet"><?php
        }
	?>
    <script type="text/javascript" async defer src="//buttons.github.io/buttons.js"></script>
    <link href="/bower_components/rainbow/themes/css/github.css" rel="stylesheet" type="text/css">
</head>

<body>

<?php require_once 'frontend/partials/nav-bar.php'; ?>

<style type="text/css">
	a {
		color:#42b6f4;
	}
</style>

<div class="jumbotron" style="height:260px;padding-top:60px;">
	<div class="container">
		<h1 class="display-5">Space MVC</h1>
		<p>
			The Space MVC PHP Framework is the fastest and most lightweight high performance, scalable, advanced
            PHP 7+ framework available. Born from the best ideas of other popular and mainstream frameworks,
            with a fresh start built from the ground up to perform record breaking performance benchmarks! (This
            framework runs 4x faster than laravel and uses 10x less cpu processing than symfony)
		</p>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-4">
			<?php require_once 'docs/partials/side-bar.php'; ?>
		</div>
		<div class="col-md-8">
			<?php echo $content;?>
		</div>
	</div>
	<hr />
</div>

<footer class="container">
    <p>&nbsp;</p>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<!--<script src="../../assets/js/vendor/popper.min.js"></script>-->
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/bower_components/holderjs/holder.min.js"></script>

<script src="/bower_components/rainbow/dist/rainbow.min.js"></script>
<script src="/bower_components/rainbow/src/language/generic.js"></script>
<script src="/bower_components/rainbow/src/language/php.js"></script>

</body>
</html>
