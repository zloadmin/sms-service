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
        'client_id' => '183acd7de4db72ff4ff5',
        'client_secret' => 'e59491fbccf3a7672b9522426e6baeb952d3a9c8',
        'redirect' => 'http://sms-service1.ru/oauth/callback/github',
    ],

    'google' => [
        'client_id' => '894218435353-22kq4ru4svhp09imoe0p86fcufg8tnh4.apps.googleusercontent.com',
        'client_secret' => 'gTafqusH4vPi_TQ_heVpLMUH',
        'redirect' => 'http://sms-service1.ru/oauth/callback/google',
    ],
];
