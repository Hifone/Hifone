<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Http\Controllers;

use Hifone\Commands\Follow\AddFollowCommand;
use Hifone\Models\Thread;
use Hifone\Models\User;
use Redirect;
use Auth;

class FollowController extends Controller
{
    public function createOrDelete(Thread $thread)
    {
        dispatch(new AddFollowCommand($thread));

        return Redirect::route('thread.show', $thread->id)
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
    }

    public function createOrDeleteUser(User $user)
    {
        if($user->id == Auth::user()->id) {
            return Redirect::route('user.home', $user->username)
            ->withErrors(sprintf('%s %s', trans('hifone.whoops'), trans('hifone.failure')));
        }

        dispatch(new AddFollowCommand($user));

        return Redirect::route('user.home', $user->username)
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
    }
}
