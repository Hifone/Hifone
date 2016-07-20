<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Models\Ad;

use AltThree\Validator\ValidatingTrait;
use Hifone\Models\Advertisement;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Adspace extends Model
{
    use ValidatingTrait, RevisionableTrait;

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

    /**
     * Get the advertisements relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }
}
