<?php

namespace App\Middlewares;

use Phalcon\Mvc\Micro;
use Phalcon\Events\Event;
use Phalcon\Mvc\Micro\MiddlewareInterface;

class ResponseMiddleware implements MiddlewareInterface
{
    /**
     * Middleware call.
     *
     * @param Phalcon\Mvc\Micro
     * @return void
     */
    public function call(Micro $app): bool
    {
        return true;
    }

    /**
     * After route-execution parses.
     * 
     * @param \use Phalcon\Events\Event
     * @param \use Phalcon\Mvc\Micro
     * @return void
     */
    public function afterExecuteRoute(Event $event, Micro $app)
    {
        $response = $app->standardization->formatResponse($app->getReturnedValue());

        $app->response->setJsonContent($response);
        $app->response->send();
    }
}
