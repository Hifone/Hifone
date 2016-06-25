<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Repositories\Criteria;

use Hifone\Repositories\Contracts\RepositoryInterface as Repository;

abstract class Criteria
{
    abstract public function apply($model, Repository $repository);
}
