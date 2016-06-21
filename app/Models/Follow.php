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
use Hifone\Models\Scopes\ForUser;

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

    public function followable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
