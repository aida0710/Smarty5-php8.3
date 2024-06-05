<?php

require_once 'vendor/autoload.php';
require_once 'config.php';

use src\Router;

session_start();

$router = new Router();
try {
    $router->route($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
} catch (Exception $e) {
    error_log($e->getMessage());
}