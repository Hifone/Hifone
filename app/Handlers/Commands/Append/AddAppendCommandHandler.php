<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Commands\Append;

use Carbon\Carbon;
use Hifone\Commands\Append\AddAppendCommand;
use Hifone\Dates\DateFactory;
use Hifone\Events\Append\AppendWasAddedEvent;
use Hifone\Models\Append;

class AddAppendCommandHandler
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
     * Handle the report append command.
     *
     * @param \Gitamin\Commands\Append\AddAppendCommand $command
     *
     * @return \Gitamin\Models\Append
     */
    public function handle(AddAppendCommand $command)
    {
        $data = [
            'thread_id'         => $command->thread_id,
            'content'           => $command->content,
            'created_at'        => Carbon::now()->toDateTimeString(),
        ];
        // Create the append
        $append = Append::create($data);

        event(new AppendWasAddedEvent($append));

        return $append;
    }
}
