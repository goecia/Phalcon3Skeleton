<?php

namespace App\Exceptions\Usr;

use App\Exceptions\Exception;

class NotFoundException extends Exception
{
    protected $message = "Given route was not found or does not exist.";
    protected $status = 404;
    protected $code = 1000000003;
}
