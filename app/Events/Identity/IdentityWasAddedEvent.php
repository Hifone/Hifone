<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Events\Identity;

use Hifone\Models\Identity;

final class IdentityWasAddedEvent implements IdentityEventInterface
{
    /**
     * The identity that has been reported.
     *
     * @var \Hifone\Models\Identity
     */
    public $identity;

    /**
     * Create a new identity has reported event instance.
     */
    public function __construct(Identity $identity)
    {
        $this->identity = $identity;
    }
}
