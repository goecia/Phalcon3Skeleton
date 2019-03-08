<?php

namespace App\Dependencies;

use App\Exceptions\Usr\MissingParametersException;
use App\Exceptions\Usr\InvalidEmailException;

class Validations
{
    /**
     * Validate obligatory, listed params on request.
     *
     * @param array $data
     * @var $data[authpn] requiered
     * @var $data[authpt] requiered
     * @var $data[device_category] requiered
     * @var $data[device_manufacturer] requiered
     * @var $data[device_model] requiered
     * @var $data[device_type] requiered
     * @var $data[region] requiered
     * @var $data[api_version] requiered
     * @var $data[format] requiered
     * @return void
     */
    public function requestParams($params)
    {
        $message = "Missing parameters: ";
        $missingParams = "";
        $validate = [
            "authpn",
            "authpt",
            "region",
        ];

        foreach ($validate as $k => $v) {
            if (!array_key_exists($v, $params) || empty($params[$v])) {
                $missingParams .= $v . ", ";
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
    public function obligatoryParams($obligatoryParams)
    {
        $message = "Missing parameters: ";
        $missingParams = "";

        foreach ($obligatoryParams as $k => $v) {
            if (is_null($v) || $v !== '0' && empty($v)) {
                $missingParams .= $k . ", ";
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
    public function validEmail($email)
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
    public function validStringLetters($string)
    {
        if (preg_match("/[^A-Za-z ]+/", $string)) {
            throw new \Exception("No special characters allowed.", 1);
        }
    }

    /**
     * Validates string contains only numbers.
     * 
     * @param string
     * @return void
     */
    public function validStringNumbers($string)
    {
        if (preg_match('/[^0-9]+/', $string)) {
            throw new \Exception("Only numbers allowed.", 1);
        }
    }
}
