<?php


use core\Database;

$container = new \core\Container();

$container->bind('core\Database', function () {
    $config = require base_path('config.php');

   return new Database($config['database']);
});

$db = $container->resolve('core\Database');

\core\App::setContainer($container);