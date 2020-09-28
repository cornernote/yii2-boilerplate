<?php

// Settings for web-application only
return [
    'bootstrap' => [
        'debug',
    ],
    'modules' => [
        'debug' => [
            'class' => 'yii\debug\Module',
            'allowedIPs' => ['*'],
            //'panels' => [
            //    'queue' => [
            //        'class' => 'yii\queue\debug\Panel',
            //    ]
            //],
        ],
    ],
];
