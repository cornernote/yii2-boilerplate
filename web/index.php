<?php

require(__DIR__ . '/../src/config/debug.php');
require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../src/config/env.php');

defined('YII_DEBUG') or define('YII_DEBUG', (boolean)$_ENV['YII_DEBUG']);
defined('YII_ENV') or define('YII_ENV', $_ENV['YII_ENV']);

require(__DIR__ . '/../src/Yii.php');

$config = require(__DIR__ . '/../src/config/main.php');
$application = new WebApplication($config);
$application->run();
