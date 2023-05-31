const mix = require('laravel-mix');

mix.styles([
    'resources/assets/admin/bootstrap/css/bootstrap.min.css',
    'resources/assets/admin/bootstrap/css/bootstrap.min.css.map',
    'resources/assets/admin/font-awesome/4.5.0/css/font-awesome.min.css',
    'resources/assets/admin/plugins/bootstrap-switch/bootstrap-switch.min.css',
    'resources/assets/admin/ionicons/2.0.1/css/ionicons.min.css',
    'resources/assets/admin/plugins/chosen/chosen.min.css',
    'resources/assets/admin/plugins/iCheck/flat/blue.css',
    'resources/assets/admin/plugins/datepicker/datepicker3.css',
    'resources/assets/admin/plugins/select2/select2.min.css',
    'resources/assets/admin/plugins/datatables/dataTables.bootstrap.css',
    'resources/assets/admin/dist/css/AdminLTE.min.css',
    'resources/assets/admin/dist/css/skins/_all-skins.min.css',
    'resources/assets/admin/style.css',
    'resources/assets/admin/media.css'
], 'public/css/admin.css');


mix.scripts([
    'resources/assets/admin/plugins/jQuery/jquery-2.2.3.min.js',
    'resources/assets/admin/bootstrap/js/bootstrap.min.js',
    'resources/assets/admin/plugins/bootstrap-filestyle/bootstrap-filestyle.min.js',
    'resources/assets/admin/plugins/bootstrap-switch/bootstrap-switch.min.js',
    'resources/assets/admin/plugins/select2/select2.full.min.js',
    'resources/assets/admin/plugins/datepicker/bootstrap-datepicker.js',
    'resources/assets/admin/plugins/datatables/jquery.dataTables.min.js',
    'resources/assets/admin/plugins/datatables/dataTables.bootstrap.min.js',
    'resources/assets/admin/plugins/slimScroll/jquery.slimscroll.min.js',
    'resources/assets/admin/plugins/fastclick/fastclick.js',
    'resources/assets/admin/plugins/iCheck/icheck.min.js',
    'resources/assets/admin/plugins/chosen/chosen.jquery.min.js',
    'resources/assets/admin/plugins/jquery.multi-select.js',
    'resources/assets/admin/plugins/jquery.quick-search.js',
    'resources/assets/admin/plugins/imagesloaded.pkgd.min.js',
    'resources/assets/admin/dist/js/app.min.js',
    'resources/assets/admin/dist/js/demo.js',
    'resources/assets/admin/dist/js/scripts.js'
], 'public/js/admin.js');

mix.copy('resources/assets/admin/bootstrap/fonts', 'public/fonts');
mix.copy('resources/assets/admin/dist/fonts', 'public/fonts');
mix.copy('resources/assets/admin/dist/img', 'public/img');
mix.copy('resources/assets/admin/plugins/iCheck/flat/blue.png', 'public/css');
mix.copy('resources/assets/admin/plugins/chosen/chosen-sprite.png', 'public/css');
mix.copy('resources/assets/admin/plugins/chosen/chosen-sprite@2x.png', 'public/css');
