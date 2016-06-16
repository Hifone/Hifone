<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Events\Thread;

use Hifone\Models\Node;
use Hifone\Models\Thread;

final class ThreadWasMovedEvent implements ThreadEventInterface
{
    /**
     * The thread that has been moved.
     *
     * @var \Hifone\Models\Thread
     */
    public $target;

    public $originalNode;

    /**
     * Create a new thread has reported event instance.
     */
    public function __construct(Thread $thread, Node $originalNode)
    {
        $this->target = $thread;
        $this->originalNode = $originalNode;
    }
}
