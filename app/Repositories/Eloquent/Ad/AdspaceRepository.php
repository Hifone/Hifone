<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Repositories\Eloquent\Ad;

use Hifone\Repositories\Contracts\Ad\AdspaceRepositoryInterface;
use Hifone\Repositories\Eloquent\Repository;

class AdspaceRepository extends Repository implements AdspaceRepositoryInterface
{
    /**
     * @return \Hifone\Models\Adspace
     */
    public function model()
    {
        return 'Hifone\Models\Ad\Adspace';
    }
}