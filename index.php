<?php

use lib\Init;

if (strpos($_SERVER['REQUEST_URI'], '.')) {
    exit;
}

if (strlen($_SERVER['REQUEST_URI']) > 1 && $_SERVER['REQUEST_URI'][strlen($_SERVER['REQUEST_URI']) - 1] == '/') {
    header('location: ' . substr($_SERVER['REQUEST_URI'], 0, strlen($_SERVER['REQUEST_URI']) - 1));

    exit;
}

function autoload($classname) {
    $filepath = str_replace('\\', '/', $classname) . '.php';

    if (is_file($filepath)) {
        include $filepath;
    }
}

spl_autoload_register('autoload');

$controller = 'index';

$action = 'index';

$params = [];

if (isset($_SERVER['PATH_INFO'])) {
    $params = explode('/', $_SERVER['PATH_INFO']);

    unset($params[0]);

    if ($params[1] && class_exists('controllers\\' . $params[1])) {
        $controller = $params[1];

        unset($params[1]);
    }

    if (isset($params[2]) && method_exists('controllers\\' . $controller, $params[2])) {
        $action = $params[2];

        unset($params[2]);
    }
}

Init::init();

call_user_func_array("controllers\\$controller::$action", $params);
