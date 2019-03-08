<?php

namespace App\Dependencies;

use Phalcon\Mvc\Micro;

class Standardization
{
    private $app;

    public function __construct(Micro $app)
    {
        $this->app = $app;
    }

    /**
     * Parses response into an AMCO standard format.
     * 
     * @param mixed
     * @param exception
     * 
     * @return void
     */
    public function formatResponse($returnedValue)
    {
        $response = [
            "entry" => get_request_params(),
            "status" => 200,
            "message" => "OK",
            "response" => $returnedValue
        ];

        // Check for errors to parse.
        if (isset($returnedValue['errors'])) {
            $this->formatError($response, $returnedValue['errors']);
        }

        return $response;
    }

    /**
     * Parses the given exception into an AMCO standard format error.
     * 
     * @param reference
     * @param exception
     * @return void
     */
    private function formatError(&$response, $e)
    {
        // Unset response node.
        unset($response['response']);

        // Check exception is part of custom AMCO exception.
        if ($e instanceof \App\Exceptions\Exception) {
            // Set app response status code.
            $this->app->response->setStatusCode($e->getStatus());
            // Set standard response status code.
            $response['status'] = $e->getStatus();
        // PHP Regular Exception (Bad Request)
        } elseif ($e instanceof \Exception) {
            // Set app response status code.
            $this->app->response->setStatusCode(400);
            // Set standard response status code.
            $response['status'] = 400;
        // No throw or uncatched exception. Create an unexpected error.
        } else {
            // Set app response status code.
            $this->app->response->setStatusCode(400);
            // Set standard response status code.
            $response['status'] = 400;
            // Throw an unexpected error.
            $e = new \Exception("Unexpected error.", 0);
        }

        $response['message'] = "error";
        $response['errors']['error']['message'] = $e->getMessage();
        $response['errors']['error']['exception'] = base64_encode($e->getFile() . ' ' . $e->getLine());
        $response['errors']['error']['code'] = array_search($e->getCode(), $this->app->config->errors->toArray());
    }
}
