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
use Hifone\Models\Credit;
use Hifone\Repositories\Contracts\Credit\RuleRepositoryInterface;
use Hifone\Repositories\Contracts\CreditRepositoryInterface;
use Hifone\Services\Dates\DateFactory;

class AddCreditCommandHandler
{
    /**
     * The date factory instance.
     *
     * @var \Hifone\Services\Dates\DateFactory
     */
    protected $dates;

    /**
     * The credit instance.
     *
     * @var \Hifone\Repositories\Contracts\CreditRepositoryInterface
     */
    protected $credit;

    /**
     * The credit rule instance.
     *
     * @var \Hifone\Repositories\Contracts\Credit\RuleRepositoryInterface
     */
    protected $credit_rule;

    /**
     * Create a new report issue command handler instance.
     *
     * @param \Hifone\Services\Dates\DateFactory $dates
     */
    public function __construct(DateFactory $dates, RuleRepositoryInterface $credit_rule, CreditRepositoryInterface $credit)
    {
        $this->dates = $dates;
        $this->credit_rule = $credit_rule;
        $this->credit = $credit;
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
        $credit_rule = $this->credit_rule->whereSlug($command->action)->first();

        if (!$credit_rule || !$this->credit->checkFrequency($credit_rule, $command->user)) {
            return;
        }

        $data = [
            'user_id'           => $command->user->id,
            'rule_id'           => $credit_rule->id,
            'balance'           => $command->user->score + $credit_rule->reward,
            'created_at'        => Carbon::now()->toDateTimeString(),
        ];

        // Create the credit
        $credit = $this->credit->create($data);

        $command->user->update(['score' => $credit->balance]);

        return $credit;
    }
}
