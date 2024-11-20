<?php


require __DIR__ . '/../vendor/autoload.php';

$names = new \Illuminate\Support\Collection([
    1,2,3,4,5,6,7,8,9,11,13
]);

$lessThanOrEqualTo5 = $names->filter(function ($name) {
    return $name <= 5;
});

var_dump($lessThanOrEqualTo5);