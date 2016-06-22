<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Events\Notification;

use Carbon\Carbon;
use Hifone\Models\Notification;
use Hifone\Models\Reply;
use Hifone\Models\Thread;
use Hifone\Models\User;

abstract class AbstractNotificationHandler
{
    protected $notifiedUsers = [];

    protected function notify($type, User $fromUser, User $toUser, Thread $thread = null, Reply $reply = null)
    {
        $target_id = $thread ? $thread->id : 0;

        if ($this->isNotified($fromUser->id, $toUser->id, $target_id, $type)) {
            return;
        }

        $nowTimestamp = Carbon::now()->toDateTimeString();

        $data = [
            'from_user_id'  => $fromUser->id,
            'user_id'       => $toUser->id,
            'thread_id'     => $target_id,
            'reply_id'      => $reply ? $reply->id : 0,
            'body'          => $reply ? $reply->body : '',
            'type'          => $type,
            'created_at'    => $nowTimestamp,
            'updated_at'    => $nowTimestamp,
        ];

        $toUser->increment('notification_count', 1);

        Notification::insert([$data]);
    }

    /**
     * Create a notification.
     *
     * @param [type] $type     currently have 'at', 'new_reply', 'follow', 'append'
     * @param User   $fromUser come from who
     * @param array  $users    to who, array of users
     * @param Thread $thread   cuurent context
     * @param Reply  $reply    the content
     *
     * @return [type] none
     */
    protected function batchNotify($type, User $fromUser, $users, $thread_id, $reply_id = 0, $content = null)
    {
        $nowTimestamp = Carbon::now()->toDateTimeString();
        $data = [];

        foreach ($users as $toUser) {
            $data[] = [
                'from_user_id'  => $fromUser->id,
                'user_id'       => $toUser->id,
                'thread_id'     => $thread_id,
                'reply_id'      => $reply_id,
                'body'          => $content,
                'type'          => $type,
                'created_at'    => $nowTimestamp,
                'updated_at'    => $nowTimestamp,
            ];

            $toUser->increment('notification_count', 1);
        }

        if (count($data)) {
            Notification::insert($data);
        }
    }

    protected function isNotified($from_user_id, $user_id, $thread_id, $type)
    {
        return Notification::fromwhom($from_user_id)
                        ->forUser($user_id)
                        ->atThread($thread_id)
                        ->ofType($type)->get()->count();
    }

    // in case of a user get a lot of the same notification
    protected function removeDuplication($users)
    {
        $notYetNotifyUsers = [];
        foreach ($users as $follow) {
            $user = (!$follow instanceof User) ? $follow->user : $follow;

            if (!in_array($user->id, $this->notifiedUsers)) {
                $notYetNotifyUsers[] = $user;
                $this->notifiedUsers[] = $user->id;
            }
        }

        return $notYetNotifyUsers;
    }
}
