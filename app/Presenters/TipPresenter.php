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

class TipPresenter extends AbstractPresenter
{
    use TimestampsTrait;

    public function status_color()
    {
        switch ($this->wrappedObject->status) {
            case 1: return 'green';
            case 2: return 'blue';
            case 3: return 'yellow';
            case 4: return 'red';
            default: return '';
        }
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
