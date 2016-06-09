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
class AjaxRoutes
{
    /**
     * Define the ajax routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     *
     * @return void
     */
    public function map(Registrar $router)
    {
        $router->group(['middleware' => ['web', 'ready', 'auth']], function (Registrar $router) {

            //下沉
            $router->post('thread/{thread}/sink', [
                'as'         => 'thread.sink',
                'middleware' => 'admin',
                'uses'       => 'ThreadController@sink',
            ]);
             //推荐
            $router->post('thread/{thread}/recomend', [
                'as'         => 'thread.recomend',
                'middleware' => 'admin',
                'uses'       => 'ThreadController@recomend',
            ]);
            //置顶
            $router->post('thread/{thread}/pin', [
                'as'         => 'thread.pin',
                'middleware' => 'admin',
                'uses'       => 'ThreadController@pin',
            ]);
            //删除
            $router->delete('thread/{thread}/delete', [
                'as'         => 'thread.destroy',
                'middleware' => 'admin',
                'uses'       => 'ThreadController@destroy',
            ]);

            //
            $router->post('/thread/{thread}/like', [
                'as'   => 'thread.like',
                'uses' => 'ThreadController@like',
            ]);

            $router->post('/thread/{thread}/unlike', [
                'as'   => 'thread.unlike',
                'uses' => 'ThreadController@unlike',
            ]);

            $router->post('/reply/{reply}/like', [
                'as'   => 'reply.like',
                'uses' => 'ReplyController@like',
            ]);

            $router->post('/thread/{thread}/append', [
                'as'   => 'thread.append',
                'uses' => 'ThreadController@append',
            ]);

            $router->post('/follow/{thread}', [
                'as'     => 'follow.createOrDelete',
                'uses'   => 'FollowController@createOrDelete',
            ]);

            $router->post('/follow/user/{user}', [
                'as'     => 'follow.user',
                'uses'   => 'FollowController@createOrDeleteUser',
            ]);

            $router->delete('reply/{reply}/delete', [
                'as'     => 'reply.destroy',
                'uses'   => 'ReplyController@destroy',
            ]);

            $router->post('/favorite/{thread}', [
                'as'     => 'favorite.createOrDelete',
                'uses'   => 'FavoriteController@createOrDelete',
            ]);

            //获取通知数
            $router->get('/notification/count', [
                'as'     => 'notification.count',
                'uses'   => 'NotificationController@count',
            ]);

            $router->post('upload_image', [
                'as'     => 'upload_image',
                'uses'   => 'UploadController@uploadImage',
            ]);

            $router->post('user/{user}/blocking', [
                'as'         => 'user.blocking',
                'middleware' => 'admin',
                'uses'       => 'UserController@blocking',
            ]);
        });
    }
}
