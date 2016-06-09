<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Models;

use Illuminate\Database\Eloquent\Model;

class Identity extends Model
{
    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'extern_uid',
        'nickname',
        'name',
        'email',
        'avatar',
        'user_id',
        'provider_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
