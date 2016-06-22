<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Handlers\Listeners\Thread;

use Hifone\Events\Thread\ThreadWasViewedEvent;
use Hifone\Models\Thread;

class UpdateThreadViewCountHandler
{
    protected $cache_key = 'threads_viewed';

    public function handle(ThreadWasViewedEvent $event)
    {
        $thread = $event->thread;

        if (!$this->hasViewedThread($thread)) {
            $thread->increment('view_count', 1);
            $this->storeViewedThread($thread);
        }
    }

    protected function hasViewedThread($thread)
    {
        return array_key_exists($thread->id, $this->getViewedThreads());
    }

    protected function getViewedThreads()
    {
        return app('session')->get($this->cache_key, []);
    }

    protected function storeViewedThread($thread)
    {
        $key = $this->cache_key.'.'.$thread->id;

        app('session')->put($key, time());
    }
}
