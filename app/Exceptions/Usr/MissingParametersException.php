<?php

namespace App\Exceptions\Usr;

use App\Exceptions\Exception;

class MissingParametersException extends Exception
{
    protected $message = "Missing Parameters:";
    protected $status = 422;
    protected $code = 1000000002;
}
