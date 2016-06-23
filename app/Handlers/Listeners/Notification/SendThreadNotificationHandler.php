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
use Hifone\Events\Thread\ThreadEventInterface;
use Hifone\Models\Thread;
use Hifone\Models\User;
use Hifone\Services\Notifier\Notifier;

class SendThreadNotificationHandler
{
    /**
     * Handle the thread.
     */
    public function handle(ThreadEventInterface $event)
    {
        $this->trigger($event->thread);
    }

    protected function trigger(Thread &$thread)
    {
        $this->newThreadNotify(Auth::user(), $thread);
    }

    protected function newThreadNotify(User $fromUser, Thread $thread)
    {
        // Notify followed users
        app(Notifier::class)->batchNotify(
                    'user_follow_thread',
                    $fromUser,
                    $fromUser->follows()->get(),
                    $thread->id,
                    $thread->body);
        // Notify mentioned users
        $parserAt = app('parser.at');
        $parserAt->parse($thread->body_original);

        app(Notifier::class)->batchNotify(
                    'at',
                    $fromUser,
                    $parserAt->users,
                    $thread->id,
                    $thread->body);
    }
}
