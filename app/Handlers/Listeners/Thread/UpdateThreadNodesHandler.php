<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Listeners\Thread;

use Hifone\Events\Thread\ThreadWasMovedEvent;
use Hifone\Models\Thread;

class UpdateThreadNodesHandler
{
    public function handle(ThreadWasMovedEvent $event)
    {
        $thread = $event->target;

        $targetNode = $thread->node;
        $originalNode = $event->originalNode;

        $targetNode->update(['thread_count' => Thread::where('node_id', $targetNode->id)->count()]);
        $originalNode->update(['thread_count' => Thread::where('node_id', $targetNode->id)->count()]);
    }
}
