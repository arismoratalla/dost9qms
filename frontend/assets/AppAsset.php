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
        'css/steps.css'
//        'css/style.bundle.css'
    ];
    public $js = [
        'js/bootbox.min.js',
        'js/main.js',
        'js/jquery.validate.min.js',
        'js/lineitembudget/ajax-modal-popup.js',
        'js/ppmp/ajax-modal-popup.js',
        'js/budget/ajax-modal-popup.js',
        'js/cashier/ajax-modal-popup.js',
        'js/docman/ajax-modal-popup.js',
        'js/employeecompensation/ajax-modal-popup.js',
        'js/finance/ajax-modal-popup.js',
        'js/finance/fileinput.min.js',
        'js/finance/sortable.min.js',
        'js/intro.js',
//        'js/scripts.bundle.js',
        //'js/dashboard/dashboard.js',
        //'js/dashboard/jquery.knob.min.js',
        //'js/supplemental/ajax-modal-popup.js',
        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
