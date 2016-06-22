<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Http\Controllers\Dashboard;

use Hifone\Models\Node;
use Hifone\Models\Photo;
use Hifone\Models\Reply;
use Hifone\Models\Section;
use Hifone\Models\Thread;
use Hifone\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    protected $show_components = [];

    /**
     * Creates a dashboard controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->show_components = [
            'laravel/framework',
            'laravel/socialite',
            'zizaco/entrust',
            'roumen/feed',
        ];
    }

    /**
     * Shows the dashboard view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $components = [];
        $composer_lock = json_decode(file_get_contents(base_path().'/composer.lock'));
        foreach ($composer_lock->packages as $package) {
            if (in_array($package->name, $this->show_components)) {
                $components[] = $package;
            }
        }

        $nodes = Node::orderBy('order')->get();
        $recentThreads = Thread::orderBy('created_at', 'desc')->take(5)->get();
        $recentReplies = Reply::orderBy('created_at', 'desc')->take(5)->get();
        $recentUsers = User::orderBy('id', 'desc')->take(5)->get();

        return View::make('dashboard.index')
            ->withSectionCount(Section::count())
            ->withNodeCount(Node::count())
            ->withThreadCount(Thread::count())
            ->withReplyCount(Reply::count())
            ->withUserCount(User::count())
            ->withPhotoCount(Photo::count())
            ->withRecentThreads($recentThreads)
            ->withRecentReplies($recentReplies)
            ->withRecentUsers($recentUsers)
            ->withComponents($components)
            ->withNodes($nodes);
    }
}
