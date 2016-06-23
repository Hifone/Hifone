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
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use ValidatingTrait, ForUser;

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [];

    /**
     * Favorites can belong to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function isUserFavoritedThread(User $user, $thread_id)
    {
        return self::forUser($user->id)
                        ->where('thread_id', $thread_id)
                        ->first();
    }
}
