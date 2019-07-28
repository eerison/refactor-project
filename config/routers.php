<?php
use League\Route\RouteGroup;

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$strategy = new \League\Route\Strategy\ApplicationStrategy;
$strategy->setContainer($container);
$router   = new \League\Route\Router;
$router->setStrategy($strategy);

$router->group('/article', function (RouteGroup $route) {
    $route->map('GET', '/{id}', 'JournalMedia\Sample\Controller\ArticleController::getById');
    $route->map('GET', '/publication/{publication}', 'JournalMedia\Sample\Controller\ArticleController::getByPublication');
    $route->map('GET', '/tag/{tag}', 'JournalMedia\Sample\Controller\ArticleController::getByTag');
});

$response = $router->dispatch($request);


(new Zend\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);