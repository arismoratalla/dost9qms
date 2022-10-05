<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);
$modules= array_merge(
    require __DIR__ . '/_modules.php',
    require __DIR__ . '/_fixed_module.php'   
);
return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    //'bootstrap' => ['log'],
    'bootstrap' => ['log', 'maintenanceMode'],
    'controllerNamespace' => 'frontend\controllers',
    //'modules' =>require(__DIR__.'/_modules.php'), // Load routes from PHP File
    'modules' =>$modules,
    //'modules'=>parse_ini_file(Yii::$app->basePath.'/config/module.ini',true),
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'places' => [
            'class' => '\dosamigos\google\places\Places',
            'key' => 'AIzaSyBkbMSbpiE90ee_Jvcrgbb12VRXZ9tlzIc',
            'format' => 'json' // or 'xml'
        ],
        'placesSearch' => [
            'class' => '\dosamigos\google\places\Search',
            'key' => 'AIzaSyBkbMSbpiE90ee_Jvcrgbb12VRXZ9tlzIc',
            'format' => 'json' // or 'xml'
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'jsOptions' => ['position' => \yii\web\View::POS_HEAD],
                ],
            ],
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
            'layoutPath' => '@frontend/views/admin-lte/layouts/main.php',
            // View path
            'viewPath' => '@frontend/views/maintenance',
            // User name attribute name
            'usernameAttribute' => 'username',
            // HTTP Status Code
            'statusCode' => 503,
            //Retry-After header
            'retryAfter' => 120 //or Wed, 21 Oct 2015 07:28:00 GMT for example
        ],
       
        'user' => [
            'identityClass' => 'common\models\system\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'view' => [
         'theme' => [
             'pathMap' => [
                //'@app/views/' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                '@app/views' => '@frontend/views/admin-lte'
             ],
         ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'urlManagerBackend'=>[
            'class' => 'yii\web\UrlManager',
            'baseUrl' => '//localhost/faims/backend/web',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules'=>require(__DIR__.'/_routes.php') // Load routes from PHP File
        ],
        'imagemanager' => [
		'class' => 'noam148\imagemanager\components\ImageManagerGetPath',
		//set media path (outside the web folder is possible)
		'mediaPath' => '../../backend/web/uploads/user/photo',
		//path relative web folder to store the cache images
		'cachePath' => 'assets/images',
		//use filename (seo friendly) for resized images else use a hash
		'useFilename' => true,
		//show full url (for example in case of a API)
		'absoluteUrl' => false,
		'databaseComponent' => 'db' // The used database component by the image manager, this defaults to the Yii::$app->db component
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
