<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Hifone\Models\Thread;
use Hifone\Models\User;

$factory->define(User::class, function ($faker) {
    return [
        'username'       => $faker->name,
        'email'          => $faker->email,
        'password'       => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Thread::class, function ($faker) {
    return [
        'user_id'      => 1,
        'title'        => $faker->text,
        'body'         => $faker->text,
        'node_id'      => 1,
    ];
});
