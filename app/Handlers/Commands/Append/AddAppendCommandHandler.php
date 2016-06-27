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
use Hifone\Events\Append\AppendWasAddedEvent;
use Hifone\Models\Append;
use Hifone\Services\Dates\DateFactory;

class AddAppendCommandHandler
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
     * Handle the report append command.
     *
     * @param \Hifone\Commands\Append\AddAppendCommand $command
     *
     * @return \Hifone\Models\Append
     */
    public function handle(AddAppendCommand $command)
    {
        $data = [
            'thread_id'         => $command->thread_id,
            'content'           => app('parser.markdown')->convertMarkdownToHtml($command->content),
            'created_at'        => Carbon::now()->toDateTimeString(),
        ];

        // Create the append
        $append = Append::create($data);

        event(new AppendWasAddedEvent($append));

        return $append;
    }
}
