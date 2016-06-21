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

class Credit extends Model
{
    use ValidatingTrait;

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = ['user_id', 'rule_id', 'balance'];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'user_id'    => 'required|int',
        'rule_id'    => 'required|int',
    ];

    public function rule()
    {
        return $this->belongsTo(CreditRule::class, 'rule_id');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
