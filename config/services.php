<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'github' => [
        'client_id' => '8234b1fa8a00ed4888a6',
        'client_secret' => '04ba7b5ebb7ac54d7b63d722d090b1ac55c60847',
        'redirect' => 'http://localhost:8888/auth/github/callback',
    ],

    'facebook' => [
        'client_id' => '602752246555102',
        'client_secret' => 'ebec34c4eddf4496782e8e3a52ebe900',
        'redirect' => 'http://localhost:8888/auth/facebook/callback',
    ],

    'twitter' => [
        'client_id' => 'f3AqslycJZQU7giEgomr4Fy8R',
        'client_secret' => 'pB4VI39c92QRmIpVWpW6YCZbLW9DmcLATIrnT8bpmGNnykSM0z',
        'redirect' => 'http://localhost:8888/auth/twitter/callback',
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
        'model' => Bolt\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

];
