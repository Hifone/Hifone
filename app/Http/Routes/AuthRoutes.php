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
 * This is the auth routes class.
 */
class AuthRoutes
{
    /**
     * Define the auth routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     *
     * @return void
     */
    public function map(Registrar $router)
    {
        $router->group(['as' => 'auth.', 'middleware' => ['web', 'ready', 'localize'], 'prefix' => 'auth', 'namespace' => 'Auth'], function (Registrar $router) {
            $router->get('login', [
                'middleware' => 'guest',
                'as'         => 'login',
                'uses'       => 'AuthController@getLogin',
            ]);

            $router->post('login', [
                'middleware' => ['guest'],
                'uses'       => 'AuthController@postLogin',
            ]);

            $router->get('logout', [
                'as'         => 'logout',
                'uses'       => 'AuthController@getLogout',
                'middleware' => 'auth',
            ]);

            $router->get('register', [
                'middleware' => 'guest',
                'as'         => 'register',
                'uses'       => 'AuthController@getRegister',
            ]);
            $router->post('register', [
                'middleware' => ['guest'],
                'uses'       => 'AuthController@postRegister',
            ]);

            $router->get('user-banned', 'AuthController@userBanned');

            $router->get('landing', [
                'middleware' => 'guest',
                'as'         => 'landing',
                'uses'       => 'AuthController@landing',
            ]);
            $router->get('{provider}', 'AuthController@provider');
            $router->get('{provider}/callback', 'AuthController@callback');
        });
    }
}
