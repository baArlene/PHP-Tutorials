<?php

use core\Response;

function dd($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';

    die();
}

function urlIs($value): bool
{
    return $_SERVER['REQUEST_URI'] === $value;
}


function authorize($condition, $status = Response::FORBIDDEN)
{
    if (!$condition) {
        abort($status);
    }
}

function base_path($path): string
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);  // Extracts variables to local scope
    require base_path('views/' . $path); // Will load  /views/index.php
}

function redirect($path) {
    header("location: $path");
    exit();
}

function old($key, $default = '')
{
       return \core\Session::get('old')[$key] ?? $default;
}