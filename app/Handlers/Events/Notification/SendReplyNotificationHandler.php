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

use Auth;
use Hifone\Events\Reply\ReplyEventInterface;
use Hifone\Models\Reply;
use Hifone\Models\Thread;
use Hifone\Models\User;
use Hifone\Parsers\ParseAt;

class SendReplyNotificationHandler extends AbstractNotificationHandler
{
    protected $parseAt;

    public function __construct(ParseAt $parseAt)
    {
        $this->parseAt = $parseAt;
    }

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
        $this->batchNotify(
                    'new_reply',
                    $fromUser,
                    $this->removeDuplication([$thread->user]),
                    $thread->id,
                    $reply->id,
                    $reply->body
                    );

        // Notify followed users
        $this->batchNotify(
                    'follow',
                    $fromUser,
                    $this->removeDuplication($thread->follows()->get()),
                    $thread->id,
                    $reply->id,
                    $reply->body
                    );

        $this->parseAt->parse($reply->body_original);
        // Notify mentioned users
        $this->batchNotify(
                    'at',
                    $fromUser,
                    $this->removeDuplication($this->parseAt->users),
                    $thread->id,
                    $reply->id,
                    $reply->body
                    );
    }
}
