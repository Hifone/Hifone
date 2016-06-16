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
    //'default_namespace' => 'App\Widgets',

    'use_jquery_for_ajax_calls' => false,

    /*
    * Set Ajax widget middleware
    */
    'route_middleware' => [],

    /*
    * Relative path from the base directory to a regular widget stub.
    */
    'widget_stub'  => 'vendor/arrilot/laravel-widgets/src/Console/stubs/widget.stub',

    /*
    * Relative path from the base directory to a plain widget stub.
    */
    'widget_plain_stub'  => 'vendor/arrilot/laravel-widgets/src/Console/stubs/widget_plain.stub',
];
