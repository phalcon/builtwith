<?php

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
     * Read auto-loader
     */
    include ROOT_PATH . "/app/var/config/loader.php";


    /**
     * Read services
     */
    include ROOT_PATH . "/app/var/config/services.php";

    /**
     * Read routes
     */
    include ROOT_PATH . "/app/var/config/routes.php";
    
    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage();
}
