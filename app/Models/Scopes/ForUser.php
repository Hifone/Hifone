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

trait ForUser
{
    /**
     * Scope a query to only given user id.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int                                   $userId
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
