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
        'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
        'css/adminlte.min.css',
        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700',
        'css/fa/css/all.min.css',
        'css/toastr/toastr.min.css'
    ];
    public $js = [
        'js/bootstrap/bootstrap.bundle.min.js',
        'js/adminlte.min.js',
        'js/demo.js',
        'js/toastr/toastr.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
