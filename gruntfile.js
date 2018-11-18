module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        cssmin: {
            options: {
                mergeIntoShorthands: false,
                roundingPrecision: -1
            },
            target: {
                files: {
                    'public/assets/theme/css/app.min.css': [
                        'public/themes/default/assets/vendor/bootstrap/css/bootstrap.min.css',
                        'public/themes/default/assets/vendor/jquery-ui/themes/base/jquery-ui.min.css',
                        'public/themes/default/assets/vendor/pace/themes/orange/pace-theme-minimal.css',
                        'public/themes/default/assets/css/main.css',
                        'public/themes/default/assets/css/skins/sidebar-nav-darkblue.css',
                        'public/themes/default/assets/css/skins/navbar1.css',
                        'public/themes/default/assets/css/demo.css',
                        'public/themes/default/assets/vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css',
                        'public/themes/default/assets/vendor/x-editable/bootstrap3-editable/css/bootstrap-editable.css',
                        'public/themes/default/assets/vendor/bootstrap-tour/css/bootstrap-tour.min.css',
                        'public/themes/default/assets/vendor/x-editable/bootstrap3-editable/css/bootstrap-editable.css',
                        'public/themes/default/assets/vendor/bootstrap-tour/css/bootstrap-tour.min.css',
                        'public/themes/default/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css',
                        'public/themes/default/assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css',
                        'public/themes/default/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
                        'public/themes/default/assets/vendor/clockpicker/bootstrap-clockpicker.min.css',
                        'public/themes/default/assets/vendor/bootstrap-slider/slider.css',
                        'public/themes/default/assets/vendor/x-editable/bootstrap3-editable/css/bootstrap-editable.css',
                        'public/themes/default/assets/vendor/x-editable/inputs-ext/typeaheadjs/lib/typeahead.js-bootstrap.css',
                        'public/themes/default/assets/vendor/bootstrap-markdown/bootstrap-markdown.min.css',
                        'https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css',
                        'public/themes/default/assets/vendor/datatables-tabletools/css/dataTables.tableTools.css',
                        'public/themes/default/assets/vendor/datatables/css-main/jquery.dataTables.min.css',
                        'public/themes/default/assets/vendor/datatables/css-bootstrap/dataTables.bootstrap.min.css',
                        'public/themes/default/assets/vendor/datatables-tabletools/css/dataTables.tableTools.css',
                        'public/themes/default/assets/vendor/select2/css/select2.min.css',
                        'public/themes/default/assets/vendor/x-editable/inputs-ext/address/address.css',
                        'public/themes/default/assets/vendor/summernote/summernote.css',
                        'public/themes/default/assets/css/vendor/animate/animate.min.css',
                        'public/themes/default/assets/vendor/jqvmap/jqvmap.min.css',
                        'public/themes/default/assets/css/vendor/animate/animate.min.css',
                        'public/themes/default/assets/vendor/chartist/css/chartist-custom.css',
                        'public/themes/default/assets/vendor/slick/slick.css',
                        'public/themes/default/assets/vendor/slick/slick-theme.css',
                        'public/bower_components/nouislider/distribute/nouislider.min.css',
                        'public/bower_components/parsleyjs/src/parsley.css',
                        'public/themes/default/assets/vendor/switchery/switchery.min.css',
                    ]
                }
            }
        },
        uglify: {
            master: {
                files: {
                    'public/assets/theme/js/app.min.js': [
                        'public/themes/default/assets/vendor/jquery/jquery.min.js',
                        'public/themes/default/assets/vendor/bootstrap/js/bootstrap.min.js',
                        'public/themes/default/assets/vendor/pace/pace.min.js',
                        'public/themes/default/assets/scripts/main-menu.js',

                        //  data tables
                        'https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                        'https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js',
                        'https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js',
                        'https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js',
                        'https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js',
                        'public/themes/default/assets/vendor/datatables/js-main/jquery.dataTables.min.js',
                        'public/themes/default/assets/vendor/datatables/js-bootstrap/dataTables.bootstrap.min.js',
                        'public/themes/default/assets/vendor/datatables-tabletools/js/dataTables.tableTools.js',

                        // jquery ui
                        'public/themes/default/assets/vendor/jquery-ui/jquery-ui.min.js',
                        'public/themes/default/assets/vendor/jquery-ui/ui/widget.js',
                        'public/themes/default/assets/vendor/jquery-ui/ui/data.js',
                        'public/themes/default/assets/vendor/jquery-ui/ui/scroll-parent.js',
                        'public/themes/default/assets/vendor/jquery-ui/ui/disable-selection.js',
                        'public/themes/default/assets/vendor/jquery-ui/ui/widgets/mouse.js',
                        'public/themes/default/assets/vendor/jquery-ui/ui/widgets/sortable.js',

                        'public/themes/default/assets/vendor/jquery-appear/jquery.appear.min.js',
                        'public/themes/default/assets/vendor/jquery-sparkline/js/jquery.sparkline.min.js',

                        // ?
                        'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js',
                        'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js',
                        'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js',

                        // flot
                        'public/themes/default/assets/vendor/Flot/jquery.flot.js',
                        'public/themes/default/assets/vendor/Flot/jquery.flot.resize.js',
                        'public/themes/default/assets/vendor/Flot/jquery.flot.pie.js',
                        'public/themes/default/assets/vendor/Flot/jquery.flot.time.js',
                        'public/themes/default/assets/vendor/flot.tooltip/jquery.flot.tooltip.js',

                        // raphael
                        'public/themes/default/assets/vendor/raphael/raphael.min.js',

                        //just gage
                        'public/themes/default/assets/vendor/justgage-toorshia/justgage.js',

                        // jqv map
                        'public/themes/default/assets/vendor/jqvmap/jquery.vmap.min.js',
                        'public/themes/default/assets/vendor/jqvmap/maps/jquery.vmap.world.js',
                        'public/themes/default/assets/vendor/jqvmap/maps/jquery.vmap.usa.js',

                        'public/themes/default/assets/vendor/bootstrap-progressbar/js/bootstrap-progressbar.min.js',

                        'public/themes/default/assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js',

                        'public/themes/default/assets/vendor/moment/min/moment.min.js',

                        'public/themes/default/assets/vendor/jquery-sparkline/js/jquery.sparkline.min.js',

                        'public/themes/default/assets/vendor/bootstrap-tour/js/bootstrap-tour.min.js',

                        'public/themes/default/assets/vendor/jquery-appear/jquery.appear.min.js',

                        // bootstrap
                        'public/themes/default/assets/vendor/bootstrap-progressbar/js/bootstrap-progressbar.min.js',
                        'public/themes/default/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js',
                        'public/themes/default/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
                        'public/themes/default/assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js',
                        'public/themes/default/assets/vendor/bootstrap-markdown/bootstrap-markdown.js',
                        'public/themes/default/assets/vendor/bootstrap-slider/bootstrap-slider.js',
                        'public/themes/default/assets/vendor/clockpicker/bootstrap-clockpicker.min.js',

                        // chart js
                        'public/themes/default/assets/vendor/chart-js/Chart.min.js',

                        // jqv map
                        'public/themes/default/assets/vendor/jqvmap/jquery.vmap.min.js',
                        'public/themes/default/assets/vendor/jqvmap/maps/jquery.vmap.world.js',

                        // slick
                        'public/themes/default/assets/vendor/slick/slick.min.js',

                        // forms: multi select
                        'public/themes/default/assets/scripts/forms/forms-multiselect.js',

                        // forms: input pickers
                        'public/themes/default/assets/scripts/forms/forms-input-pickers.js',

                        //'/bower_components/nouislider/distribute/nouislider.min.js',
                        'public/themes/default/assets/vendor/wnumb/wNumb.js',
                        //'public/themes/default/assets/vendor/nouislider/js/nouislider.min.js',

                        // select2
                        'public/themes/default/assets/vendor/select2/js/select2.min.js',
                        'public/themes/default/assets/scripts/forms/forms-select2.js',

                        // x editable
                        'public/themes/default/assets/vendor/x-editable/bootstrap3-editable/js/bootstrap-editable.min.js',
                        'public/themes/default/assets/vendor/x-editable/inputs-ext/typeaheadjs/lib/typeahead.js',
                        'public/themes/default/assets/vendor/x-editable/inputs-ext/typeaheadjs/typeaheadjs.js',
                        'public/themes/default/assets/vendor/x-editable/inputs-ext/address/address.js',
                        'public/themes/default/assets/vendor/x-editable/bootstrap3-editable/js/bootstrap-editable.min.js',
                        'public/themes/default/assets/scripts/forms/forms-xeditable.js',

                        // moment
                        'public/themes/default/assets/vendor/moment/min/moment.min.js',

                        // mock ajax
                        'public/themes/default/assets/scripts/jquery.mockjax.min.js',

                        // demo mock
                        'public/themes/default/assets/scripts/demo-mock.js',

                        // dropify
                        'public/themes/default/assets/vendor/dropify/js/dropify.min.js',

                        // form drag drop upload
                        'public/themes/default/assets/scripts/forms/forms-dragdropupload.js',

                        // parsley
                        'public/bower_components/parsleyjs/dist/parsley.min.js',

                        // forms validations
                        'public/themes/default/assets/scripts/forms/forms-validation.js',

                        // summer note
                        'public/themes/default/assets/vendor/summernote/summernote.min.js',

                        // markdown
                        'public/themes/default/assets/vendor/markdown/markdown.js',
                        'public/themes/default/assets/vendor/to-markdown/to-markdown.js',

                        // form text editor
                        'public/themes/default/assets/scripts/forms/forms-texteditor.js',

                        // jquery masked input
                        'public/themes/default/assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js',

                        // pw strength
                        'public/themes/default/assets/vendor/pwstrength-bootstrap/pwstrength-bootstrap.min.js',

                        // hide show password
                        'public/themes/default/assets/vendor/hideshowpassword/hideShowPassword.min.js',

                        // switchery
                        'public/themes/default/assets/vendor/switchery/switchery.min.js',

                        // jquery easy pie chart
                        'public/themes/default/assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js',

                        // chartist
                        'public/themes/default/assets/vendor/chartist/js/chartist.min.js',

                        // jquery mapael
                        'public/themes/default/assets/vendor/jquery-mapael/js/jquery.mapael.min.js',
                        'public/themes/default/assets/vendor/jquery-mapael/js/maps/world_countries.min.js',

                        // slim scroll
                        'public/themes/default/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js',

                        // apps
                        'public/themes/default/assets/scripts/app.js',

                        // forms inputs
                        'public/themes/default/assets/scripts/forms/forms-inputs.js',

                        // 'public/themes/default/assets/scripts/forms/forms-input-sliders.js',
                    ]
                }
            }
        }
    });

    // Load the plugin that provides the "uglify" task.
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    // Default task(s).
    grunt.registerTask('default', ['cssmin', 'uglify']);

};