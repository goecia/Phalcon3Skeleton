<?php

namespace App\Exceptions;

class Exception extends \Exception
{
    protected $status = 500;

    public function getStatus()
    {
        return $this->status;
    }
}
