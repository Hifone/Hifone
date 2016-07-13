<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Listeners\Notification;

use Auth;
use Hifone\Events\Credit\CreditWasAddedEvent;
use Hifone\Events\EventInterface;
use Hifone\Events\Favorite\FavoriteEventInterface;
use Hifone\Events\Follow\FollowEventInterface;
use Hifone\Events\Like\LikeEventInterface;
use Hifone\Events\Thread\ThreadWasMarkedExcellentEvent;
use Hifone\Events\Thread\ThreadWasMovedEvent;
use Hifone\Events\User\UserWasAddedEvent;
use Hifone\Events\User\UserWasLoggedinEvent;
use Hifone\Models\Thread;
use Hifone\Models\User;

class SendSingleNotificationHandler
{
    /**
     * Handle the favorite.
     */
    public function handle(EventInterface $event)
    {
        // follow
        if ($event instanceof FollowEventInterface) {
            $this->follow($event->target);
        } elseif ($event instanceof LikeEventInterface) {
            $this->like($event->target);
        } elseif ($event instanceof FavoriteEventInterface) {
            $this->favorite($event->target);
        } elseif ($event instanceof ThreadWasMarkedExcellentEvent) {
            $this->markedExcellent($event->target);
        } elseif ($event instanceof ThreadWasMovedEvent) {
            $this->movedThread($event->target);
        } elseif ($event instanceof CreditWasAddedEvent) {
            if ($event->upstream_event instanceof UserWasAddedEvent) {
                $this->notifyCredit('credit_register', $event->upstream_event->user, $event->credit);
            } elseif ($event->upstream_event instanceof UserWasLoggedinEvent) {
                $this->notifyCredit('credit_login', $event->upstream_event->user, $event->credit);
            } else {
                return;
            }
        }
    }

    protected function follow($target)
    {
        $type = ($target instanceof Thread) ? 'thread_follow' : 'user_follow';

        if ($type == 'thread_follow') {
            app('notifier')->notify($type, Auth::user(), $target->user, $target);
        } else {
            app('notifier')->notify($type, Auth::user(), $target, $target);
        }
    }

    protected function like($target)
    {
        $type = ($target instanceof Thread) ? 'thread_like' : 'reply_like';
        app('notifier')->notify($type, Auth::user(), $target->user, $target);
    }

    protected function favorite($target)
    {
        app('notifier')->notify('thread_favorite', Auth::user(), $target->user, $target);
    }

    protected function markedExcellent($target)
    {
        app('notifier')->notify('thread_mark_excellent', Auth::user(), $target->user, $target);
    }

    protected function movedThread($target)
    {
        app('notifier')->notify('thread_move', Auth::user(), $target->user, $target);
    }

    protected function notifyCredit($action, $user, $credit)
    {
        app('notifier')->notify($action, $user, $user, $credit);
    }
}
