<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Commands\Identity;

use Carbon\Carbon;
use Hifone\Commands\Identity\AddIdentityCommand;
use Hifone\Dates\DateFactory;
use Hifone\Models\Identity;
use Illuminate\Support\Facades\Session;

class AddIdentityCommandHandler
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
     * @param \Gitamin\Commands\Identity\AddAppendCommand $command
     *
     * @return \Gitamin\Models\Identity
     */
    public function handle(AddIdentityCommand $command)
    {
        $data = [
            'user_id'         => $command->user_id,
            'extern_uid'      => $command->data['extern_uid'],
            'provider_id'     => $command->data['provider_id'],
            'nickname'        => $command->data['nickname'],
            'created_at'      => Carbon::now()->toDateTimeString(),
        ];
        // Create the identify
        $identify = Identity::create($data);

        Session::pull('connect_data');

        return $identify;
    }
}
