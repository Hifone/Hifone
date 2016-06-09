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

use Hifone\Models\Thread;

final class ThreadWasAddedEvent implements ThreadEventInterface
{
    /**
     * The thread that has been reported.
     *
     * @var \Hifone\Models\Thread
     */
    public $thread;

    /**
     * Create a new thread has reported event instance.
     */
    public function __construct(Thread $thread)
    {
        $this->thread = $thread;
    }
}
