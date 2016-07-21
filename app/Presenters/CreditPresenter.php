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

class CreditPresenter extends AbstractPresenter
{
    use TimestampsTrait;

    public function reward_formatted()
    {
        $prefix = '';
        $reward = $this->wrappedObject->body ?: $this->wrappedObject->rule->reward;
        if ($reward > 0) {
            $prefix = '<strong class="text-success">+';
        } else {
            $prefix = '<strong class="text-danger">';
        }

        return $prefix.number_format($reward, 1).'</strong>';
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
