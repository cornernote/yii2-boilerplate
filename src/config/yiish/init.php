<?php

require(__DIR__ . '/../../config/debug.php');
require(__DIR__ . '/../../../vendor/autoload.php');
require(__DIR__ . '/../../config/env.php');

defined('YII_DEBUG') or define('YII_DEBUG', (boolean)$_ENV['YII_DEBUG']);
defined('YII_ENV') or define('YII_ENV', $_ENV['YII_ENV']);

require(__DIR__ . '/../../Yii.php');
require(__DIR__ . '/../../config/bootstrap.php');
$config = require(__DIR__ . '/../../config/main.php');
$application = new ConsoleApplication($config);

$version = Yii::getVersion();
echo <<<EOD
YiiSh Interactive Tool v2.0 (based on Yii v{$version})
Please type 'help' for help. Type 'exit' to quit.

EOD;
