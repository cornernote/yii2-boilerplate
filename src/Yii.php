<?php

use yii\BaseYii;

/**
 * Yii bootstrap file.
 * Used for enhanced IDE code autocompletion.
 */
class Yii extends BaseYii
{
    /**
     * @var BaseApplication|WebApplication|ConsoleApplication the application instance
     */
    public static $app;
}

spl_autoload_register(['Yii', 'autoload'], true, true);
Yii::$classMap = include(__DIR__ . '/../vendor/yiisoft/yii2/classes.php');
Yii::$container = new yii\di\Container;

/**
 * Class BaseApplication
 * Used for properties that are identical for both WebApplication and ConsoleApplication
 *
 * @property \app\components\User $user
 * @property \yii\redis\Cache $cache
 * @property \yii\swiftmailer\Mailer $mailer
 * @property \yii\i18n\Formatter $formatterUtc
 * @property \yii\redis\Connection $redis
 * @property \pheme\settings\components\Settings $settings
 */
abstract class BaseApplication extends yii\base\Application
{
}

/**
 * Class WebApplication
 * Include only Web application related components here
 *
 * @property \bedezign\yii2\audit\components\web\ErrorHandler $errorHandler
 */
class WebApplication extends yii\web\Application
{
}

/**
 * Class ConsoleApplication
 * Include only Console application related components here
 *
 * @property \bedezign\yii2\audit\components\console\ErrorHandler $errorHandler
 */
class ConsoleApplication extends yii\console\Application
{
}
