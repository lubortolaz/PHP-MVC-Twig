<?php

use App\Core\Router;

// constant containing the root folder of the project
define('ROOT', dirname(__DIR__));

// require the configuration parameters
require_once ROOT.'/config/config.php';

// importing the autoloader
require_once ROOT.'/vendor/autoload.php';

// instantiate the router
$app = new Router();

// start the application
$app->start();