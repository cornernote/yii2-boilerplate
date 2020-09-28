<?php

// Basic configuration, used in web and console applications
return [
    'bootstrap' => [
        'gii',
    ],
    'modules' => [
        'audit' => [
            'logConfig' => [
                'levels' => [
                    'error',
                    'warning',
                    'trace',
                    'profile',
                    //'info',
                ],
            ],
        ],
        'gii' => [
            'class' => 'yii\gii\Module',
            'layout' => '@app/views/layouts/main',
            'allowedIPs' => ['*'],
        ],
    ],
];
