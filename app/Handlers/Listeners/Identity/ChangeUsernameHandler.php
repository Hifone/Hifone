<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Listeners\Identity;

use Hifone\Events\EventInterface;
use Hifone\Events\User\UserWasAddedEvent;
use Hifone\Models\Identity;
use Hifone\Models\User;
use Illuminate\Support\Str;

class ChangeUsernameHandler
{
    public function handle(EventInterface $event)
    {
        if ($event instanceof UserWasAddedEvent) {
            $user = $event->user;
            $this->changeUsername($user);
        }
    }

    //处理改用户名操作。
    protected function changeUsername($user)
    {
        //$identitity = Identity::where('user_id', $user->id)->first();
        \Log::info('start changed username : '.$user->id);
        $identitity = $user->identities()->first();
        if ($identitity && $identitity->nickname && Str::endsWith($user->username, '_'.$identitity->provider_id)) {
            if (!User::whereUsername($identitity->nickname)->exists()) {
                $user->username = $identitity->nickname;
                $user->save();
                \Log::info('changed username : '.$user->id);
            }
        }
        \Log::info('end changed username : '.$user->id);
    }
}
