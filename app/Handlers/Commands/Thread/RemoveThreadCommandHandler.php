<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Commands\Thread;

use Hifone\Commands\Thread\RemoveThreadCommand;
use Hifone\Events\Thread\ThreadWasRemovedEvent;

class RemoveThreadCommandHandler
{
    /**
     * Handle the remove thread command.
     *
     * @param \Hifone\Commands\Thread\RemoveThreadCommand $command
     *
     * @return void
     */
    public function handle(RemoveThreadCommand $command)
    {
        $thread = $command->thread;

        event(new ThreadWasRemovedEvent($thread));

        $thread->delete();
    }
}
