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

use Hifone\Models\Node;
use Hifone\Models\Page;
use Hifone\Models\Thread;
use Hifone\Models\User;
use Illuminate\Support\Facades\URL;
use Watson\Sitemap\Sitemap;

class SitemapController extends Controller
{
    /**
     * @var Sitemap
     */
    protected $sitemap;

    public function __construct(Sitemap $sitemap)
    {
        $this->sitemap = $sitemap;
    }

    public function show()
    {
        $this->sitemap->addSitemap(URL::route('sitemap.threads'));
        $this->sitemap->addSitemap(URL::route('sitemap.pages'));
        $this->sitemap->addSitemap(URL::route('sitemap.users'));
        $this->sitemap->addSitemap(URL::route('sitemap.nodes'));

        return $this->sitemap->index();
    }

    public function showNodes()
    {
        $nodes = Node::all();
        foreach ($nodes as $node) {
            $this->sitemap->addTag(route('go', $node->slug), $node->updated_at, 'daily', '0.8');
        }

        return $this->sitemap->render();
    }

    public function showThreads()
    {
        $threads = Thread::all();
        foreach ($threads as $thread) {
            $this->sitemap->addTag(route('thread.show', [$thread->id]), $thread->updated_at, 'daily', '0.8');
        }

        return $this->sitemap->render();
    }

    public function showPages()
    {
        $pages = Page::all();
        foreach ($pages as $page) {
            $this->sitemap->addTag(route('page', $page->slug), $page->updated_at, 'daily', '0.5');
        }

        return $this->sitemap->render();
    }

    public function showUsers()
    {
        $users = User::all();
        foreach ($users as $user) {
            $this->sitemap->addTag(route('user.home', $user->username), $user->updated_at, 'daily', '0.5');
        }

        return $this->sitemap->render();
    }
}
