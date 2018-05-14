<?php
/**
 * Created by PhpStorm.
 * User: reda-benchraa
 * Date: 06/03/18
 * Time: 21:34
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */
    'supportsCredentials' => false,
    'allowedOrigins' => ['*'],
    'allowedHeaders' => ['Content-Type', 'X-Requested-With', 'authorization', '*'],
    'allowedMethods' => ['GET', 'POST', 'PUT',  'DELETE', 'OPTION', '*'], // ex: ['GET', 'POST', 'PUT',  'DELETE']
    'exposedHeaders' => ['*'],
    'maxAge' => 0,
];