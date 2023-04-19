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
        'css/site.css',
        'css/breadcrumbs.css',
        'css/custom.css',
        'css/introjs.css',
       // 'css/bootstrap-responsive.min.css',
//        'css/bootstrap.min.css',
        'css/demo.css',
        'css/animate.min.css',
        // 'css/steps.css'
//        'css/style.bundle.css'
    ];
    public $js = [
        'js/bootbox.min.js',
        'js/main.js',
        'js/sweetalert.min.js',
        'js/docman/ajax-modal-popup.js',
        'js/riskman/ajax-modal-popup.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
