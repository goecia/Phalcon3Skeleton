<?php

namespace App\Middlewares;

use Phalcon\Mvc\Micro;
use Phalcon\Events\Event;
use Phalcon\Mvc\Micro\MiddlewareInterface;
use App\Exceptions\Usr\NotFoundException;

class NotFoundMiddleware implements MiddlewareInterface
{
    /**
     * Middleware call.
     *
     * @param Phalcon\Mvc\Micro
     * @return bool
     */
    public function call(Micro $app): bool
    {
        return true;
    }

    /**
     * Given route was not found.
     *
     * @param \use Phalcon\Events\Event
     * @param \use Phalcon\Mvc\Micro
     * @return void
     */
    public function beforeNotFound(Event $event, Micro $micro)
    {
        throw new NotFoundException();
    }
}
