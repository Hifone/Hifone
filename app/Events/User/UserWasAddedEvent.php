<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Events\User;

use Hifone\Models\User;

final class UserWasAddedEvent implements UserEventInterface
{
    /**
     * The user that has been added.
     *
     * @var \Hifone\Models\User
     */
    public $user;

    /**
     * Create a new thread has reported event instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
