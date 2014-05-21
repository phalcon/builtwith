<?php

$di->set('router', function() {
    $router = new \Phalcon\Mvc\Router();
    $router->removeExtraSlashes(true);
    $router->setDefaults([
        'controller' => 'index',
        'action' => 'index'
    ]);
    /*$router->notFound([
        'controller'    => 'errors',
        'action'        => 'pageNotFound'
    ]);*/

    $router->addPost('/filter', [
        'action' => 'filter'
    ])->beforeMatch(function($uri, $route) {
        return ((isset($_SERVER['HTTP_X_REQUESTED_WITH'])) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));
    });
    return $router;
});