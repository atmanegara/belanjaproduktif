<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700',
        'css/plugins/bootstrap3/css/bootstrap.min.css',
        'css/plugins/font-awesome/css/font-awesome.min.css',
        'css/plugins/animate/animate.min.css',
        'css/css/e-commerce/style.min.css',
        'css/css/e-commerce/style-responsive.min.css',
        'css/css/e-commerce/theme/default.css'
    ];
    public $js = [
      'js/modal.js',
        'css/plugins/pace/pace.min.js',
        'css/plugins/jquery/jquery-3.2.1.min.js',
        'css/plugins/bootstrap3/js/bootstrap.min.js',
        'css/plugins/js-cookie/js.cookie.js',
        'css/js/e-commerce/apps.min.js',
        'color-admin/assets/plugins/bootstrap-show-password/bootstrap-show-password.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
    
}
