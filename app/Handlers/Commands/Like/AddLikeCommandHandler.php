<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Commands\Like;

use Auth;
use Hifone\Commands\Like\AddLikeCommand;
use Hifone\Events\Like\LikeWasAddedEvent;
use Hifone\Models\Like;
use Hifone\Services\Dates\DateFactory;

class AddLikeCommandHandler
{
    /**
     * The date factory instance.
     *
     * @var \Hifone\Services\Dates\DateFactory
     */
    protected $dates;

    /**
     * Create a new report issue command handler instance.
     *
     * @param \Hifone\Services\Dates\DateFactory $dates
     */
    public function __construct(DateFactory $dates)
    {
        $this->dates = $dates;
    }

    /**
     * Handle the report avorite command.
     *
     * @param \Hifone\Commands\Thread\AddThreadCommand $command
     *
     * @return \Hifone\Models\Thread
     */
    public function handle(AddLikeCommand $command)
    {
        if ($command->action == 'like') {
            $this->likeAction($command->target);
        } else {
            $this->unlikeAction($command->target);
        }
    }

    protected function likeAction($target)
    {
        if ($target->likes()->forUser(Auth::id())->WithUp()->count()) {
            // click twice for remove like
            $target->likes()->forUser(Auth::id())->WithUp()->delete();
            $target->decrement('like_count', 1);
        } elseif ($target->likes()->forUser(Auth::id())->WithDown()->count()) {
            // user already clicked unlike once
            $target->likes()->forUser(Auth::id())->WithDown()->delete();
            $target->likes()->create(['user_id' => Auth::id(), 'rating' => Like::LIKE]);
            $target->increment('like_count', 2);
        } else {
            // first time click
            $target->likes()->create(['user_id' => Auth::id(), 'rating' => Like::LIKE]);
            $target->increment('like_count', 1);

            event(new LikeWasAddedEvent($target));
        }
    }

    protected function unlikeAction($target)
    {
        if ($target->likes()->forUser(Auth::id())->WithDown()->count()) {
            // click second time for remove unlike
            $target->likes()->forUser(Auth::id())->WithDown()->delete();
            $target->increment('like_count', 1);
        } elseif ($target->likes()->forUser(Auth::id())->WithUp()->count()) {
            // user already clicked like once
            $target->likes()->forUser(Auth::id())->WithUp()->delete();
            $target->likes()->create(['user_id' => Auth::id(), 'rating' => Like::UNLIKE]);
            $target->decrement('like_count', 2);
        } else {
            // click first time
            $target->likes()->create(['user_id' => Auth::id(), 'rating' => Like::UNLIKE]);
            $target->decrement('like_count', 1);
            event(new LikeWasAddedEvent($target));
        }
    }
}
