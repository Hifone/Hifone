<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Events\User;

use Auth;
use Hifone\Events\EventInterface;
use Hifone\Events\Image\ImageWasUploadedEvent;
use Hifone\Events\Reply\ReplyWasAddedEvent;
use Hifone\Events\Thread\ThreadWasAddedEvent;

class UpdateScoreEventHandler
{
    public function handle(EventInterface $event)
    {
        $score = 0;
        if ($event instanceof ReplyWasAddedEvent) {
            $score = 5;
        } elseif ($event instanceof ThreadWasAddedEvent) {
            $score = 10;
        } elseif ($event instanceof ImageWasUploadedEvent) {
            $score = 2;
        }

        if ($score > 0) {
            Auth::user()->increment('score', $score);
        }
    }
}
