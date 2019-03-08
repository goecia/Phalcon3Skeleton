<?php

// Environment set up
empty($_SERVER['ENV']) ? define("ENVIRONMENT", "test") : define("ENVIRONMENT", $_SERVER['ENV']);
// Base directory .
define("BASE", dirname(__DIR__));
// Base app directory.
define("BASE_APP", BASE . "/app");
