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
use Hifone\Presenters\NotificationPresenter;
use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\HasPresenter;

class Notification extends Model implements HasPresenter
{
    use ValidatingTrait, ForUser;

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
            'from_user_id',
            'user_id',
            'object_id',
            'reply_id',
            'body',
            'type',
            ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class, 'object_id');
    }

    public function reply()
    {
        return $this->belongsTo(Reply::class, 'object_id');
    }

    public function credit()
    {
        return $this->belongsTo(Credit::class, 'object_id');
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeFromWhom($query, $from_user_id)
    {
        return $query->where('from_user_id', '=', $from_user_id);
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', '=', $type);
    }

    public function scopeAtThread($query, $object_id)
    {
        return $query->where('object_id', $object_id);
        //return $query->whereNotIn('type', ['user_follow','credit_register'])->where('object_id', $object_id);
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
