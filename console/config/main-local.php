<?php
$components = array_merge(
    require(__DIR__ . '/db.php'),
    require(__DIR__ . '/components.php')
);
return [
    'id' => 'app-console',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
        'gridview' => ['class' => 'kartik\grid\Module']
    ],
    'components' => $components
    
];
