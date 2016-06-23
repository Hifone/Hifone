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
use Hifone\Events\Reply\ReplyEventInterface;
use Hifone\Models\Reply;
use Hifone\Models\Thread;
use Hifone\Models\User;
use Hifone\Services\Notifier\Notifier;

class SendReplyNotificationHandler
{
    /**
     * Handle the thread.
     */
    public function handle(ReplyEventInterface $event)
    {
        $this->newReplyNotify(Auth::user(), $event->reply);
    }

    protected function newReplyNotify(User $fromUser, Reply $reply)
    {
        $thread = $reply->thread;
        // Notify the author
        app(Notifier::class)->batchNotify(
                    'new_reply',
                    $fromUser,
                    [$thread->user],
                    $reply->id,
                    $reply->body
                    );

        // Notify followed users
        
        app(Notifier::class)->batchNotify(
                    'follow',
                    $fromUser,
                    $thread->follows()->get(),
                    $reply->thread->id,
                    $reply->body
                    );

        $parserAt = app('parser.at');
        $parserAt->parse($reply->body_original);

        // Notify mentioned users
        app(Notifier::class)->batchNotify(
                    'at',
                    $fromUser,
                    $parserAt->users,
                    $reply->id,
                    $reply->body
                    );
    }
}
