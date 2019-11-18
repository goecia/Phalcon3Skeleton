<?php

namespace App\Services;

use Phalcon\Logger\Adapter\File;

class Logger extends File
{
    /**
     * @var bool
     */
    private $profile;

    /**
     * Class constructor (duh).
     * 
     * @param string
     * @param boolean
     * @return void
     */
    public function __construct(string $logDir, bool $profile)
    {
        parent::__construct($logDir);
        $this->profile = $profile;
    }

    /**
     * Prints on console, from called class, the target server, date, target file, class, method, line and/or data.
     * 
     * @param mixed
     * @return void
     */
    public function profile($data = null, $message = null)
    {
        if ($this->profile) {
            // Get a clean var_dump of data.
            ob_start();
            var_dump($data);
            $data = ob_get_contents();
            ob_end_clean();

            // Fill and print the message.
            echo PHP_EOL . "PROFILE DATA {$message}: " . PHP_EOL;
            print_r(
                 "SERVER: " . $_SERVER["SERVER_ADDR"] . PHP_EOL .
                 "DATE: " . date("D, d M y H.i:s O") . PHP_EOL .
                 "FILE: " . debug_backtrace()[0]['file'] . PHP_EOL .
                 "CLASS: " . debug_backtrace()[1]['class'] . PHP_EOL .
                 "METHOD: " . debug_backtrace()[1]['function'] . PHP_EOL .
                 "LINE: " . debug_backtrace()[0]['line'] . PHP_EOL .
                 "DATA :" . $data . PHP_EOL
            );
        }
    }
}