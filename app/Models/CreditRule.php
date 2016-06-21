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

class CreditRule extends Model
{
    use ValidatingTrait;

    const NO_LIMIT = 0;

    const DAILY = 1;

    const ONCE = 2;

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = ['name', 'slug', 'reward', 'frequency'];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'name'      => 'required|string',
        'slug'      => 'required|string',
        'reward'    => 'required|int',
    ];
}
