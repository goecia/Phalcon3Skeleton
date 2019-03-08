<?php

use Phalcon\Loader;

$loader = new Loader();

$loader->registerDirs(
    [
        $config->app->controllers_dir,
        $config->app->models_dir,
        $config->app->services_dir,
        $config->app->exceptions_dir,
        $config->app->middlewares_dir,
    ]
);

$loader->registerNamespaces(
    [
        "App" => BASE_APP,
        "App\\Controllers" => $config->app->controllers_dir,
        "App\\Models" => $config->app->models_dir,
        "App\\Services" => $config->app->services_dir,
        "App\\Exceptions" => $config->app->exceptions_dir,
        "App\\Middlewares" => $config->app->middlewares_dir,
        "App\\Repositories" => $config->app->repositories_dir,
    ]
);

$loader->register();
