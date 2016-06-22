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
use Hifone\Events\EventInterface;
use Hifone\Events\Favorite\FavoriteEventInterface;
use Hifone\Events\Follow\FollowEventInterface;
use Hifone\Events\Like\LikeEventInterface;
use Hifone\Events\Thread\ThreadWasMarkedExcellentEvent;
use Hifone\Events\Thread\ThreadWasMovedEvent;
use Hifone\Models\Thread;
use Hifone\Models\User;

class SendSingleNotificationHandler extends AbstractNotificationHandler
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
        }
    }

    protected function follow($target)
    {
        $type = ($target instanceof Thread) ? 'thread_follow' : 'user_follow';

        if ($type == 'thread_follow') {
            $this->notify($type, Auth::user(), $target->user, $target);
        } else {
            $this->notify($type, Auth::user(), $target);
        }
    }

    protected function like($target)
    {
        $type = ($target instanceof Thread) ? 'thread_like' : 'reply_like';
        if ($type == 'reply_like') {
            $this->notify($type, Auth::user(), $target->user, $target->thread, $target);
        } else {
            $this->notify($type, Auth::user(), $target->user, $target);
        }
    }

    protected function favorite($target)
    {
        $this->notify('thread_favorite', Auth::user(), $target->user, $target);
    }

    protected function markedExcellent($target)
    {
        $this->notify('thread_mark_excellent', Auth::user(), $target->user, $target);
    }

    protected function movedThread($target)
    {
        $this->notify('thread_move', Auth::user(), $target->user, $target);
    }
}
