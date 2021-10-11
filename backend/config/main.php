<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);
$modules= require __DIR__ . '/modules.php';
return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' =>$modules,
    'components' => [
         'formatter' => [
            'currencyCode' => 'IDR',
            'decimalSeparator' => ',',
            'locale' => 'id',
            'thousandSeparator' => '.',
        ],
        'assetManager' => [
			'linkAssets'=>false      
		],
        
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
             'class' => 'yii\web\DbSession',
            // this is the name of the session cookie used for login on the backend
    //        'name' => 'advanced-backend',
        ],
         'cache' => [
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
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
     
    ],
    'as access' => 
            [
           'class' => \yii\filters\AccessControl::className(),
                'rules' =>  [
                                [
                                     'actions' => ['login', 'error'],
                                     'allow' => true,
                                ],
                                [
                                    'allow' => true,
                                    'roles' => ['@'],
                                ],
                            ],
            ],
    'params' => $params,
];
