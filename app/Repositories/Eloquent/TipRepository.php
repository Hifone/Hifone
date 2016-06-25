<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Repositories\Eloquent;

use Hifone\Repositories\Contracts\TipRepositoryInterface;

class TipRepository extends Repository implements TipRepositoryInterface
{
    /**
     * @return \Hifone\Models\Tip
     */
    public function model()
    {
        return 'Hifone\Models\Tip';
    }
}