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
    'facebook' => [
        'client_id' => '497458057273695',
        'client_secret' => '6b5725bdec148c0d048d96668d0a0be1',
        'redirect' => 'http://localhost:88/blog-bjs/facebook/callback',
    ],
    'google' => [
        'client_id' => '407044064102-qn870qiipivvoi2qufpmn434ubtd5h95.apps.googleusercontent.com',
        'client_secret' => 'PSuqqt1GDQ3pRQGpyACHOj81',
        'redirect' => 'http://localhost:88/blog-bjs/google/callback',
    ],

];
