<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Events\Append;

use Hifone\Models\Append;

final class AppendWasAddedEvent implements AppendEventInterface
{
    /**
     * The thread that has been reported.
     *
     * @var \Hifone\Models\Append
     */
    public $append;

    /**
     * Create a new thread has reported event instance.
     */
    public function __construct(Append $append)
    {
        $this->append = $append;
    }
}
