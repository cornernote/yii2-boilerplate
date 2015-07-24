<?php

$config = [
    'id' => getenv('APP_ID'),
    'name' => getenv('APP_NAME'),
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@admin' => '@app/modules/admin',
    ],
    'components' => [
        'assetManager' => [
            'forceCopy' => false, // Note: May degrade performance with Docker or VMs
            'linkAssets' => true, // Note: May also publish files, which are excluded in an asset bundle
            'dirMode' => YII_ENV_PROD ? 0777 : null, // Note: For using mounted volumes or shared folders
            'bundles' => YII_ENV_PROD ? require(__DIR__ . '/assets-prod.php') : null,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => getenv('DATABASE_DSN'),
            'username' => getenv('DATABASE_USER'),
            'password' => getenv('DATABASE_PASSWORD'),
            'charset' => 'utf8',
            'tablePrefix' => getenv('DATABASE_TABLE_PREFIX'),
        ],
        'formatter' => [
            'dateFormat' => 'php:d/m/Y',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            //'viewPath'         => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => YII_ENV_PROD ? false : true,
        ],
        'urlManager' => [
            'enablePrettyUrl' => getenv('APP_PRETTY_URLS') ? true : false,
            'showScriptName' => getenv('YII_ENV_TEST') ? true : false,
            'rules' => [
                '<controller:[\w\-]+>/<id:\d+>' => '<controller>/view',
                '<controller:[\w\-]+>/<action:[\w\-]+>/<id:\d+>' => '<controller>/<action>',
                '<controller:[\w\-]+>/<action:[\w\-]+>' => '<controller>/<action>',
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@vendor/dektrium/yii2-user/views' => '@app/views/user',
                    '@yii/gii/views/layouts' => '@admin/views/layouts',
                ],
            ],
        ],
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => '@admin/views/layouts/main',
        ],
        //'docs' => [
        //    'class' => \schmunk42\markdocs\Module::className(),
        //    'layout' => '@app/views/layouts/container',
        //],
        /*'packaii' => [
            'class'  => \schmunk42\packaii\Module::className(),
            'layout' => '@admin/views/layouts/main',
        ],*/
        'user' => [
            'class' => 'dektrium\user\Module',
            'defaultRoute' => 'profile',
            'admins' => ['admin'],
            'enableFlashMessages' => false,
            //'controllerMap' => [
            //    'security' => [
            //        'class' => 'dektrium\user\controllers\SecurityController',
            //        //'layout' => 'ace',
            //    ],
            //],
        ],
        'rbac' => [
            'class' => 'dektrium\rbac\Module',
            'enableFlashMessages' => false,
        ],
    ],
    'params' => [
        'adminEmail' => getenv('APP_ADMIN_EMAIL'),
        'supportEmail' => getenv('APP_SUPPORT_EMAIL'),
        'yii.migrations' => [
            '@bedezign/yii2/audit/migrations',
            '@dektrium/user/migrations',
            '@yii/rbac/migrations',
        ]
    ]

];


$web = [
    'components' => [
        'log' => [
            'traceLevel' => getenv('YII_TRACE_LEVEL'),
            'targets' => [
                // log route handled by nginx process
                [
                    'class' => 'dmstr\log\SyslogTarget',
                    'prefix' => function () {
                        return '';
                    },
                    'levels' => YII_DEBUG ? ['error', 'warning', 'info'] : ['error', 'warning'],
                    'logVars' => ['_GET', '_POST', '_FILES', '_COOKIE', '_SESSION'],
                    'enabled' => YII_DEBUG ? true : false,
                ],
                // standard file log route
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => YII_DEBUG ? ['error', 'warning', 'info'] : ['error', 'warning'],
                    'logVars' => ['_GET', '_POST', '_FILES', '_COOKIE', '_SESSION'],
                    'logFile' => '@app/runtime/logs/web.log',
                    'dirMode' => 0777
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => getenv('APP_COOKIE_VALIDATION_KEY'),
        ],
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
        ],
    ]
];


$console = [
    'controllerNamespace' => 'app\commands',
    'controllerMap' => [
        'migrate' => 'dmstr\console\controllers\MigrateController',
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'app\tests\codeception\fixtures',
        ],
        'faker' => [
            'class' => 'yii\faker\FixtureController',
            'namespace' => 'app\tests\codeception\fixtures',
            'templatePath' => '@app/tests/codeception/fixtures/templates',
            'fixtureDataPath' => '@app/tests/codeception/fixtures/data',
        ],
    ],
    'components' => [
        'log' => [
            'traceLevel' => getenv('YII_TRACE_LEVEL'),
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'prefix' => function () {
                        return '[console]';
                    },
                    'levels' => YII_DEBUG ? ['error', 'warning', 'info'] : ['error', 'warning'],
                    'logVars' => ['_GET', '_POST', '_FILES', '_COOKIE', '_SESSION'],
                    'logFile' => '@app/runtime/logs/console.log',
                    'dirMode' => 0777
                ],
            ],
        ],
    ]
];


$allowedIPs = [
    '127.0.0.1',
    '::1',
    '192.168.*',
    '172.17.*'
];

if (php_sapi_name() == 'cli') {
    // Console application
    $config = \yii\helpers\ArrayHelper::merge($config, $console);
} else {
    // Web application
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => YII_ENV_DEV ? $allowedIPs : array(),
    ];
    $config = \yii\helpers\ArrayHelper::merge($config, $web);
}

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => $allowedIPs,
        'generators' => [
            'giiant-model' => [
                'class' => 'schmunk42\giiant\model\Generator',
                'templates' => [
                    'gii-tools' => '@vendor/cornernote/yii2-gii/src/giiant/model/cornernote',
                ],
            ],
            'giiant-crud' => [
                'class' => 'schmunk42\giiant\crud\Generator',
                'templates' => [
                    'gii-tools' => '@vendor/cornernote/yii2-gii/src/giiant/crud/cornernote',
                ],
            ],
        ],
    ];
}

if (file_exists(__DIR__ . '/local.php')) {
    // Local configuration, if available
    $local = require(__DIR__ . '/local.php');
    $config = \yii\helpers\ArrayHelper::merge($config, $local);
}

return $config;
