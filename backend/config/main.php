<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
     //'bootstrap' => ['log'],
    'bootstrap' => ['log', 'maintenanceMode'],
    'modules' =>require(__DIR__.'/_modules.php'), // Load routes from PHP File
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\system\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'maintenanceMode' => [
            // Component class namespace
            'class' => 'brussens\maintenance\MaintenanceMode',
            // Page title
            'title' => 'Under Maintenance!',
            // Mode status
            'enabled' => false,
            // Route to action
            'route' => 'maintenance/index',
            // Show message
            'message' => 'Sorry, we are updating the system. Please come back soon...',
            // Allowed role
            'roles' => [
                'super-administrator',
            ],
            'urls' => [
                'site/login',
                'debug/default/toolbar',
                'debug/default/view',
                'settings/disable',
                'settings/enable',
            ],
            // Allowed IP addresses
            //'ips' => [
            // '127.0.0.1',
            //],
            // Layout path
            'layoutPath' => '@backend/views/admin-lte/layouts/main.php',
            // View path
            'viewPath' => '@backend/views/maintenance',
            // User name attribute name
            'usernameAttribute' => 'username',
            // HTTP Status Code
            'statusCode' => 503,
            //Retry-After header
            'retryAfter' => 120 //or Wed, 21 Oct 2015 07:28:00 GMT for example
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'view' => [
         'theme' => [
             'pathMap' => [
                //'@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                '@app/views' => '@backend/views/admin-lte'
             ],
         ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
       'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules'=>require(__DIR__.'/_routes.php') // Load routes from PHP File
        ],
    ],
    'as access' => [
        //'class' => 'mdm\admin\components\AccessControl',
        'class' => 'common\modules\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            '/admin/user/signup'
        ]
    ],
    'params' => $params,
];
