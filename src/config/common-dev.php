<?php

// Settings for developer-mode only
return [
    'bootstrap' => [
        'gii',
    ],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'layout' => '@app/views/layouts/main',
            'allowedIPs' => ['*'],
        ],
    ],
];
