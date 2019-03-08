<?php

namespace App\Exceptions\Usr;

use App\Exceptions\Exception;

class NotLoggedInException extends Exception
{
    protected $message = "User's not logged in.";
    protected $status = 403;
    protected $code = 1000000000;
}