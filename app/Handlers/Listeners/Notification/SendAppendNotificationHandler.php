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
use Hifone\Services\Notifier\Notifier;

class SendAppendNotificationHandler
{
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
        $author = Auth::user();
        $users = $thread->replies()->with('user')->get()->lists('user');
        // Notify commented user
        app(Notifier::class)->batchNotify(
                    'commented_thread_new_append',
                    $author,
                    $users,
                    $thread,
                    $append->content);

        // Notify followed users
        app(Notifier::class)->batchNotify(
                    'followed_thread_new_append',
                    $author,
                    $thread->follows()->get(),
                    $thread,
                    $append->content);
    }
}
