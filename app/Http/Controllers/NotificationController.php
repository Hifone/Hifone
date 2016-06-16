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

use Auth;
use Illuminate\Support\Facades\View;
use Config;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->recent()->with('thread', 'fromUser')->paginate(Config::get('setting.per_page'));

        Auth::user()->notification_count = 0;
        Auth::user()->save();

        return View::make('notifications.index')
            ->withNotifications($notifications);
    }

    public function count()
    {
        return Auth::user()->notification_count;
    }
}
