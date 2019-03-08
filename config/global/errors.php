<?php

return [
    "errors" => [
        // USR_UNQ: Unique exceptions (throw new Exception()).
        "USR_UNQ_00000" => 0, // Unexpected error
        "USR_UNQ_00001" => 1, // Unexpected error

        // USR_USR: General exception. No feature, vendor or client bound specific.
        "USR_USR_00000" => 1000000000, // User's not logged in
        "USR_USR_00001" => 1000000001, // Invalid email
        "USR_USR_00002" => 1000000002, // Missing parameter
        "USR_USR_00003" => 1000000003, // Not found

        // USR_JWT: Jason Web Token exception. Related to JWT management.
        "USR_JWT_00000" => 1100000000, // Invalid signature
        "USR_JWT_00001" => 1100000001, // Past due
    ]
];
