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
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Adblock extends Model
{
    use ValidatingTrait, RevisionableTrait;

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'slug',
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

    /**
     * Get the adspaces relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adspaces()
    {
        return $this->hasMany(Adspace::class)->orderBy('order');
    }
}
