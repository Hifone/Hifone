<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

    'mandrill' => [
        'secret' => env('MAIL_SECRET'),
    ],
    'qq' => [
        'client_id'     => env('QQ_KEY'),
        'client_secret' => env('QQ_SECRET'),
        'redirect'      => env('QQ_REDIRECT_URI'),
    ],
    'weixin' => [
        'client_id'     => env('WEIXIN_KEY'),
        'client_secret' => env('WEIXIN_SECRET'),
        'redirect'      => env('WEIXIN_REDIRECT_URI'),
    ],
    'weibo' => [
        'client_id'     => env('WEIBO_KEY'),
        'client_secret' => env('WEIBO_SECRET'),
        'redirect'      => env('WEIBO_REDIRECT_URI'),
    ],
    'gitlab' => [
        'client_id'     => env('GITLAB_KEY'),
        'client_secret' => env('GITLAB_SECRET'),
        'redirect'      => env('GITLAB_REDIRECT_URI'),
    ],
    'github' => [
        'client_id'     => env('GITHUB_KEY'),
        'client_secret' => env('GITHUB_SECRET'),
        'redirect'      => env('GITHUB_REDIRECT_URI'),
    ],
    'google' => [
        'client_id'     => env('GOOGLE_KEY'),
        'client_secret' => env('GOOGLE_SECRET'),
        'redirect'      => env('GOOGLE_REDIRECT_URI'),
    ],
];
