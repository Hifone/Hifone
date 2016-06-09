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

class Page extends Model
{
    use ValidatingTrait;

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'slug',
        'body',
        'body_original',
        'created_at',
        'updated_at',
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'title'      => 'required|string',
        'slug'       => 'required|string',
        'body'       => 'string',
    ];

    public function getUrlAttribute()
    {
        return ($this->slug) ? route('page', $this->slug) : '/?fr=page_error';
    }
}
