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

class NodePresenter extends AbstractPresenter
{
    use TimestampsTrait;

    public function url()
    {
        return $this->wrappedObject->slug ? route('go', $this->wrappedObject->slug) : route('node.show', $this->wrappedObject->id);
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
