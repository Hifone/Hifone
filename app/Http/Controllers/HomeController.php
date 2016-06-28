<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Http\Controllers;

use Hifone\Models\Section;
use Hifone\Models\Thread;
use Hifone\Repositories\Criteria\Thread\Filter;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Home page.
     */
    public function index()
    {
        $class = Config::get('setting.home_controller') ?: 'ThreadController';
        $method = Config::get('setting.home_method') ?: 'index';

        return app('Hifone\Http\Controllers\\'.$class)->$method();
    }

    /**
     * Excellent page.
     */
    public function excellent()
    {
        $repository = app('repository');
        $repository->pushCriteria(new Filter('excellent'));

        $threads = $repository->model(Thread::class)->getThreadList(10);

        return $this->view('home.excellent')
            ->withThreads($threads)
            ->withSections(Section::orderBy('order')->get());
    }

    /**
     * Feed function.
     */
    public function feed()
    {
        $feed = app('feed');
        $feed->title = Config::get('setting.site_name');
        $feed->description = trans('hifone.feed');
        $feed->lang = Config::get('setting.site_locale');
        $feed->link = Str::canonicalize(Config::get('setting.site_domain'));
        $feed->ctype = 'text/xml';
        $feed->setDateFormat('datetime');

        $threads = Thread::excellent()->recent()->limit(20)->get();

        foreach ($threads as $thread) {
            $feed->add(
                $thread->title,
                Config::get('setting.site_name'),
                Str::canonicalize(route('thread.show', $thread->id)),
                date('Y-m-d', strtotime($thread->created_at)),
                str_limit($thread->body, 200));
        }

        return $feed->render('rss');
    }
}
