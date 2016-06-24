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

class SendReplyNotificationHandler
{
    /**
     * Handle the thread.
     */
    public function handle(ReplyEventInterface $event)
    {
        $this->newReplyNotify(Auth::user(), $event->reply);
    }

    protected function newReplyNotify(User $author, Reply $reply)
    {
        $thread = $reply->thread;
        // Notify the author
        app('notifier')->batchNotify(
                    'thread_new_reply',
                    $author,
                    [$thread->user],
                    $reply,
                    $reply->body
                    );

        // Notify followed users
        app('notifier')->batchNotify(
                    'followed_thread_new_reply',
                    $author,
                    $thread->follows()->get(),
                    $reply->thread,
                    $reply->body
                    );

        $parserAt = app('parser.at');
        $parserAt->parse($reply->body_original);

        // Notify mentioned users
        app('notifier')->batchNotify(
                    'reply_mention',
                    $author,
                    $parserAt->users,
                    $reply,
                    $reply->body
                    );
    }
}
