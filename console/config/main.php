
<?php
$components = array_merge(
    require(__DIR__ . '/db.php'),
    require(__DIR__ . '/components.php')
);
return [
    'id' => 'app-console',
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'basePath' => dirname(__DIR__),
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
        'gridview' => ['class' => 'kartik\grid\Module'],
        'gii' => [
            'class' => 'yii\gii\Module',
            //'allowedIPs' => ['127.0.0.1', '::1', '192.168.1.*'] // adjust this to your needs
            'allowedIPs' => ['*'] // adjust this to your needs
        ],
        'message' => [
            'class' => 'thyseus\message\Module',
            'userModelClass' => '\common\models\system\User', // your User model. Needs to be ActiveRecord.
        ],
    ],
    
    'components' => $components,
    'defaultRoute' => 'finance/request',
];