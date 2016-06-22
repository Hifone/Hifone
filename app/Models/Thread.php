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
use Carbon\Carbon;
use Config;
use Hifone\Models\Scopes\ForUser;
use Hifone\Models\Tag\TaggableInterface;
use Hifone\Models\Traits\Taggable;
use Hifone\Presenters\ThreadPresenter;
use Illuminate\Database\Eloquent\Model;
use Input;
use McCool\LaravelAutoPresenter\HasPresenter;

class Thread extends Model implements HasPresenter, TaggableInterface
{
    use ValidatingTrait, Taggable, ForUser;
    // manually maintian
    public $timestamps = false;

    //use SoftDeletingTrait;
    protected $dates = ['deleted_at'];

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'body',
        'excerpt',
        'body_original',
        'user_id',
        'node_id',
        'is_excellent',
        'created_at',
        'updated_at',
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'title'        => 'required|min:2',
        'body'         => 'required|min:2',
        'node_id'      => 'required|int',
        'user_id'      => 'required|int',
    ];

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function follows()
    {
        return $this->morphMany(Follow::class, 'followable');
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function node()
    {
        return $this->belongsTo(Node::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lastReplyUser()
    {
        return $this->belongsTo(User::class, 'last_reply_user_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function appends()
    {
        return $this->hasMany(Append::class);
    }

    public function generateLastReplyUserInfo()
    {
        $lastReply = $this->replies()->recent()->first();

        $this->last_reply_user_id = $lastReply ? $lastReply->user_id : 0;
        $this->save();
    }

    public function scopeNodeThreads($query, $filter, $node_id)
    {
        return $this->filter($filter == 'default' ? 'node' : $filter)
                    ->where('node_id', '=', $node_id)
                    ->with('user', 'node', 'lastReplyUser');
    }

    public function scopeFilter($query, $filter)
    {
        switch ($filter) {
            case 'noreply':
                return $this->orderBy('reply_count', 'asc')->recent();
                break;
            case 'like':
                return $this->orderBy('like_count', 'desc')->recent();
                break;
            case 'excellent':
                return $this->excellent()->recent();
                break;
            case 'recent':
                return $this->recent();
                break;
            case 'node':
                return $this->recentReply();
                break;
            default:
                return $this->pinAndRecentReply();
                break;
        }
    }

    public function scopeSearch($query, $search)
    {
        if (!$search) {
            return;
        }

        return  $query->where(function ($query) use ($search) {
            $query->where('title', 'LIKE', "%$search%");
        });
    }

    /**
     * 边栏同一节点下的话题列表.
     */
    public function getSameNodeThreads($limit = 8)
    {
        return $this->where('node_id', '=', $this->node_id)
                        ->recent()
                        ->take($limit)
                        ->get();
    }

    public function scopeWhose($query, $user_id)
    {
        return $query->forUser($user_id)->with('node');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopePinAndRecentReply($query)
    {
        return $query->whereRaw("(`created_at` > '".Carbon::today()->subMonth()->toDateString()."' or (`order` > 0) )")
                     ->orderBy('order', 'desc')
                     ->orderBy('updated_at', 'desc');
    }

    public function scopeRecentReply($query)
    {
        return $query->orderBy('order', 'desc')
                     ->orderBy('updated_at', 'desc');
    }

    public function scopeExcellent($query)
    {
        return $query->where('is_excellent', '=', true);
    }

    public static function makeExcerpt($body)
    {
        $html = $body;
        $excerpt = trim(preg_replace('/\s\s+/', ' ', strip_tags($html)));

        return str_limit($excerpt, 200);
    }

    public function replyFloorFromIndex($index)
    {
        $index += 1;
        $current_page = Input::get('page') ?: 1;

        return ($current_page - 1) * Config::get('hifone.replies_perpage') + $index;
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return ThreadPresenter::class;
    }
}
