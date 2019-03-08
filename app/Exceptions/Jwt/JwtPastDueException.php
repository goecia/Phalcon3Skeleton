<?php

namespace App\Exceptions\Jwt;

use App\Exceptions\Exception;

class JwtPastDueException extends Exception
{
    protected $message = "The submitted JWT is past due.";
    protected $status = 401;
    protected $code = 1100000001;
}