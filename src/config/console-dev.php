<?php

// Settings for console-dev-application only
return [
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\faker\FixtureController',
            'templatePath' => '@tests/_templates/fixtures',
            'fixtureDataPath' => '@tests/_data/fixtures',
        ],
    ],
];
