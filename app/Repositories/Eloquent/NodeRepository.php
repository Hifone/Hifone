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

use Hifone\Repositories\Contracts\NodeRepositoryInterface;

class NodeRepository extends Repository implements NodeRepositoryInterface
{
    /**
     * @return \Hifone\Models\Node
     */
    public function model()
    {
        return 'Hifone\Models\Node';
    }
}
