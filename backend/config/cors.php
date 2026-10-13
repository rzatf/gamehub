<?php

return [

    'paths' => ['api/*', 'up'],

    'allowed_methods' => ['*'],

    // The Game Hub API is a public, read-only catalogue: any origin may read it.
    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 3600,

    'supports_credentials' => false,

];
