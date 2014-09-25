<?php

use Phalcon\Loader;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader = new Loader();
$loader->registerDirs(
    array(
        $config->application->controllersDir,
        $config->application->modelsDir
    )
)->register();


/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
}, true);

/**
 * Setting up the view component
 */
$di->set('view', function () use ($config) {

    $view = new View();

    $view->setViewsDir($config->application->viewsDir);

    return $view;
}, true);

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

/**
 * Register configurations
 */
$di->set('config', function() use ($config) {
    return $config;
});

/**
 * Register router
 */
$di->set('router', function() {

    $router = new Router();
    $router->removeExtraSlashes(true);

    $router->setDefaults([
        'controller' => 'index',
        'action' => 'index'
    ]);

    /*$router->notFound([
        'controller'    => 'errors',
        'action'        => 'pageNotFound'
    ]);*/

    $router->addGet('/project/{profile:([a-zA-Z0-9-(.)]+)}', [
        'action' => 'profile',
        'project' => 1
    ]);

    $router->addPost('/filter', [
        'action' => 'filter'
    ])->beforeMatch(function($uri, $route) {
        return ((isset($_SERVER['HTTP_X_REQUESTED_WITH'])) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));
    });

    return $router;
});