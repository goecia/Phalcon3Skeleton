<?php

namespace App\Exceptions\Usr;

use App\Exceptions\Exception;

class InvalidEmailException extends Exception
{
    protected $message = "Invalid mail format.";
    protected $status = 422;
    protected $code = 1000000001;
}