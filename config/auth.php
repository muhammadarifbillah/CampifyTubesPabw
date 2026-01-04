<?php

return [

    'defaults' => [
        'guard' => 'api', // ⬅️ penting
        'passwords' => 'users',
    ],

    'guards' => [

        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'sanctum', // ⬅️ WAJIB
            'provider' => 'users',
        ],

        'buyer' => [
            'driver' => 'session',
            'provider' => 'buyers',
        ],
    ],


];
