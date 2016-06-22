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
use Hifone\Services\Parsers\ParseAt;

class SendThreadNotificationHandler extends AbstractNotificationHandler
{
    protected $parseAt;

    public function __construct(ParseAt $parseAt)
    {
        $this->parseAt = $parseAt;
    }

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
        $this->batchNotify(
                    'user_follow_thread',
                    $fromUser,
                    $this->removeDuplication($fromUser->follows()->get()),
                    $thread->id,
                    0,
                    $thread->body);
        // Notify mentioned users
        $this->parseAt->parse($thread->body_original);

        $this->batchNotify(
                    'at',
                    $fromUser,
                    $this->removeDuplication($this->parseAt->users),
                    $thread->id,
                    0,
                    $thread->body);
    }
}
