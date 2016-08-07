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
        $router->group(['middleware' => ['web', 'ready', 'localize']], function (Registrar $router) {
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
                'as'         => 'notification.index',
                'middleware' => 'auth',
                'uses'       => 'NotificationController@index',
            ]);
            $router->post('/notification/clean', [
                'as'         => 'notification.clean',
                'middleware' => 'auth',
                'uses'       => 'NotificationController@clean',
            ]);

            //积分
             $router->get('/credit', [
                'as'         => 'credit.index',
                'middleware' => 'auth',
                'uses'       => 'CreditController@index',
            ]);

            //PMS
             $router->get('/pm', [
                 'as'         => 'pm.index',
                 'middleware' => 'auth',
                 'uses'       => 'PmController@index',
             ]);

            //New PMS
            $router->get('/messages', [
                'as'         => 'messages.index',
                'middleware' => 'auth',
                'uses'       => 'MessagesController@index',
            ]);
            $router->get('/messages/create', [
                'as'         => 'messages.create',
                'middleware' => 'auth',
                'uses'       => 'MessagesController@create',
            ]);
            $router->post('/messages', [
                'as'         => 'messages.store',
                'middleware' => 'auth',
                'uses'       => 'MessagesController@store',
            ]);
            $router->get('/messages/{id}', [
                'as'         => 'messages.show',
                'middleware' => 'auth',
                'uses'       => 'MessagesController@show',
            ]);
            $router->put('/messages/{id}', [
                'as'         => 'messages.update',
                'middleware' => 'auth',
                'uses'       => 'MessagesController@update',
            ]);

            //Sitemap Stuff
            $router->get('/sitemap/threads', [
                'as'         => 'sitemap.threads',
                'uses'       => 'SitemapController@showThreads',
            ]);
            $router->get('/sitemap/pages', [
                'as'         => 'sitemap.pages',
                'uses'       => 'SitemapController@showPages',
            ]);
            $router->get('/sitemap/users', [
                'as'         => 'sitemap.users',
                'uses'       => 'SitemapController@showUsers',
            ]);
            $router->get('/sitemap', [
                'as'         => 'sitemap.show',
                'uses'       => 'SitemapController@show',
            ]);

            $router->resource('node', 'NodeController');
            $router->resource('thread', 'ThreadController');
            $router->resource('pm', 'PmController');
            $router->resource('reply', 'ReplyController', ['only' => ['store']]);
            $router->resource('tag', 'TagController');
        });
    }
}
