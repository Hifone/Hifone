<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Presenters;

use Hifone\Presenters\Traits\TimestampsTrait;
use McCool\LaravelAutoPresenter\Facades\AutoPresenter;

class ReplyPresenter extends AbstractPresenter
{
    use TimestampsTrait;

    public function url()
    {
        return route('thread.show', $this->wrappedObject->thread_id);
    }

    public function author_url()
    {
        return AutoPresenter::decorate($this->wrappedObject->user)->url;
    }

    public function highlight()
    {
        return $this->wrappedObject->like_count > 0 ? 'highlight' : null;
    }

    /**
     * Convert the presenter instance to an array.
     *
     * @return string[]
     */
    public function toArray()
    {
        return array_merge($this->wrappedObject->toArray(), [
            'created_at' => $this->created_at(),
            'updated_at' => $this->updated_at(),
        ]);
    }
}
