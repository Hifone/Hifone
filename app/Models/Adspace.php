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

class Adspace extends Model
{
    use ValidatingTrait;

    /**
     * List of attributes that have default values.
     *
     * @var mixed[]
     */
    protected $attributes = [
        'route' => '',
    ];

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'route',
        'adblock_id',
        'order',
        'position',
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'name'      => 'required|string',
        'position'  => 'required|string',
    ];

    public function adblock()
    {
        return $this->belongsTo(Adblock::class);
    }

    //
    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }
}
