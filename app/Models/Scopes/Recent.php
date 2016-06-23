<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Models\Scopes;

trait Recent
{
    /**
     * Scope a query order by created desc.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int                                   $userId
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }
}
