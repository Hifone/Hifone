<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Composers;

use Cache;
use Config;
use Hifone\Models\Link;
use Hifone\Models\Reply;
use Hifone\Models\Tag;
use Hifone\Models\Thread;
use Hifone\Models\Tip;
use Hifone\Models\User;
use Illuminate\Contracts\View\View;

class SidebarComposer
{
    const CACHE_MINUTES = 10;

    /**
     * Bind data to the view.
     *
     * @param \Illuminate\Contracts\View\View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->withTopUsers($this->getTopUsers());
        $view->withStats($this->getStats());
        $view->withTip($this->getRandTip());
        $view->withLinks($this->getLinks());
        $view->withTopTags($this->getTopTags());
        $view->withNewThreadDropdowns(Config::get('setting.new_thread_dropdowns'));
    }

    protected function getTopUsers()
    {
        return Cache::remember('topusers', self::CACHE_MINUTES, function () {
            return User::orderBy('score', 'desc')->take(5)->get();
        });
    }

    protected function getStats()
    {
        return Cache::remember('stats', self::CACHE_MINUTES, function () {
            $entity = [];
            $entity['thread_count'] = Thread::count();
            $entity['reply_count'] = Reply::count();
            $entity['user_count'] = User::count();

            return $entity;
        });
    }

    protected function getRandTip()
    {
        $tips = Cache::remember('tips', self::CACHE_MINUTES, function () {
            return Tip::all();
        });

        return ($tips && $tips->count() > 0) ? $tips->random() : null;
    }

    protected function getLinks()
    {
        return Cache::remember('links', self::CACHE_MINUTES, function () {
            return Link::orderBy('order', 'asc')->get();
        });
    }

    protected function getTopTags()
    {
        return Cache::remember('tags', self::CACHE_MINUTES, function () {
            return Tag::orderBy('count', 'desc')->take(10)->get();
        });
    }
}
