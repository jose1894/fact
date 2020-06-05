<?php

$production = [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=fact',
    'username' => 'leophard',
    'password' => 'bJigtxXxFYN2S6lw',
    'charset' => 'utf8',
    //  'tablePrefix' => 'pre_'

    //Schema cache options (for production environment)
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 60,
    'schemaCache' => 'cache',
];

$development = [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=fact',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    //  'tablePrefix' => 'pre_'

    //Schema cache options (for production environment)
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 60,
    'schemaCache' => 'cache',
];

return YII_ENV_DEV ? $development : $development;
