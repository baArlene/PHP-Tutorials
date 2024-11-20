<?php


session_start();
const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . '/vendor/autoload.php';

require BASE_PATH . 'core/functions.php';

require base_path("bootstrap.php");

$router = new \core\Router();

$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (\core\ValidationException $exception) {
    \core\Session::flash('errors', $exception->errors);
    \core\Session::flash('old', $exception->old);

    return redirect($router->previousUrl());
}


\core\Session::unflash();


