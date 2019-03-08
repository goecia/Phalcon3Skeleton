<?php

use Phalcon\Events\Manager;
use App\Middlewares\NotFoundMiddleware;
use App\Middlewares\RequestMiddleware;
use App\Middlewares\ResponseMiddleware;

// Initialize Events manager
$eventsManager = new Manager();

$eventsManager->attach("micro", new NotFoundMiddleware());
$app->before(new NotFoundMiddleware());

$eventsManager->attach("micro", new RequestMiddleware());
$app->before(new RequestMiddleware());

$eventsManager->attach("micro", new ResponseMiddleware());
$app->after(new ResponseMiddleware());

// Inject middlewares.
$app->setEventsManager($eventsManager);
