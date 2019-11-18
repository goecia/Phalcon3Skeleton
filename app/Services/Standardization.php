<?php

namespace App\Services;

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
     * @return array
     */
    public function formatResponse($returnedValue): array
    {
        $response = [
            'success' => true,
            'status' => 200,
            'message' => 'OK',
            'response' => $returnedValue
        ];

        // Check for errors to parse.
        if (isset($returnedValue['error'])) {
            $this->formatError($response, $returnedValue['error']);
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
            $e = new \Exception('Unexpected error.', 0);
        }

        $response['success'] = false;
        $response['message'] = $this->app->response->getReasonPhrase();
        $response['error']['message'] = $e->getMessage();
        $response['error']['exception'] = base64_encode($e->getFile() . ': ' . $e->getLine());
        $response['error']['code'] = array_search($e->getCode(), $this->app->config->errors->toArray());
    }
}
