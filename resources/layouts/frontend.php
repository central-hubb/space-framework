<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">
    <title>Jumbotron Template for Bootstrap</title>
    <link href="/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="/frontend/assets/css/examples/blog.css" rel="stylesheet">
    <link href="/frontend/assets/css/examples/carousel.css" rel="stylesheet">
    <link href="/frontend/assets/css/examples/form-validation.css" rel="stylesheet">
    <?php
        if (strpos($_SERVER['REQUEST_URI'], 'cover') !== false) {
            ?><link href="/frontend/assets/css/examples/cover.css" rel="stylesheet"><?php
        }
    ?>
    <script type="text/javascript" async defer src="//buttons.github.io/buttons.js"></script>
</head>

<body>

<?php require_once 'frontend/partials/nav-bar.php'; ?>

<main role="main" style="width:100%;">
    <?php echo $content; ?>
</main>

<footer class="container">
    <p>&nbsp;</p>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<!--<script src="/bower_components/popper.js/dist/popper.min.js"></script>-->
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/bower_components/holderjs/holder.min.js"></script>
<script type="text/javascript">
    Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
    });
</script>
<script type="text/javascript">
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';

        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');

            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
</body>
</html>
