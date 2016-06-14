<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Commands\Reply;

use Hifone\Models\Reply;

final class RemoveReplyCommand
{
    /**
     * The reply to remove.
     *
     * @var \Hifone\Models\Reply
     */
    public $reply;

    /**
     * Create a new remove reply command instance.
     *
     * @param \Hifone\Models\Reply $reply
     *
     * @return void
     */
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }
}
