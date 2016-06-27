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
use Config;
use Illuminate\Support\Facades\View;
use Redirect;
use Hifone\Models\Notification;
use Hifone\Services\Dates\DateFactory;

class NotificationController extends Controller
{
    public function index()
    {

        $notifications =  Auth::user()->notifications()->orderBy('created_at', 'desc')->paginate(20)->groupBy(function (Notification $incident) {
            return app(DateFactory::class)->make($incident->created_at)->toDateString();
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
        Auth::user()->notifications()->delete();

        return Redirect::route('notification.index')
            ->withSuccess(sprintf('%s %s', trans('hifone.awesome'), trans('hifone.success')));
    }
}
