<?php

namespace Hifone\Models\Scopes;

trait ForUser
{
    /**
     * Scope a query to only given user id.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}