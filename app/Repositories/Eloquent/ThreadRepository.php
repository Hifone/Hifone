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

use Hifone\Repositories\Contracts\ThreadRepositoryInterface;

class ThreadRepository extends Repository implements ThreadRepositoryInterface
{
    /**
     * @return \Hifone\Models\Thread
     */
    public function model()
    {
        return 'Hifone\Models\Thread';
    }
}