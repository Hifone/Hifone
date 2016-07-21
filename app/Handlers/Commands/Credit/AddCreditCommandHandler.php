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
use Hifone\Models\Credit\Rule as CreditRule;
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
        $credit_rule = CreditRule::whereSlug($command->action)->first();

        if (!$credit_rule || !$this->checkFrequency($credit_rule, $command->user)) {
            return;
        }

        $data = [
            'user_id'           => $command->user->id,
            'rule_id'           => $credit_rule->id,
            'balance'           => $command->user->score + $credit_rule->reward,
            'body'              => $credit_rule->reward,
            'created_at'        => Carbon::now()->toDateTimeString(),
        ];

        // Create the credit
        $credit = Credit::create($data);

        $command->user->update(['score' => $credit->balance]);

        return $credit;
    }

    protected function checkFrequency(CreditRule $credit_rule, \Hifone\Models\User $user)
    {
        if (!in_array($credit_rule->frequency, [CreditRule::DAILY, CreditRule::ONCE])) {
            return true;
        }

        $count = Credit::where('user_id', $user->id)->where('rule_id', $credit_rule->id)->where(function ($query) use ($credit_rule) {
            if ($credit_rule->frequency == CreditRule::DAILY) {
                $frequency_tag = Credit::generateFrequencyTag();

                return $query->where('frequency_tag', $frequency_tag);
            }
        })->count();

        return !$count;
    }
}
