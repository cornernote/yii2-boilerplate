<?php

// Basic configuration, used in web and console applications
return [
    'id' => $_ENV['APP_ID'],
    'version' => $_ENV['APP_VERSION'],
    'name' => $_ENV['APP_NAME'],
    'timeZone' => $_ENV['APP_TIMEZONE'],
    'language' => 'en',
    'basePath' => dirname(__DIR__),
    'vendorPath' => '@app/../vendor',
    'runtimePath' => '@app/../runtime',
    // Bootstrapped modules are loaded in every request
    'bootstrap' => [
        'log',
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        'root' => '@app/..',
        'data' => '@app/data',
        'tests' => '@root/tests',
        'docs' => '@app/modules/docs',
    ],
    'params' => [
        'adminEmail' => $_ENV['APP_ADMIN_EMAIL'],
        'supportEmail' => $_ENV['APP_SUPPORT_EMAIL'],
    ],
    'components' => [
        'assetManager' => [
            'forceCopy' => false, // Note: May degrade performance with Docker or VMs
            'linkAssets' => true, // YII_ENV_PROD ? false : true, // Note: May also publish files, which are excluded in an asset bundle
            'appendTimestamp' => false, // YII_ENV_PROD ? true : false, // causes problems with load-balanced servers
            'hashCallback' => function ($path) {
                return sprintf('%x', crc32((is_file($path) ? dirname($path) : $path)));
            },
        ],
        'authManager' => [
            'class' => 'Da\User\Component\AuthDbManagerComponent',
            'cache' => 'cache',
            //'defaultRoles' => ['guest'],
        ],
        'cache' => [
            //'class' => 'yii\caching\DummyCache',
            'class' => 'yii\redis\Cache',
            'keyPrefix' => 'cache.',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => $_ENV['DB_DSN'],
            'username' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'charset' => 'utf8',
            'tablePrefix' => $_ENV['DB_TABLE_PREFIX'],
            'enableSchemaCache' => $_ENV['YII_DEBUG'] ? false : true,
            //'enableQueryCache' => true,
            //'queryCache' => 'cacheModel',
            'enableLogging' => $_ENV['YII_DEBUG'] ? true : false,
            'enableProfiling' => $_ENV['YII_DEBUG'] ? true : false,
        ],
        'formatter' => [
            'locale' => $_ENV['APP_LOCALE'],
            'timeZone' => $_ENV['APP_TIMEZONE'],
            'dateFormat' => 'php:d-m-Y',
            'datetimeFormat' => 'php:d-m-Y g:i A',
            'timeFormat' => 'php:g:i A',
            'nullDisplay' => '',
        ],
        'formatterUtc' => [
            'class' => 'yii\i18n\Formatter',
            'timeZone' => 'UTC',
            'dateFormat' => 'php:d-m-Y',
            'datetimeFormat' => 'php:d-m-Y g:i A',
            'timeFormat' => 'php:g:i A',
            'nullDisplay' => '',
        ],
        'log' => [
            'targets' => [
                // writes to php-fpm output stream
                [
                    'class' => 'codemix\streamlog\Target',
                    'url' => 'php://stdout',
                    'levels' => ['info', 'trace'],
                    'logVars' => [],
                    'enabled' => YII_DEBUG,
                ],
                [
                    'class' => 'codemix\streamlog\Target',
                    'url' => 'php://stderr',
                    'levels' => ['error', 'warning'],
                    'logVars' => [],
                    'except' => [
                        'yii\web\HttpException:404',
                    ],
                ],
                // writes audit logs to queue, when disabled Audit module automatically populates this
                //'audit' => [
                //    'class' => 'app\components\AuditLogTarget',
                //],
            ],
        ],
//        'mailer' => [
//            'class' => 'yii\swiftmailer\Mailer',
//            'useFileTransport' => YII_ENV_PROD ? false : true,
//            'transport' => [
//                'class' => 'Swift_SmtpTransport',
//                'host' => $_ENV['SMTP_HOST'],
//                'username' => $_ENV['SMTP_USER'],
//                'password' => $_ENV['SMTP_PASS'],
//                'port' => (int)$_ENV['SMTP_PORT'],
//                'encryption' => $_ENV['SMTP_ENCRYPTION'],
//            ],
//        ],
//        'queue' => [
//            'class' => 'app\queues\QueueGearman',
//            'host' => $_ENV['GEARMAN_HOST'] ?: '127.0.0.1',
//            'port' => (int)$_ENV['GEARMAN_PORT'] ?: 4730,
//            'channel' => 'queue',
//            'timeLimit' => 60 * 60 * 4,
//        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => $_ENV['REDIS_HOST'] ?: '127.0.0.1',
            'port' => (int)$_ENV['REDIS_PORT'] ?: 6379,
            'useSSL' => (bool)$_ENV['REDIS_SSL'] ?: null,
            'password' => $_ENV['REDIS_PASSWORD'] ?: null,
        ],
//        's3' => [
//            'class' => 'frostealth\yii2\aws\s3\Storage',
//            'credentials' => [
//                'key' => $_ENV['S3_KEY'],
//                'secret' => $_ENV['S3_SECRET'],
//            ],
//            'region' => 'ap-southeast-2',
//            'bucket' => $_ENV['S3_BUCKET'],
//            'cdnHostname' => 'https://' . $_ENV['S3_BUCKET'],
//            'defaultAcl' => 'public-read',
//            //'debug' => true,
//        ],
//        'settings' => [
//            'class' => 'pheme\settings\components\Settings',
//        ],
        'user' => [
            'class' => 'app\components\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/user/security/login'],
            'identityClass' => 'app\models\User',
            'rootUsers' => ['admin'],
            'identityCookie' => [
                'httpOnly' => true,
                'name' => '_identity',
                'path' => '/',
                'domain' => $_ENV['APP_COOKIE_DOMAIN'] ?: null,
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => $_ENV['APP_PRETTY_URLS'] ? true : false,
            'showScriptName' => $_ENV['YII_ENV'] == 'test',
            //'enableDefaultLanguageUrlCode' => true,
            //'baseUrl' => $_ENV['APP_BASE_URL'] ?: '/',
            'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
                // use temporary redirection instead of permanent for debugging
                'action' => \yii\web\UrlNormalizer::ACTION_REDIRECT_TEMPORARY,
            ],
        ],
    ],
    'modules' => [
        'audit' => [
            //'class' => 'app\components\audit\Audit', // cannot be extended due to Audit::getInstance()
            'db' => 'dbAudit',
            'ignoreActions' => ['audit/*', 'debug/*', 'audit-alert/*'],

            'class' => 'bedezign\yii2\audit\Audit',
            'accessRoles' => ['admin'],
            'userIdentifierCallback' => ['app\models\User', 'userIdentifierCallback'],
            'logConfig' => [
                'levels' => [
                    'error',
                    'warning',
                ],
            ],
            // panels config
            /** @see QueueTrait::finalizeTask() */
            'panels' => [
                'audit/error',
                'audit/javascript',
                'audit/request' => [
                    'ignoreKeys' => ['SERVER'],
                ],
                'audit/trail',
                'audit/mail',
                //'queue' => [
                //    'class' => 'app\components\audit\panels\QueuePanel',
                //],
                //'task' => [
                //    'class' => 'app\components\audit\panels\TaskPanel',
                //],
            ],
        ],
        // in both web and console so we can use command line tools of Da\User like change password/create password
        'user' => [
            'class' => 'Da\User\Module',
            #'layout' => 'SEE_DEPENDENCY_INJECTION',
            'defaultRoute' => 'admin',
            'administratorPermissionName' => 'user-module',
            'administrators' => ['admin'],
            'enableRegistration' => false,
            'enableEmailConfirmation' => false,
            //'enableFlashMessages' => false,
            'switchIdentitySessionKey' => $_ENV['APP_SWITCH_IDENTITY_SESSION_KEY'],
            'mailParams' => [
                'fromEmail' => $_ENV['APP_ADMIN_EMAIL'],
            ],
        ],
    ],
];
