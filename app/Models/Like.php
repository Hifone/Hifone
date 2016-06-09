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

use AltThree\Validator\ValidatingTrait;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use ValidatingTrait;

    /**
     * Like.
     *
     * @var int
     */
    const LIKE = 1;

    /**
     * Unlike.
     *
     * @var int
     */
    const UNLIKE = -1;

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = ['user_id', 'likeable_id', 'likeable_type', 'rating'];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'user_id'        => 'required|int',
        'likeable_id'    => 'required|int',
        'likeable_type'  => 'required|string',
        'rating'         => 'required|int',
    ];

    public function likeable()
    {
        return $this->morphTo();
    }

    public function scopeByWhom($query, $user_id)
    {
        return $query->where('user_id', '=', $user_id);
    }

    public function scopeWithUp($query)
    {
        return $query->where('rating', self::LIKE);
    }

    public function scopeWithDown($query)
    {
        return $query->where('rating', self::UNLIKE);
    }
}
