<?php

return [
    'database' => [
        'connections' => [
            'mongo' => [
                'host' => '127.0.0.1',
                'username' => 'root',
                'password' => null,
                'dbname' => 'something'
            ],
            'cassandra' => [
                'adapter' => 'Cassandra',
                'hosts' => [
                    '192.168.0.1',
                    '192.168.1.1'
                ],
                'keyspace' => 'something',
                'consistency' => 'ALL',
                'retryPolicies' => 'DefaultPolicy'
            ]
        ]
    ]
];
