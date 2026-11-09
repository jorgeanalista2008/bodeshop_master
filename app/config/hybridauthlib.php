<?php
defined('BASEPATH') or exit('No direct script access allowed');

/* ----------------------------------------------------------------------------
/* HybridAuth Guide: http://hybridauth.github.io/hybridauth/userguide.html
/* ------------------------------------------------------------------------- */

$config = [
    'Hauth_base_url' => 'social_auth/endpoint',

    'providers' => [
        'Google' => [
            'enabled' => true,
            'keys'    => [
                'id'     => '23738208734-beqjdo1l7i7if72mmjs65lrl7hu4qtib.apps.googleusercontent.com',
                'secret' => getenv('GOOGLE_CLIENT_SECRET') ?: 'PEGA_AQUI_TU_CLIENT_SECRET',
            ],
            'scope'   => 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email openid',
        ],

        'Facebook' => [
            'enabled' => false,
            'keys'    => ['id' => '', 'secret' => ''],
            'scope'   => 'email, public_profile, user_birthday',
        ],

        'Twitter' => [
            'enabled' => false,
            'keys'    => ['key' => '', 'secret' => ''],
        ],

        'Yahoo' => [
            'enabled' => false,
            'keys'    => ['id' => '', 'secret' => ''],
        ],

        'Live' => [
            'enabled' => false,
            'keys'    => ['id' => '', 'secret' => ''],
        ],

        'MySpace' => [
            'enabled' => false,
            'keys'    => ['key' => '', 'secret' => ''],
        ],

        'OpenID' => [
            'enabled' => false,
        ],

        'LinkedIn' => [
            'enabled' => false,
            'keys'    => ['key' => '', 'secret' => ''],
        ],

        'Foursquare' => [
            'enabled' => false,
            'keys'    => ['id' => '', 'secret' => ''],
        ],

        'AOL' => [
            'enabled' => false,
        ],
    ],

    'debug_mode' => false,

    'debug_file' => APPPATH . 'logs/hybridauth.php',
];
