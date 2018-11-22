<!doctype html>
<html lang="en">
<head>
	<title>Admin Panel</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link type="text/css" rel="stylesheet" href="/themes/default/assets/vendor/themify-icons/css/themify-icons.css">
    <link type="text/css" rel="stylesheet" href="/themes/default/assets/vendor/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="/themes/default/assets/vendor/dropify/css/dropify.min.css">
    <link type="text/css" rel="stylesheet" href="/assets/theme/css/app.min.css">
	<link rel="apple-touch-icon" sizes="76x76" href="/themes/default/assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/themes/default/assets/img/favicon.png">
	<?php //require_once 'theme/includes-css.php'; ?>
</head>
<body style="background-color:#F5F6F9;">

    <div id="wrapper">
        <?php require_once 'theme/nav-bar.php'; ?>
        <?php require_once 'theme/side-bar-left.php'; ?>
        <div class="main">
            <?php require_once 'theme/content.php'; ?>
        </div>
        <?php require_once 'theme/side-bar-right.php'; ?>
        <?php require_once 'theme/footer.php'; ?>
    </div>
    
<?php require_once 'theme/includes-js.php'; ?>
</body>
</html>