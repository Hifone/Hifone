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
use Hifone\Events\Reply\ReplyWasRemovedEvent;
use Hifone\Events\Thread\ThreadWasAddedEvent;
use Hifone\Events\User\UserWasAddedEvent;
use Hifone\Events\User\UserWasLoggedinEvent;
use Hifone\Models\Credit;
use Hifone\Models\CreditRule;
use Hifone\Models\User;

class AddCreditHandler
{
    public function handle(EventInterface $event)
    {
        $action = '';
        if ($event instanceof ThreadWasAddedEvent) {
            $action = 'thread_new';
            $user = $event->thread->user;
        } elseif ($event instanceof ReplyWasAddedEvent) {
            $action = 'reply_new';
            $user = $event->reply->user;
        } elseif ($event instanceof ReplyWasRemovedEvent) {
            $action = 'reply_remove';
            $user = $event->reply->user;
        } elseif ($event instanceof ImageWasUploadedEvent) {
            $action = 'photo_upload';
            $user = Auth::user();
        } elseif ($event instanceof UserWasAddedEvent) {
            $action = 'register';
            $user = $event->user;
        } elseif ($event instanceof UserWasLoggedinEvent) {
            $action = 'login';
            $user = $event->user;
        }

        $this->record($action, $user);
    }

    protected function record($action, $user)
    {
        if (!$action) {
            return;
        }

        $credit_rule = CreditRule::where('slug', $action)->first();

        if (!$credit_rule || !$this->checkFrequency($credit_rule, $user)) {
            return;
        }

        $credit = Credit::create([
            'user_id' => $user->id,
            'rule_id' => $credit_rule->id,
            'balance' => $user->score + $credit_rule->reward,
        ]);

        $user->update(['score' => $credit->balance]);
    }

    protected function checkFrequency(CreditRule $credit_rule, User $user)
    {
        if (in_array($credit_rule->frequency, [CreditRule::DAILY, CreditRule::ONCE])) {
            $count = Credit::where('user_id', $user->id)->where('rule_id', $credit_rule->id)->where(function ($query) use ($credit_rule) {
                if ($credit_rule->frequency == CreditRule::DAILY) {
                    $frequency_tag = Credit::generateFrequencyTag();

                    return $query->where('frequency_tag', $frequency_tag);
                }
            })->count();
            if ($count > 0) {
                return false;
            }
        }

        return true;
    }
}
