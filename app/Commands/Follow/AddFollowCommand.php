<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Commands\Follow;

final class AddFollowCommand
{
    public $target;

    /**
     * Create a new add follow command instance.
     *
     * @param string $body
     */
    public function __construct($target)
    {
        $this->target = $target;
    }
}
