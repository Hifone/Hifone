<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Events\Credit;

use Hifone\Models\Credit;

final class CreditWasAddedEvent implements CreditEventInterface
{
    /**
     * The credit that has been reported.
     *
     * @var \Hifone\Models\Credit
     */
    public $credit;

    public $upstream_event;

    /**
     * Create a new thread has reported event instance.
     */
    public function __construct(Credit $credit, $event)
    {
        $this->credit = $credit;
        $this->upstream_event = $event;
    }
}
