<?php

use Phalcon\Mvc\Application;

error_reporting(E_ALL);

try {

    /**
     * Define root path
     */
    define('ROOT_PATH', dirname(dirname(__FILE__)));

    /**
     * Read the configuration
     */
    $config = include ROOT_PATH . "/app/var/config/config.php";

    /**
     * Read bootstrap
     */
    include ROOT_PATH . "/app/var/config/bootstrap.php";

    /**
     * Handle the request
     */
    $application = new Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage();
}
