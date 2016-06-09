<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Commands\Favorite;

use Auth;
use Hifone\Commands\Favorite\AddFavoriteCommand;
use Hifone\Dates\DateFactory;
use Hifone\Events\Favorite\FavoriteWasAddedEvent;
use Hifone\Models\Favorite;

class AddFavoriteCommandHandler
{
    /**
     * The date factory instance.
     *
     * @var \Gitamin\Dates\DateFactory
     */
    protected $dates;

    /**
     * Create a new report issue command handler instance.
     *
     * @param \Gitamin\Dates\DateFactory $dates
     */
    public function __construct(DateFactory $dates)
    {
        $this->dates = $dates;
    }

    /**
     * Handle the report avorite command.
     *
     * @param \Gitamin\Commands\Thread\AddThreadCommand $command
     *
     * @return \Gitamin\Models\Thread
     */
    public function handle(AddFavoriteCommand $command)
    {
        $this->favoriteAction($command->target);
    }

    protected function favoriteAction($target)
    {
        if (Favorite::isUserFavoritedThread(Auth::user(), $target->id)) {
            Auth::user()->favoriteThreads()->detach($target->id);
        } else {
            Auth::user()->favoriteThreads()->attach($target->id);

            event(new FavoriteWasAddedEvent($target));
        }
    }
}
