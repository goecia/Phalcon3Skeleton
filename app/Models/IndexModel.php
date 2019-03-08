<?php

namespace App\Models;

use Phalcon\Mvc\Model;

class IndexModel extends Model
{
    private $message = "Hello World!.";

    /**
     * Gets the message.
     *
     * @param string
     * @return void
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Sets the message.
     *
     * @param void
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}
