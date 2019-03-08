<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Logger\Adapter\File;
use App\Dependencies\Profiler;
use App\Dependencies\Standardization;
use App\Dependencies\Validations;
use App\Dependencies\Jwt;
use GuzzleHttp\Client;
use \Cassandra as Cassandra;

// Create a DI.
$di = new FactoryDefault();

// Set config.
$di->set("config", function() use ($config) {
    return $config;
}, true);

// Set AmcoLogger service.
$di->setShared("logger" , function () use ($config) {
    return new File($config->app->logs_dir . ENVIRONMENT . ".log");
});

// Set Profiler service.
$di->set("profiler", function() use ($app) {
    return new Profiler(get_profile());
});

// Set Standardization service.
$di->set("standardization", function() use ($app) {
    return new Standardization($app);
}, true);

// Set Validations service.
$di->set("validations", function() {
    return new Validations();
}, true);

// Set lcobucci/jwt.
$di->set("jwt", function() use ($config) {
    return new Jwt($config->jwt);
}, true);

// Set cassandra.
$di->setShared("cassandra" , function() use ($config) {
    $cassandra = Cassandra::cluster()
            ->withContactPoints(...$config->database->connections->cassandra->hosts)
            ->build()
            ->connect($config->database->connections->cassandra->keyspace);

    return $cassandra;
});

// Set GuzzleHttp\Client.
$di->set("guzzle", function() use ($config) {
    return new Client([
            "timeout" => $config->app->guzzle_options->timeout,
            "debug" => get_profile()
        ]
    );
}, true);

// Inject dependencies.
$app->setDI($di);
