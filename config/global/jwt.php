<?php

return [
    'jwt' => [
        'issuedAt' => 0,
        'notBefore' => 0,
        "validate_nbf" => false,
        "validate_sig" => true,
        "usr_token_exp_time_lapse" => 3600 * 24 * 15,
        'secret' => 'secret'
    ]
];
