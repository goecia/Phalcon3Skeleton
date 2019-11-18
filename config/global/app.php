<?php

return [
    'app' => [
        'debug' => true,
        'timezone' => 'UTC',
        'locale' => 'es',
        'fallbackLocale' => 'en',
        'controllers_dir' => BASE_APP . '/Controllers/',
        'models_dir' => BASE_APP . '/Models/',
        'services_dir' => BASE_APP . '/Services/',
        'exceptions_dir' => BASE_APP . '/Exceptions/',
        'middlewares_dir' => BASE_APP . '/Middlewares/',
        'repositories_dir' => BASE_APP . '/Repositories/',
        'logs_dir' => BASE . '/storage/logs/',
        'cache_dir' => BASE . '/storage/cache/',
        'guzzle_options' => [
            'timeout' => ENVIRONMENT == 'test' ? 15.0 : 3.0
        ]
    ]
];
