<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'github' => [
            'client_id' => 'your-github-app-id',
            'client_secret' => 'your-github-app-secret',
            'redirect' => 'http://your-callback-url',
        ],
    'facebook' => [
            'client_id' => '1707896929508771',
            'client_secret' => '37da61622032842e85b548247e424a47',
            'redirect' => 'http://localhost/auth/facebook/callback',
        ],
    'twitter' => [
            'client_id' => '6dumN1DgxyhQ7eFneAIJYxsUt',
            'client_secret' => 'g1TFs3Wd8Gu35fppVYbHxUFNdT1sMh7yT7aFnCfj1kKed5QScF',
            'redirect' => 'http://localhost/auth/twitter/callback',
        ],
    'google' => [
            'client_id' => 'your-github-app-id',
            'client_secret' => 'your-github-app-secret',
            'redirect' => 'http://your-callback-url',
        ],
];
