<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Listeners\Photo;

use Auth;
use Hifone\Events\EventInterface;
use Hifone\Models\Photo;

class AddPhotoRecordHandler
{
    public function handle(EventInterface $event)
    {
        Photo::create([
            'user_id' => Auth::user()->id,
            'image'   => $event->file['filename'],
        ]);
    }
}
