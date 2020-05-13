<?php

return [
    'supports_credentials' => false,
    'allowed_origins' => [
        'http://*.herokuapp.com',
    ],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'allowed_methods' => ['*'],
    'exposed_headers' => [
        'Authorization'
    ],
    'max_age' => 0,
];
