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
use Hifone\Dates\DateFactory;
use Hifone\Events\Follow\FollowWasAddedEvent;

class AddFollowCommandHandler
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
    public function handle(AddFollowCommand $command)
    {
        $this->followAction($command->target);
    }

    protected function followAction($target)
    {
        if ($target->follows()->ByWhom(Auth::id())->count()) {
            $target->follows()->ByWhom(Auth::id())->delete();
        } else {
            $target->follows()->create(['user_id' => Auth::id()]);
            event(new FollowWasAddedEvent($target));
        }
    }
}
