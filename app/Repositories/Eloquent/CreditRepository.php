<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Repositories\Eloquent;

use Hifone\Repositories\Contracts\Credit\RuleRepositoryInterface;
use Hifone\Repositories\Contracts\CreditRepositoryInterface;
use Hifone\Models\Credit;
use Hifone\Models\Credit\Rule as CreditRule;
use Hifone\Models\User;

class CreditRepository extends Repository implements CreditRepositoryInterface
{
    /**
     * @return \Hifone\Models\Credit
     */
    public function model()
    {
        return 'Hifone\Models\Credit';
    }

    public function checkFrequency(CreditRule $credit_rule, User $user)
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