<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Events\Reply;

use Hifone\Models\Reply;

final class ReplyWasAddedEvent implements ReplyEventInterface
{
    public $reply;

    /**
     * Create a new thread has reported event instance.
     */
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }
}
