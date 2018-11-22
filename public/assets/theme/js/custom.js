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
    if($('.input-password-show-hide').length) {
        $('.input-password-show-hide').hideShowPassword(true, true);
    }
});

