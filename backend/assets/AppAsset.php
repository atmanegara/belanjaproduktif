<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css",
        'css/table-cart.css',
        'color-admin/assets/plugins/jquery-ui/jquery-ui.min.css',
        'color-admin/assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css',
        'color-admin/assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css',
        'color-admin/assets/plugins/animate/animate.min.css',
        'color-admin/assets/plugins/ionicons/css/ionicons.min.css',
        'color-admin/assets/plugins/superbox/css/superbox.min.css',
        'color-admin/assets/plugins/lity/dist/lity.min.css',
        'color-admin/assets/css/apple/style.min.css',
        'color-admin/assets/css/apple/style-responsive.min.css',
        'color-admin/assets/css/apple/theme/default.css',
              'color-admin/assets/plugins/isotope/isotope.css',
              'color-admin/assets/plugins/lightbox/css/lightbox.css',
    ];
    public $js = [
        '//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js',
        'js/modal_cart.js',
        'js/modal.js',
        'js/print-thermal.js',
    //    'color-admin/assets/plugins/pace/pace.min.js',
        'color-admin/assets/js/theme/default.min.js',
        'color-admin/assets/js/apps.js',
        'color-admin/assets/plugins/js-cookie/js.cookie.js',
        'color-admin/assets/plugins/isotope/jquery.isotope.min.js',
        'color-admin/assets/plugins/lightbox/js/lightbox.min.js',
        'color-admin/assets/plugins/flot/jquery.flot.min.js',
        'color-admin/assets/plugins/flot/jquery.flot.time.min.js',
        'color-admin/assets/plugins/flot/jquery.flot.resize.min.js',
        'color-admin/assets/plugins/flot/jquery.flot.pie.min.js',
        'color-admin/assets/plugins/jquery-ui/jquery-ui.min.js',
        'color-admin/assets/plugins/js-cookie/js.cookie.js',
        'color-admin/assets/plugins/jquery-ui/jquery-ui.min.js',
        'color-admin/assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js',
        'color-admin/assets/plugins/slimscroll/jquery.slimscroll.min.js',
        'color-admin/assets/plugins/jquery/jquery-migrate-1.1.0.min.js',
        'color-admin/assets/plugins/gritter/js/jquery.gritter.js',
        'color-admin/assets/plugins/bootstrap-show-password/bootstrap-show-password.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_BEGIN
    ];
}
