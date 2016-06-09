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
 * This is the status page routes class.
 */
class ForumRoutes
{
    /**
     * Define the status page routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     *
     * @return void
     */
    public function map(Registrar $router)
    {
        $router->group(['middleware' => ['web', 'ready']], function (Registrar $router) {
            $router->get('/', [
                'as'   => 'home',
                'uses' => 'HomeController@index',
            ]);

            $router->get('/excellent', [
                'as'   => 'excellent',
                'uses' => 'HomeController@excellent',
            ]);

            $router->get('/feed', [
                'as'   => 'feed',
                'uses' => 'HomeController@feed',
            ]);

            $router->get('/captcha', [
                'as'    => 'captcha',
                'uses'  => 'CaptchaController@index',
            ]);

            $router->get('/go/{slug}', [
                'as'   => 'go',
                'uses' => 'NodeController@showBySlug',
            ]);

             //通知中心
            $router->get('/notification', [
                'as'     => 'notification.index',
                'uses'   => 'NotificationController@index',
            ]);

            $router->resource('node', 'NodeController');
            $router->resource('thread', 'ThreadController');
            $router->resource('reply', 'ReplyController', ['only' => ['store']]);
        });
    }
}
