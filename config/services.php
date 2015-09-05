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
        'domain' => '',
        'secret' => '',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses' => [
        'key'    => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => '',
        'secret' => '',
    ],

    'github' => [
        'client_id' => env('SERVICES_GITHUB_CLIENT_ID', ''),
        'client_secret' => env('SERVICES_GITHUB_CLIENT_SECRET', ''),
        'redirect' => env('SERVICES_GITHUB_REDIRECT', ''),
    ],

    'google' => [
        'client_id' => env('SERVICES_GOOGLE_CLIENT_ID', ''),
        'client_secret' => env('SERVICES_GOOGLE_CLIENT_SECRET', ''),
        'redirect' => env('SERVICES_GOOGLE_REDIRECT', ''),
    ],

];
