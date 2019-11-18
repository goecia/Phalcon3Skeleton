<?php

namespace App\Services;

use App\Exceptions\Usr\MissingParametersException;
use App\Exceptions\Usr\InvalidEmailException;

class Validations
{
    /**
     * Validate obligatory, listed params on request.
     *
     * @param array $data
     * @var $data[foo] requiered
     * @var $data[bar] requiered
     * @return void
     */
    public static function requestParams(array $params)
    {
        $message = 'Missing parameters: ';
        $missingParams = '';
        $validate = [
            'foo',
            'bar'
        ];

        foreach ($validate as $k => $v) {
            if (!array_key_exists($v, $params) || empty($params[$v])) {
                $missingParams .= $v . ', ';
            }
        }

        if (!empty($missingParams)) {
            $missingParams = substr($missingParams, 0, -2);
            throw new MissingParametersException($message . $missingParams);
        }
    }

    /**
     * Validates given obligatory params are not empty or null.
     * Returns a concatenated string of missing parameters on exception.
     *
     * @param array
     * @return void
     */
    public static function obligatoryParams(array $obligatoryParams)
    {
        $message = 'Missing parameters: ';
        $missingParams = '';

        foreach ($obligatoryParams as $k => $v) {
            if (is_null($v) || $v !== '0' && empty($v)) {
                $missingParams .= $k . ', ';
            }
        }

        if (!empty($missingParams)) {
            $missingParams = substr($missingParams, 0, -2);
            throw new MissingParametersException($message . $missingParams);
        }
    }

    /**
     * Validates email format.
     * 
     * @param string
     * @return void
     */
    public static function validEmail(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            throw new InvalidEmailException();
        }
    }

    /**
     * Validates string contains only english letters.
     * 
     * @param string
     * @return void
     */
    public static function validStringLetters(string $string)
    {
        if (preg_match('/[^A-Za-z ]+/', $string)) {
            throw new \Exception('No special characters allowed.', 1);
        }
    }

    /**
     * Validates string contains only numbers.
     * 
     * @param string
     * @return void
     */
    public static function validStringNumbers(string $string)
    {
        if (preg_match('/[^0-9]+/', $string)) {
            throw new \Exception('Only numbers allowed.', 1);
        }
    }
}
