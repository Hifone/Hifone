<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Listeners\Reply;

use Hifone\Events\EventInterface;

class UpdateReplyThreadHandler
{
    public function handle(EventInterface $event)
    {
        $reply = $event->reply;

        $reply->thread->decrement('reply_count', 1);

        $reply->thread->generateLastReplyUserInfo();
    }
}
