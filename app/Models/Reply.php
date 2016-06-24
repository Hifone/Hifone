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
use Hifone\Presenters\ReplyPresenter;
use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\HasPresenter;

class Reply extends Model implements HasPresenter
{
    use ValidatingTrait, ForUser, Recent;

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'body',
        'user_id',
        'thread_id',
        'body_original',
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'thread_id' => 'required|int',
        'body'      => 'required|max:1024',
        'user_id'   => 'int',
    ];

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'object');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return ReplyPresenter::class;
    }
}
