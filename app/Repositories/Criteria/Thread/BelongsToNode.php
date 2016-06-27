<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Repositories\Criteria\Thread;

use Hifone\Repositories\Contracts\RepositoryInterface as Repository;
use Hifone\Repositories\Criteria\Criteria;

class BelongsToNode extends Criteria
{
    /**
     * @var int
     */
    protected $nodeId;

    public function __construct($nodeId)
    {
        $this->nodeId = $nodeId;
    }

    public function apply($model, Repository $repository)
    {
        return $model->where('node_id', $this->nodeId);
    }
}
