<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Stats extends Model
{
    public static function newUser()
    {
        self::collect('new_user');
    }

    public static function newThread()
    {
        self::collect('new_thread');
    }

    public static function newReply()
    {
        self::collect('new_reply');
    }

    public static function newImage()
    {
        self::collect('new_image');
    }

    /**
     * Collection site status.
     *
     * @param [string] $action
     *
     * @return void
     */
    public static function collect($subject)
    {
        $today = Carbon::now()->toDateString();

        if (!$todayStatus = self::where('day', $today)->first()) {
            $todayStatus = new self();
            $todayStatus->day = $today;
        }

        switch ($subject) {
            case 'new_user':
                $todayStatus->register_count += 1;
                break;
            case 'new_thread':
                $todayStatus->thread_count += 1;
                break;
            case 'new_reply':
                $todayStatus->reply_count += 1;
                break;
            case 'new_image':
                $todayStatus->image_count += 1;
                break;
        }

        $todayStatus->save();
    }
}
