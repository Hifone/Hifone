<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

/**
 * This is the api routes class.
 */
class ApiRoutes
{
    /**
     * Define the api routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Registrar $router)
    {
        $router->group([
            'namespace'  => 'Api',
            'prefix'     => 'api/v1',
            'middleware' => ['api'],
        ], function ($router) {
            // Authorization Optional
            $router->group(['middleware' => 'auth.api'], function ($router) {
                // General
                $router->get('ping', 'GeneralController@ping');
                $router->get('threads', 'ThreadController@getThreads');
            });

            // Authorization Required
            $router->group(['middleware' => 'auth.api:true'], function ($router) {
                // Do someting
            });
        });
    }
}
