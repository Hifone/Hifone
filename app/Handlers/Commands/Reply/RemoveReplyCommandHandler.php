<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Commands\Reply;

use Hifone\Commands\Reply\RemoveReplyCommand;
use Hifone\Events\Reply\ReplyWasRemovedEvent;

class RemoveReplyCommandHandler
{
    /**
     * Handle the remove reply command.
     *
     * @param \Hifone\Commands\Reply\RemoveReplyCommand $command
     *
     * @return void
     */
    public function handle(RemoveReplyCommand $command)
    {
        $reply = $command->reply;

        event(new ReplyWasRemovedEvent($reply));

        $reply->delete();
    }
}
