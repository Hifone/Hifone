<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Listeners\Notification;

use Auth;
use Hifome\Models\User;
use Hifone\Events\Append\AppendEventInterface;
use Hifone\Models\Append;
use Hifone\Models\Thread;

class SendAppendNotificationHandler extends AbstractNotificationHandler
{
    public $notifiedUsers = [];

    /**
     * Handle the thread.
     */
    public function handle(AppendEventInterface $event)
    {
        $this->trigger($event->append);
    }

    /**
     * Trigger the thread.
     *
     * @param \Hifone\Models\Thread $thread
     */
    protected function trigger(Append &$append)
    {
        $this->newAppendNotify($append);
    }

    private function newAppendNotify(Append $append)
    {
        $thread = Thread::findOrFail($append->thread_id);
        $fromUser = Auth::user();
        $users = $thread->replies()->with('user')->get()->lists('user');
        // Notify commented user
        $this->batchNotify(
                    'comment_append',
                    $fromUser,
                    $this->removeDuplication($users),
                    $thread->id,
                    0,
                    $append->content);

        // Notify followed users
        $this->batchNotify(
                    'follow_append',
                    $fromUser,
                    $this->removeDuplication($thread->follows()->get()),
                    $thread->id,
                    0,
                    $append->content);
    }
}
