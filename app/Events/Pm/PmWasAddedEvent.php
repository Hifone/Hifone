<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Events\Pm;

use Hifone\Models\Pm;

final class PmWasAddedEvent implements PmEventInterface
{
    public $pm;

    /**
     * Create a new pm has reported event instance.
     */
    public function __construct(Pm $pm)
    {
        $this->pm = $pm;
    }
}
