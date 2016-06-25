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

final class UpdateThreadCommand
{
    public $thread;

    public $data;

    public function __construct(Thread $thread, $data)
    {
        $this->thread = $thread;
        $this->data = $data;
    }
}
