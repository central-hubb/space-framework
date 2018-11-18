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

    <script type="text/javascript" src="/assets/theme/js/app.min.js"></script>
    <script type="text/javascript">
        $.fn.clickToggle = function( f1, f2 ) {
            return this.each( function() {
                var clicked = false;
                $(this).bind('click', function() {
                    if(clicked) {
                        clicked = false;
                        return f2.apply(this, arguments);
                    }

                    clicked = true;
                    return f1.apply(this, arguments);
                });
            });
        };

        $( document ).ready(function() {
            $('#sidebar-nav-menu div').removeClass('in');
            $('#sidebar-nav-menu a').removeClass('active');

            $.each($('#sidebar-nav-menu li a'), function( index, element ) {

                var href = $(element).attr('href');
                var currentUrl = window.location.pathname;

                if(href === currentUrl) {
                    $(element).addClass('active');
                    $(element).parents('.panel').find('> div').addClass('in');
                    $(element).parents('.panel').find('> a').addClass('active');

                }
            });


        });

        let currentUrl = window.location.pathname;

        switch (currentUrl) {
            case '/theme':
                document.write('<script type="text/javascript" src="/themes/default/assets/scripts/dashboards/dashboard.js"><\/script>');
                break;

            case '/theme/dashboards/dashboard-v1':
                document.write('<script type="text/javascript" src="/themes/default/assets/scripts/dashboards/dashboard.js"><\/script>');
                break;

            case '/theme/dashboards/dashboard-v2':
                document.write('<script type="text/javascript" src="/themes/default/assets/scripts/dashboards/dashboard2.js"><\/script>');
                break;

            case '/theme/dashboards/dashboard-v3':
                document.write('<script type="text/javascript" src="/themes/default/assets/scripts/dashboards/dashboard3.js"><\/script>');
                break;

            case '/theme/dashboards/dashboard-v4':
                document.write('<script type="text/javascript" src="/themes/default/assets/scripts/dashboards/dashboard4.js"><\/script>');
                break;

            default:
        }

        // input: auto complete
        // data-source = url containing json array
        $('.ui-autocomplete-input').each(function(i, el) {
            el = $(el);
            var source = el.attr('data-source');
            el.autocomplete({
                source: source
            });
        });

        //  input: password show / hide
        $( document ).ready(function() {
            $('.input-password-show-hide').hideShowPassword(true, true);
        });

    </script>
</body>
</html>