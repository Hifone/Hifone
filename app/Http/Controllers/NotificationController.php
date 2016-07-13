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
use Hifone\Models\Notification;
use Hifone\Services\Dates\DateFactory;
use Illuminate\Support\Facades\View;
use Redirect;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::forUser(Auth::user()->id)->recent()->paginate(20)->groupBy(function (Notification $notification) {
            return app(DateFactory::class)->make($notification->created_at)->toDateString();
        });

        Auth::user()->notification_count = 0;
        Auth::user()->save();

        return $this->view('notifications.index')
            ->withNotifications($notifications);
    }

    public function count()
    {
        return Auth::user()->notification_count;
    }

    public function clean()
    {
        Notification::forUser(Auth::user()->id)->delete();

        return Redirect::route('notification.index')
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
    }
}
