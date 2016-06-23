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
use Hifone\Presenters\NodePresenter;
use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\HasPresenter;

class Node extends Model implements HasPresenter
{
    use ValidatingTrait;
    /**
     * List of attributes that have default values.
     *
     * @var mixed[]
     */
    protected $attributes = [
        'section_id' => 0,
    ];
    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'section_id',
        'name',
        'slug',
        'order',
        'icon',
        'description',
        'thread_count',
        'reply_count',
        'status',
        'created_at',
        'updated_at',
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'name'      => 'required|string',
        'order'     => 'int',
        'status'    => 'int',
    ];

    /**
     * Nodes can belong to a section.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    /**
     * Lookup all of the threads posted on the node.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function threads($filter)
    {
        return $this->hasMany(Thread::class)->getThreadsWithFilter($filter);
    }

    /**
     * Returns url of this node.
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return ($this->slug) ? route('go', $this->slug) : route('node.show', $this->id);
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return NodePresenter::class;
    }
}
