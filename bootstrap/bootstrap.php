<?php

use Phalcon\Mvc\Micro;

// Create Micro app instance.
$app = new Micro();

// Get constants file.
require_once __DIR__ . '/constants.php';

// Get vendor libraries.
require_once BASE . '/vendor/autoload.php';

// Get all configs.
$config = require_once BASE . '/bootstrap/config.php';

// Set error reporting.
ini_set('display_errors', ENVIRONMENT === 'test' ? true : false);
error_reporting(ENVIRONMENT === 'test' ? E_ALL : 0);

// Register loader.
require_once BASE . '/bootstrap/loader.php';

// Get helpers.
require_once BASE . '/bootstrap/helpers.php';

// Get dependencies.
require_once BASE . '/bootstrap/dependencies.php';

// Get middlewares.
require_once BASE . '/bootstrap/middlewares.php';

// Load routes
require_once BASE . '/bootstrap/routes.php';

return $app;
