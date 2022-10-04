<?php

ini_set('display_error', 0);
error_reporting(E_ALL);
define('ROOT', dirname(__FILE__));
require_once(ROOT . '/helpers/Autoload.php');
$router = new Router();
$router->run();
