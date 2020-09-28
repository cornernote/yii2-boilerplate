<?php

// Load application boostrap
require(__DIR__ . '/bootstrap.php');

// Load $merge configuration files
$applicationType = (empty($applicationType) && php_sapi_name() == 'cli') ? 'console' : 'web';
$env = YII_ENV;

return \yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/common.php'),
    require(__DIR__ . "/{$applicationType}.php"),
    (file_exists(__DIR__ . "/common-{$env}.php")) ? require(__DIR__ . "/common-{$env}.php") : [],
    (file_exists(__DIR__ . "/{$applicationType}-{$env}.php")) ? require(__DIR__ . "/{$applicationType}-{$env}.php") : [],
    (!empty($_ENV['APP_CONFIG_FILE']) && file_exists($_ENV['APP_CONFIG_FILE']) ? require($_ENV['APP_CONFIG_FILE']) : []),
);
