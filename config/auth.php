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

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'buyers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Buyer::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
