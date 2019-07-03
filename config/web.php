<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$i18n = require __DIR__ . '/i18n.php';
use kartik\mpdf\Pdf;

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'es-ES',
    'sourceLanguage' => 'en-US',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'timeZone' => 'America/Lima',

    'components' => [
        'formatter' => [
             'thousandSeparator' => ',',
             'currencyCode' => 'S',
             'dateFormat' => 'dd/mm/yyyy',
             'decimalSeparator' => '.',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '9fRwORR3FnWoOKVCtAHWK2vWzr2IQjQk',
        ],
        // setup Krajee Pdf component
       'pdf' => [
           'class' => Pdf::classname(),
           'format' => Pdf::FORMAT_A4,
           'orientation' => Pdf::ORIENT_PORTRAIT,
           'destination' => Pdf::DEST_BROWSER,
           'mode' => Pdf::MODE_UTF8,
           // refer settings section for all configuration options
       ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            //'identityClass' => 'mdm\admin\models\User',
            'enableAutoLogin' => true,
            //'enableAutoLogin' => 'admin/user/login'
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
        'view' => [
             'theme' => [
                 'pathMap' => [
                    '@app/views' => '@app/views/yiisoft/yii2-app'
                 ],
             ],
        ],
        'assetManager' => [
              'bundles' => [
                  'dmstr\web\AdminLteAsset' => [
                      'skin' => 'skin-red',
                  ],

              ],
          ],
          'i18n' => $i18n,
          'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
          ]
    ],
    'modules' =>[
      'gridview' =>  [
          'class' => '\kartik\grid\Module'
          // enter optional module parameters below - only if you need to
          // use your own export download action or custom translation
          // message source
          // 'downloadAction' => 'gridview/export/download',
          // 'i18n' => []
      ],
      'admin' => [
            'class' => 'mdm\admin\Module',
            'mainLayout' => '@app/views/layouts/main.php',
            'layout' => 'left-menu',
            'menus' => [
                'assignment' => [
                    'label' => 'Grant Access' // change label
                ],
                'route' => null, // disable menu
            ],
      ]

    ],
    /*'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'admin/*',
            'some-controller/some-action',
            'gii/*'
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],*/

    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
