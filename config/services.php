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
    
    'd4sign' => [
        'url'=>'https://secure.d4sign.com.br/api/', // Url para produção
        'accessToken'=>'live_c3595b6f29ce53ccabc3e2d63af4de2d33bad899fa1d76d0a2f050a44a03318a', // Chave API
        'default_safe'=>'4b2d825b-e7de-48e1-a772-700af5d3357d', // ID do Cofre para onde os documentos irão
        'default_document_name'=>'Contrato de Locação Residencial', // Nome padrão do documento
        'jsPath'=> '/js/d4sign.min.js' // Url que retorna o .js do d4sign
    ],

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
        'client_id' => '1894092310866426',
        'client_secret' => 'c8f61ccc69196c727a4541555fb5fdfc',
        'redirect' => 'https://www.imooby.com/facebook-handle'
        ],

];
