<?php

// Settings for web-application only
return [
    'components' => [
        //'errorHandler' => [
        //    'class' => 'app\components\web\ErrorHandler',
        //    'errorAction' => 'error/index',
        //],
        'request' => [
            'cookieValidationKey' => $_ENV['APP_COOKIE_VALIDATION_KEY'],
            'csrfCookie' => [
                'httpOnly' => true,
                'name' => '_csrf',
                'path' => '/',
                'domain' => $_ENV['APP_COOKIE_DOMAIN'] ?: null,
            ],
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'session' => [
            'class' => 'yii\redis\Session',
            'keyPrefix' => 'session.',
            'cookieParams' => [
                'httpOnly' => true,
                'path' => '/',
                'domain' => $_ENV['APP_COOKIE_DOMAIN'] ?: null,
            ],
        ],
    ],
    'modules' => [
        //'settings' => [
        //    'class' => 'pheme\settings\Module',
        //    'layout' => '@app/views/layouts/box',
        //    'accessRoles' => ['settings-module'],
        //],
    ],
];
