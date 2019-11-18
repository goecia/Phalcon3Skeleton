<?php

try {
    // Load app throught bootstrap.
    $app = require __DIR__ . '/../bootstrap/bootstrap.php';
    // Run app.
    $app->handle();
} catch (\Exception $e) {
    // On exception catch, format response.
    $response = $app->standardization->formatResponse(['response' => null, 'error' => $e]);
    // Log error.
    $app->logger->error($e->getMessage());

    // Return parsed response.
    $app->response->setJsonContent($response);
    $app->response->send();
}
