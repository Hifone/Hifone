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

use Hifone\Repositories\Contracts\SectionRepositoryInterface;

class SectionRepository extends Repository implements SectionRepositoryInterface
{
    /**
     * @return \Hifone\Models\Section
     */
    public function model()
    {
        return 'Hifone\Models\Section';
    }
}