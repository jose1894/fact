<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

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
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '9fRwORR3FnWoOKVCtAHWK2vWzr2IQjQk',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
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
                      'skin' => 'skin-blue',
                  ],
              ],
          ],
          'i18n' => [
              'translations' => [
                  'app*' => [
                      'class' => 'yii\i18n\PhpMessageSource',
                      'basePath' => '@app/messages',
                      'sourceLanguage' => 'en-US',
                      'fileMap' => [
                          'app' => 'app.php',
                          'app/error' => 'error.php',
                      ],
                  ],
                  'empresa' => [
                      'class' => 'yii\i18n\PhpMessageSource',
                      'basePath' => '@app/messages',
                      'sourceLanguage' => 'en-US',
                      'fileMap' => [
                          'empresa' => 'empresa.php',
                      ],
                  ],
                  'sucursal' => [
                      'class' => 'yii\i18n\PhpMessageSource',
                      'basePath' => '@app/messages',
                      'sourceLanguage' => 'en-US',
                      'fileMap' => [
                        'sucursal' => 'sucursal.php',
                      ],
                  ],
                  'tipo_producto' => [
                      'class' => 'yii\i18n\PhpMessageSource',
                      'basePath' => '@app/messages',
                      'sourceLanguage' => 'en-US',
                      'fileMap' => [
                        'tipo_producto' => 'tipoProducto.php',
                      ],
                  ],
              ],
          ],
    ],
    'modules' =>[
      'gridview' =>  [
          'class' => '\kartik\grid\Module'
          // enter optional module parameters below - only if you need to
          // use your own export download action or custom translation
          // message source
          // 'downloadAction' => 'gridview/export/download',
          // 'i18n' => []
      ]
    ],
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
