<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Presenters;

class NotificationPresenter extends AbstractPresenter
{
    public function labelUp()
    {
        //return "test";
        switch ($this->wrappedObject->type) {
            case 'new_reply':
            $label = trans('hifone.notifications.new_reply');
                break;
            case 'follow':
                $label = trans('hifone.notifications.follow');
                break;
            case 'at':
                $label = trans('hifone.notifications.at');
                break;
            case 'thread_favorite':
                $label = trans('hifone.notifications.thread_favorite');
                break;
            case 'thread_follow':
                $label = trans('hifone.notifications.thread_follow');
                break;
            case 'thread_like':
                $label = trans('hifone.notifications.thread_like');
                break;
            case 'reply_like':
                $label = trans('hifone.notifications.reply_like');
                break;
            case 'thread_mark_excellent':
                $label = trans('hifone.notifications.thread_mark_excellent');
                break;
            case 'thread_move':
                $label = trans('hifone.notifications.thread_move');
                break;
            case 'comment_append':
                $label = trans('hifone.notifications.comment_append');
                break;
            case 'follow_append':
                $label = trans('hifone.notifications.follow_append');
                break;
            case 'user_follow':
                 $label = trans('hifone.notifications.user_follow');
                break;
            case 'user_follow_thread':
                 $label = trans('hifone.notifications.user_follow_thread');
                break;
            default:
                $label = 'unknow';
                break;
        }

        return $label;
    }

    /**
     * Convert the presenter instance to an array.
     *
     * @return string[]
     */
    public function toArray()
    {
        return array_merge($this->wrappedObject->toArray(), [
            'created_at' => $this->created_at(),
            'updated_at' => $this->updated_at(),
        ]);
    }
}
