<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Events\Link;

use Cache;
use Hifone\Events\EventInterface;

class LinkWasUpdatedEventHandler
{
    public function handle(EventInterface $event)
    {
        Cache::forget('links');
        \Log::info('forget cache: links');
    }
}
