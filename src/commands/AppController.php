<?php

namespace app\commands;

use mikehaertl\shellcommand\Command;
use yii\console\Controller;


/**
 * Task runner command for development.
 * @package console\controllers
 */
class AppController extends Controller
{

    public $defaultAction = 'version';

    /**
     * Displays application version from git describe and writes it to `version`
     */
    public function actionVersion()
    {
        echo "Application Version\n";
        $cmd = new Command("git describe --dirty --always");
        if ($cmd->execute()) {
            echo $cmd->getOutput();
            file_put_contents(\Yii::getAlias('@app/version'), $cmd->getOutput());
        } else {
            echo $cmd->getOutput();
            echo $cmd->getStdErr();
            echo $cmd->getError();
        }
        echo "\n";
    }

}
