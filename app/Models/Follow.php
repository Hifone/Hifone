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
use Hifone\Models\Scopes\ForUser;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use ValidatingTrait, ForUser;

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = ['user_id', 'followable_id', 'followable_type'];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'user_id'          => 'required|int',
        'followable_id'    => 'required|int',
        'followable_type'  => 'required|string',
    ];

    /**
     * Get all of the owning followable models.
     */
    public function followable()
    {
        return $this->morphTo();
    }

    /**
     * Follows can belong to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
