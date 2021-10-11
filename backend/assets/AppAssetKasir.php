<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAssetKasir extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
       "css/site.css",
    ];
    public $js = [
        'js/modal.js',
        'color-admin/assets/plugins/jquery-ui/jquery-ui.min.js',
        'color-admin/assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
     public $jsOptions = [
        'position' => \yii\web\View::POS_BEGIN
    ];
}
