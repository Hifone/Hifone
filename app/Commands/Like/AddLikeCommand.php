<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Commands\Like;

final class AddLikeCommand
{
    public $target;

    public $action;

    /**
     * Create a new add append command instance.
     *
     * @param string $body
     */
    public function __construct($target, $action = 'like')
    {
        $this->target = $target;
        $this->action = $action;
    }
}
