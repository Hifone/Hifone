<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Commands\Credit;

use Carbon\Carbon;
use Hifone\Commands\Credit\AddCreditCommand;
use Hifone\Services\Dates\DateFactory;
use Hifone\Models\Credit;

class AddCreditCommandHandler
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
     * Handle the report credit command.
     *
     * @param \Hifone\Commands\Credit\AddCreditCommand $command
     *
     * @return \Hifone\Models\Credit
     */
    public function handle(AddCreditCommand $command)
    {
        $data = [
            'user_id'           => $command->user_id,
            'rule_id'           => $command->rule_id,
            'balance'           => $command->balance,
            'created_at'        => Carbon::now()->toDateTimeString(),
        ];
        // Create the credit
        $credit = Credit::create($data);

        return $credit;
    }
}
