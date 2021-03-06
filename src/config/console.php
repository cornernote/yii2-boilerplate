<?php

// Settings for console-application only
return [
    'bootstrap' => [
        //'queue',
    ],
    'controllerNamespace' => 'app\commands',
    'components' => [
        'errorHandler' => [
            'class' => 'bedezign\yii2\audit\components\console\ErrorHandler',
        ],
        'request' => [
            'class' => 'app\components\console\Request',
            'hostInfo' => $_ENV['APP_HOST_INFO'] ?: 'https://localhost',
            'baseUrl' => $_ENV['APP_BASE_URL'] ?: '/',
        ],
        'urlManager' => [
            'hostInfo' => $_ENV['APP_HOST_INFO'] ?: 'https://localhost',
            'baseUrl' => $_ENV['APP_BASE_URL'] ?: '/',
        ],
    ],
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            //'templateFile' => '@app/migrations/_template.php',
            'migrationPath' => [
                '@app/migrations',
                '@yii/rbac/migrations',
                '@vendor/pheme/yii2-settings/migrations',
            ],
            'migrationNamespaces'=>[
                'bedezign\yii2\audit\migrations',
                'Da\User\Migration',
            ],
        ],

    ],
];
