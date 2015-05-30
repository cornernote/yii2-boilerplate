<?php

/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{

    /**
     * Run a test php web server
     *
     * @param array $opts
     */
    public function server($opts = ['host' => '0.0.0.0', 'port' => '80', 'path' => 'web'])
    {
        $this->_exec('php -S ' . $opts['host'] . ':' . $opts['port'] . ' -t ' . $opts['path']);
    }

}