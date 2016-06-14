<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Commands\Thread;

use Hifone\Models\Thread;

final class RemoveThreadCommand
{
    /**
     * The thread to remove.
     *
     * @var \Hifone\Models\Thread
     */
    public $thread;

    /**
     * Create a new remove thread command instance.
     *
     * @param \Hifone\Models\Thread $thread
     *
     * @return void
     */
    public function __construct(Thread $thread)
    {
        $this->thread = $thread;
    }
}
