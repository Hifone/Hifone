<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Repositories\Eloquent\Credit;

use Hifone\Repositories\Contracts\Credit\RuleRepositoryInterface;
use Hifone\Repositories\Eloquent\Repository;

class RuleRepository extends Repository implements RuleRepositoryInterface
{
    /**
     * @return \Hifone\Models\Credit\Rule
     */
    public function model()
    {
        return 'Hifone\Models\Credit\Rule';
    }
}