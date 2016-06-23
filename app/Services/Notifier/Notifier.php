<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Services\Notifier;

use Carbon\Carbon;
use Hifone\Models\Notification;
use Hifone\Models\Reply;
use Hifone\Models\User;

class Notifier
{
    protected $notifiedUsers = [];

    public function notify($type, User $fromUser, User $toUser, $object = null)
    {
        $object_id = $object ? $object->id : 0;

        if ($this->isNotified($fromUser->id, $toUser->id, $object_id, $type)) {
            return;
        }

        $nowTimestamp = Carbon::now()->toDateTimeString();

        $data = [
            'from_user_id'  => $fromUser->id,
            'user_id'       => $toUser->id,
            'object_id'     => $object_id,
            'body'          => isset($object) ? $object->body : '',
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
     * @param [type] $type      currently have 'at', 'new_reply', 'follow', 'append'
     * @param User   $fromUser  come from who
     * @param array  $users     to who, array of users
     * @param int    $object_id cuurent context
     * @param Reply  $reply     the content
     *
     * @return [type] none
     */
    public function batchNotify($type, User $fromUser, $users, $object_id, $content = null)
    {
        $nowTimestamp = Carbon::now()->toDateTimeString();
        $data = [];

        foreach ($users as $toUser) {
            $data[] = [
                'from_user_id'  => $fromUser->id,
                'user_id'       => $toUser->id,
                'object_id'     => $object_id,
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

    protected function isNotified($from_user_id, $user_id, $object_id, $type)
    {
        return Notification::fromWhom($from_user_id)
                        ->forUser($user_id)
                        ->forObject($object_id)
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
