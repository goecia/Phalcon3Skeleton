<?php

use Phalcon\Mvc\Micro\Collection;
use App\Controllers\IndexController;

// IndexController
$IndexController = new Collection();
$IndexController->setHandler(IndexController::class, true);
$IndexController->get('/v1/index', 'indexAction');
$app->mount($IndexController);
