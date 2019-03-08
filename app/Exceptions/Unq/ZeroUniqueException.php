<?php

namespace App\Exceptions\Unq;

use App\Exceptions\Exception;

class ZeroUniqueException extends Exception
{
    protected $message = "Unexpected error.";
    protected $status = 400;
    protected $code = 0;
}