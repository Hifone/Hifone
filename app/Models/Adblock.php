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

class Adblock extends Model
{
    use ValidatingTrait;

    /**
     * List of attributes that have default values.
     *
     * @var mixed[]
     */
    protected $attributes = [
        'description' => '',
    ];

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'name'      => 'required|string',
        'slug'      => 'required|string',
    ];

    //
    public function adspaces()
    {
        return $this->hasMany(Adspace::class)->orderBy('order');
    }
}
