<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Commands\Pm;

use Carbon\Carbon;
use Hifone\Commands\Pm\AddPmCommand;
use Hifone\Events\Pm\PmWasAddedEvent;
use Hifone\Models\Pm;
use Hifone\Models\Pm\Meta;
use Hifone\Services\Dates\DateFactory;

class AddPmCommandHandler
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
     * Handle the report pm command.
     *
     * @param \Hifone\Commands\Pm\AddPmCommand $command
     *
     * @return \Hifone\Models\Pm
     */
    public function handle(AddPmCommand $command)
    {
        // Create the pm meta
        $meta = Meta::create([
            'body' => $command->body,
        ]);

        $data = [
            'user_id'           => $command->user_id,
            'author_id'         => $command->author_id,
            'meta_id'           => $meta->id,
            'created_at'        => Carbon::now()->toDateTimeString(),
        ];
        // Create the pm
        $pm = Pm::create($data);

        event(new PmWasAddedEvent($pm));

        return $pm;
    }
}
