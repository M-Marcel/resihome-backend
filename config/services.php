<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),

        // 'key' => getenv('AWS_ACCESS_KEY_ID'),
        // 'secret' => getenv('AWS_SECRET_ACCESS_KEY'),
        // 'region' => getenv('AWS_DEFAULT_REGION', 'us-east-2'),
        // 'bucket' => getenv('AWS_BUCKET'),
    ],

    'passport' => [
        // 'login_endpoint' => getenv('PASSPORT_LOGIN_ENDPOINT'),
        // 'client_id' => getenv('CLIENT_ID'),
        // 'client_secret' => getenv('CLIENT_SECRET'),
        'login_endpoint' => env('PASSPORT_LOGIN_ENDPOINT'),
        'client_id' => env('PASSPORT_CLIENT_ID'),
        'client_secret' => env('PASSPORT_CLIENT_SECRET'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI'),
        // 'client_id' => getenv('GOOGLE_CLIENT_ID'),
        // 'client_secret' => getenv('GOOGLE_CLIENT_SECRET'),
        // 'redirect' => getenv('GOOGLE_REDIRECT_URI')
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('FACEBOOK_REDIRECT_URI')
        // 'client_id' => getenv('FACEBOOK_CLIENT_ID'),
        // 'client_secret' => getenv('FACEBOOK_CLIENT_SECRET'),
        // 'redirect' => getenv('FACEBOOK_REDIRECT_URI')
      ],

      'apple' => [
        'client_id' => env('APPLE_CLIENT_ID'),
        'client_secret' => env('APPLE_CLIENT_SECRET'),
        'redirect' => env('APPLE_REDIRECT_URI')
        // 'client_id' => getenv('APPLE_CLIENT_ID'),
        // 'client_secret' => getenv('APPLE_CLIENT_SECRET'),
        // 'redirect' => getenv('APPLE_REDIRECT_URI')
      ],

];
