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
use Hifone\Models\Scopes\ForUser;
use Hifone\Models\Scopes\Recent;
use Hifone\Presenters\NotificationPresenter;
use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\HasPresenter;

class Notification extends Model implements HasPresenter
{
    use ValidatingTrait, ForUser, Recent;

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = ['author_id', 'user_id', 'object_id', 'object_type', 'type', 'body'];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'author_id' => 'required|int',
        'user_id'   => 'required|int',
        'object_id' => 'required|int',
    ];

    public function object()
    {
        return $this->morphTo();
    }

    /**
     * Notications can belong to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopeForAuthor($query, $author_id)
    {
        return $query->where('author_id', $author_id);
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return NotificationPresenter::class;
    }
}
