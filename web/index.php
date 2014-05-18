<?php
require_once __DIR__ . "/../vendor/autoload.php";

use Aura\Router\RouterFactory;
$router_factory = new RouterFactory;
/** @var Aura\Router\ $router */
$router = $router_factory->newInstance();
$router->add(null, '/payroll/web/index.php/{controller}/{action}');



// get the incoming request URL path
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// get the route based on the path and server
$route = $router->match($path, $_SERVER);

if (isset($route->params['controller'])) {
    // take the  controller class directly from the route
    $controller = 'WebInterface\\Controllers\\'. $route->params['controller'];
} else {
    // use a default controller
    $controller = 'WebInterface\Controllers\IndexController';
}

// does the route indicate an action?
if (isset($route->params['action'])) {
    // take the action method directly from the route
    $action = $route->params['action'];
} else {
    // use a default action
    $action = 'index';
}

// instantiate the controller class
$page = new $controller();

// invoke the action method with the route values
echo $page->$action($route->params);


