<?php

return [

    'routes' => [
        [
            'prefix' => '/service1',
            'method' => 'GET',
            'service_url' => 'https://api.restful-api.dev',
            'timeout' => 5000,
            'auth' => 'none',
            'filters' => [
                \App\Filters\DefaultFilter::class
            ]
        ],
        [
            'prefix' => '/service2',
            'method' => 'GET',
            'service_url' => 'https://catfact.ninja',
            'timeout' => 5000,
            'auth' => 'none',
        ],
    ],

];