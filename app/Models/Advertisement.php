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
use Hifone\Models\Ad\Adspace;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use ValidatingTrait;

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'adspace_id',
        'body',
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'name'       => 'required|string',
        'adspace_id' => 'required|int',
        'body'       => 'required|string',
    ];

    /**
     * An advertisement belongs to an adspace.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function adspace()
    {
        return $this->belongsTo(Adspace::class);
    }
}
