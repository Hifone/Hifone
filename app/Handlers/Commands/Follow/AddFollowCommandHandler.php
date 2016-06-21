<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Commands\Follow;

use Auth;
use Hifone\Commands\Follow\AddFollowCommand;
use Hifone\Events\Follow\FollowWasAddedEvent;
use Hifone\Services\Dates\DateFactory;

class AddFollowCommandHandler
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
    public function handle(AddFollowCommand $command)
    {
        $this->followAction($command->target);
    }

    protected function followAction($target)
    {
        if ($target->follows()->forUser(Auth::id())->count()) {
            $target->follows()->forUser(Auth::id())->delete();
        } else {
            $target->follows()->create(['user_id' => Auth::id()]);
            event(new FollowWasAddedEvent($target));
        }
    }
}
