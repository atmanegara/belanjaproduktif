<?php
use kartik\mpdf\Pdf;
return [
        'timeZone' => 'Asia/Makassar',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
                 'viewPath' => '@common/mail',
        //    'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
        //        'encryption' => 'tls',
                'host' => gethostbyname('admin@belanjaproduktif.com'),
                'port' => '465',
                'username' => 'admin@belanjaproduktif.com',
                'password' => '/admin@belanjaproduktif.com/',
                'encryption' => 'ssl',
                  'streamOptions' => [ 
             'ssl' => [ 
                'allow_self_signed' => true,
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ]
            ],             
        ],
        ///setting tetnang kami
        'tentangkami' => [
            'class' => 'common\component\TentangKamiComponent',
        ],
         'setting' => [
            'class' => 'common\component\SettingComponent',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'pdf' => [
        'class' => Pdf::classname(),
        'format' => Pdf::FORMAT_A4,
        'orientation' => Pdf::ORIENT_PORTRAIT,
        'destination' => Pdf::DEST_BROWSER,
        // refer settings section for all configuration options
    ],
        
        'request' => [
            'csrfParam' => '_csrf-backend-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
                'name' => 'A3kXhVWY2yDoJPWHJfdSdFKCc23Rm7',
        ],
    ],
];
