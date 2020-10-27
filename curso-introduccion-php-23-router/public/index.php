<?php

ini_set('display_errors', 1);
ini_set('display_starup_error', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Aura\Router\RouterContainer;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'cursophp',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();
// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

// https://github.com/auraphp/Aura.Router/blob/9167a38a8a9e9ec96667d939e3eaa4b2e7bd5333/docs/getting-started.md
//Nueva Ruta
$routeBase = '/CursoPlatziPHP/curso-introduccion-php-23-router';

$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();
// Concatenar la ruta con la condicion a evaluar
$map->get('index', $routeBase.'/', '../index.php');
$map->get('addJob', $routeBase.'/jobs/add', '../addJob.php');

$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);
if (!$route) {
    echo 'No route';
} else {
    require $route->handler;
}
