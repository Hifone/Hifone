<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Events\Credit;

use Auth;
use Hifone\Events\EventInterface;
use Hifone\Events\Image\ImageWasUploadedEvent;
use Hifone\Events\Reply\ReplyWasAddedEvent;
use Hifone\Events\Thread\ThreadWasAddedEvent;
use Hifone\Events\User\UserWasLoggedinEvent;
use Hifone\Models\Credit;
use Hifone\Models\CreditRule;
use Log;

class AddCreditHandler
{
    public function handle(EventInterface $event)
    {
        $action = '';
        if ($event instanceof ThreadWasAddedEvent) {
            $action = 'thread_new';
        } elseif ($event instanceof ReplyWasAddedEvent) {
            $action = 'reply_new';
        } elseif ($event instanceof ImageWasUploadedEvent) {
            $action = 'photo_upload';
        } elseif ($event instanceof UserWasLoggedinEvent) {
            $action = 'login';
        }

        $this->record($action);
    }

    protected function record($action)
    {
        if (!$action) {
            return;
        }

        $credit_rule = CreditRule::where('slug', $action)->first();

        if (!$credit_rule) {
            return;
        }

        if (in_array($credit_rule->frequency, [CreditRule::DAILY, CreditRule::ONCE])) {
            $count = Credit::where('user_id', Auth::user()->id)->where('rule_id', $credit_rule->id)->where(function ($query) use ($credit_rule) {
                if ($credit_rule->frequency == CreditRule::DAILY) {
                    $frequency_tag = Credit::generateFrequencyTag();
                    return $query->where('frequency_tag', $frequency_tag);
                }
            })->count();
            if($count > 0) return;
        }

        $credit = Credit::create([
            'user_id' => Auth::user()->id,
            'rule_id' => $credit_rule->id,
            'balance' => Auth::user()->score + $credit_rule->reward,
        ]);

        Auth::user()->update(['score' => $credit->balance]);
    }
}
