<?php

return [
    'supports_credentials' => false,
    'allowed_origins' => [
        'http://*.herokuapp.com',
    ],
    'allowed_origins_patterns' => [],
    'allowed_headers' => [
        'Content-Type',
        'X-Auth-Token',
        'Origin',
        'Authorization',
        'If-None-Match',
    ],
    'allowed_methods' => [
        'POST',
        'GET',
        'OPTIONS',
        'PUT',
        'PATCH',
        'DELETE',
    ],
    'exposed_headers' => [
        'Authorization'
    ],
    'max_age' => 600,
];
