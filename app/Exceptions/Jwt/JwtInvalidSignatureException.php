<?php

namespace App\Exceptions\Jwt;

use App\Exceptions\Exception;

class JwtInvalidSignatureException extends Exception
{
    protected $message = "The submitted JWT has an invalid Signature.";
    protected $status = 401;
    protected $code = 1100000000;
}