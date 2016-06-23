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
                'middleware' => ['permission:manage_threads'],
                'uses'       => 'ThreadController@sink',
            ]);
             //推荐
            $router->post('thread/{thread}/recommend', [
                'as'         => 'thread.recommend',
                'middleware' => ['permission:manage_threads'],
                'uses'       => 'ThreadController@recommend',
            ]);
            //置顶
            $router->post('thread/{thread}/pin', [
                'as'         => 'thread.pin',
                'middleware' => ['permission:manage_threads'],
                'uses'       => 'ThreadController@pin',
            ]);
            //删除
            $router->delete('thread/{thread}/delete', [
                'as'         => 'thread.destroy',
                'middleware' => ['permission:manage_threads'],
                'uses'       => 'ThreadController@destroy',
            ]);

            $router->resource('like', 'LikeController');

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
                'middleware' => ['permission:manage_users'],
                'uses'       => 'UserController@blocking',
            ]);
        });
    }
}
