<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Events\Link;

use Hifone\Models\Link;

final class LinkWasUpdatedEvent implements LinkEventInterface
{
    public $link;

    public function __construct(Link $link)
    {
        $this->link = $link;
    }
}
